<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<!-- SEO -->
	<title>Ethical Hacking Society of Abertay University</title>
	<meta property="og:title" content="Ethical Hacking Society of Abertay University" />
	<meta property="og:type" content="company" />
	<meta property="og:url" content="http://www.ethicalhackingsociety.com/" />
	<meta property="og:site_name" content="Ethical Hacking Society of Abertay University" />
	<meta property="og:description" content="Ethical Hacking Society of Abertay University" />
	<!-- <meta property="og:image" content="http://www.ethicalhackingsociety.com/img/opengraph.jpg" /> -->
	<meta name="description" content="Ethical Hacking Society of Abertay University" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="EHS Web Team" />
	<meta name="owner" content="Ethical Hacking Society" />
	<meta name="language" content="en-EN" />
	<meta http-equiv="Content-Language" content="en_EN" />
	<!-- Assets -->
	{{Asset::styles();}}
	{{Asset::scripts();}}
	{{Asset::container('bootstrapper')->styles();}}
	{{Asset::container('bootstrapper')->scripts();}}
	<script type="text/javascript">
		$(document).ready(function(){
			@section('docready');
			@yield_section
		});
	</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span2">
				<ul class="nav nav-list">
					<li class="nav-header">Hello
						@if(Auth::check())
						{{Auth::user()->name}} ({{Auth::user()->student_id}})
						@endif
					</li>
					<li><a href="{{action('meeting')}}">Meetings</a></li>
					@if(Auth::guest())
					<li><a href="{{action('member@signup')}}">Sign up</a></li>
					<li><a href="{{action('member@signin')}}">Sign in</a></li>
					<li><a href="{{action('member@rpwreset')}}">Reset password</a></li>
					@endif
					<li><a href="{{action('meeting@suggest')}}">Suggest a talk</a></li>
					<li><a href="{{action('meeting@upcoming')}}">Upcoming talks</a></li>
					<li><a href="{{action('meeting@suggested')}}">Suggested talks</a></li>
					@if(Auth::check())
					<li><a href="{{action('meeting@changepassword')}}">Change password</a></li>
					<li><a href="{{action('member@settings')}}">Settings</a></li>
					<li><a href="{{action('member@signout')}}">Sign out</a></li>
					@endif
				</ul>
			</div>
			<div class="span10">
				@section('page_content')
				Parent content!
				@yield_section
			</div>
		</div>
		<div id="ajax-output"></div>
	</div>
</body>
</html>