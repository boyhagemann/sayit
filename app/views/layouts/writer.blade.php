<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sayit.io</title>

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        {{ HTML::style('css/screen.css') }}
    </head>
    <body>

        @include('includes.navbar')
        
        <div class="container">

			<div class="col-lg-12 section-top">
				@yield('top')
			</div>

            <div class="col-lg-6 section-content">
                @yield('content')
            </div>
            
            <div class="col-lg-6 section-sidebar">
                @yield('sidebar')
            </div>

        </div>

		<div class="jumbotron jumbotron-bottom"">

			<div class="container">
				@yield('bottom')
			</div>
		</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js" type="text/javascript"></script>
        {{ HTML::script('js/js-markdown-extra.js') }}
        {{ HTML::script('js/js-markdown-extra-master/js/jquery.meltdown.js') }}

	<script type="text/javascript">
		$('.textarea-markdown textarea').meltdown();
	</script>

    </body>
</html>