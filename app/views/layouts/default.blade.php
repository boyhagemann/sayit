<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>Sayit.io</title>

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        {{ HTML::style('js/slidebars/0.8.1/slidebars.min.css') }}
        {{ HTML::style('js/slidebars/theme/slidebars-theme.css') }}
        {{ HTML::style('css/screen.css') }}
    </head>
    <body>

		<div class="sb-navbar sb-slide">

			<div class="sb-toggle-left">
				<div class="navicon-line"></div>
				<div class="navicon-line"></div>
				<div class="navicon-line"></div>
			</div>

			@include('includes.navbar')

			@yield('navbar')

		</div>

		<div id="sb-site">

			<div class="container-top">
				<div class="container">

					<div class="col-lg-12 section-top">
						@include('includes.messages')
						@yield('top')
					</div>

				</div>
			</div>

			<div class="container">

				<div class="col-lg-12 section-content">
					@yield('content')
				</div>

			</div>

			<div class="jumbotron jumbotron-bottom"">

				<div class="container">
					@yield('bottom')
				</div>
			</div>

		</div>

		<div class="sb-slidebar sb-left">
			@include('includes.sidemenu')
		</div>

		<div class="sb-slidebar sb-right section-sidebar">
			@yield('sidebar')
		</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js" type="text/javascript"></script>

		{{ HTML::script('js/slidebars/0.8.1/slidebars.min.js') }}
		{{ HTML::script('js/slidebars/theme/slidebars-theme.js') }}
		<script>
			(function($) {
				$(document).ready(function() {
					$.slidebars();
				});
			}) (jQuery);
		</script>

    </body>
</html>