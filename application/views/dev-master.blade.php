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
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span2">
				<ul class="nav nav-list">
					<li class="nav-header">Temporary navigation</li>
					<li><a href="{{action('meeting')}}">Meetings</a></li>
					<li><a href="{{action('member@signup')}}">Sign up</a></li>
					<li><a href="{{action('member@signin')}}">Sign in</a></li>
					<li><a href="{{action('meeting@suggest')}}">Suggest a talk</a></li>
					<li><a href="{{action('meeting@upcoming')}}">Upcoming talks</a></li>
					<li><a href="{{action('member@settings')}}">Settings</a></li>
					<li><a href="{{action('member@signout')}}">Sign out</a></li>
				</ul>
			</div>
			<div class="span10">
				@section('page_content')
				Parent content!
				@yield_section
			</div>
		</div>
	</div>
</body>
</html>