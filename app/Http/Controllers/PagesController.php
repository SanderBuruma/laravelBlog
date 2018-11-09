<?php

namespace App\Http\Controllers;

use App\Post; 

use Illuminate\Http\Request;

use App\Category;
use Mail;
use Session;

class PagesController extends Controller {

	public function getIndex() {
		$posts = Post::orderBy('id', 'desc')->paginate(5);
		return view('pages.welcome')->withPosts($posts);
	}

	public function getAbout() {
		$first = "Sander"; 
		$last = 'Buruma';
		$data['fullname'] = "$first $last";
		$data['email'] = 'sanderburuma@gmail.com';
		$email = 'sanderburuma@gmail.com';
		return view('pages.about')->withData($data);
	}

	public function getContact() {
		return view('pages.contact');
	}

	public function postContact(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3|max:255',
			'message' => 'min:10'
		]);
		
		$data = [
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message
		];

		Mail::send('emails.contact', $data, function($message) use ($data){
			$message->from($data['email']);
			$message->to('sanderburuma@gmail.com');
			$message->subject('Contact: '.$data['subject']);
		});

		Session::flash('success', 'Your Email was sent!');

		return redirect()->route('home');;
	}

}