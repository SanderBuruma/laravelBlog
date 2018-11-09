<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use App\Category;
use App\Tag;
use Purifier;
use Image;
use Illuminate\Support\Facades\Storage;
use File;

class PostController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){
		$posts = Post::orderBy('id', 'desc')->paginate(5);
		return view('posts.index')->withPosts($posts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
			$categories = Category::all();
			$tags = Tag::all();
			return view('posts.create')->withCategories($categories)->withTags($tags);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// validate the data
		$this->validate($request, array(
			'title' 					=> 'required|max:255',
			'slug' 						=> 'required|alpha_dash|min:5|max:255|unique:posts,slug',
			'body'	 					=> 'required',
			'category_id' 		=> 'required|integer|exists:categories,id',
			'featured_image' 	=> 'sometimes|image|max:500'
		));

		//store in the database
		$post = new Post;

		$post->title = $request->title;
		$post->slug = $request->slug;
		$post->body = Purifier::clean($request->body);
		$post->category_id = $request->category_id;

		if ($request->hasFile('featured_image')) {
			$image = $request->file('featured_image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$location = public_path('images/' . $filename);
			Image::make($image)->save($location);
			
			$post->image = $filename;
		};

		$post->save();

		$post->tags()->sync($request->tags, false);

		Session::flash('success', 'The blog post was successfully saved!');

		return redirect()->route('posts.show', $post->id);

		//redirect to another page
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$post = Post::find($id);
		return view('posts.show')->withPost($post);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
			$post = Post::find($id);
			$categories = Category::all();
			$cats = [];
			foreach($categories as $category){
				$cats[$category->id] = $category->name; 
			}

			$tags = Tag::all();

			return view('posts.edit')->withPost($post)->withCats($cats)->withTags($tags);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$post = Post::find($id);
		if ($request->input('slug') == $post->slug){
			$this->validate($request, array(
				'title' => 'required|max:255',
				'category_id' => 'required|integer|exists:categories,id',
				'body'  => 'required',
				'featured_image' => 'sometimes|image|max:500'
			));
		}else{
			$this->validate($request, array(
							'title' => 'required|max:255',
							'slug' => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
							'category_id' => 'required|integer|exists:categories,id',
							'body'  => 'required',
							'featured_image' => 'sometimes|image|max:500'
					));
		}


		$post = Post::find($id);
		$post->title = $request->input('title');
		$post->slug = $request->input('slug');
		$post->category_id = $request->input('category_id');
		$post->body = Purifier::clean($request->input('body'));

		if ($request->hasFile('featured_image')) {
			$image = $request->file('featured_image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$location = public_path('images/' . $filename);
			Image::make($image)->save($location);
			$oldFilename = $post->image;

			$post->image = $filename;
			File::delete('images/'.$oldFilename);
		}

		$post->save();

		$tags = $request->input('tags', []); 
		$post->tags()->sync($tags, true);

		Session::flash('success', 'This post was successfully saved!');

		return redirect()->route('posts.show', $post->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$post = Post::find($id);
		
		$post->tags()->detach();
		$post->delete();
		File::delete('images/'.$post->image);

		Session::flash('success', 'The post was successfully deleted!');
		return redirect()->route('posts.index');
	}
}
