<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="/">Laravel Blog</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<?php $urlGet = explode(' ',request())[1] ?>
			<li class="nav-item{{ $urlGet=='/'?' active':null }}"><a class="nav-link" href="/">Home</a></li>
			<li class="nav-item{{ strpos($urlGet,'/blog')!==false?' active':null }}"><a class="nav-link" href="/blog">Blog</a></li>
			<li class="nav-item{{ $urlGet=='/about'?' active':null }}"><a class="nav-link" href="/about">About Me</a></li>
			<li class="nav-item{{ $urlGet=='/contact'?' active':null }}"><a class="nav-link" href="/contact">Contact</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			@if(Auth::check())
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Hallo {{ explode(' ',Auth::user()->name)[0] }}
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="{{ route('posts.index') }}">Posts</a>
						<a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a>
						<a class="dropdown-item" href="{{ route('tags.index') }}">Tags</a>
						<div class="dropdown-divider"></div>
						<a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
					</div>
				</div>
			@else

				<a href="{{ route('login') }}" class="btn btn-secondary">Login</a>

			@endif
		</ul>
	</div>
</nav>