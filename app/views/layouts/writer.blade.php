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

		</div>

		<div class="container-fluid">

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
		<script type="text/javascript">

				var editor = $('#markdown-editor');
				var textarea = editor.find('textarea');

				textarea.keyup(function() {

					$.post(editor.data('url'), { markdown: $(this).val() }, function(response) {
						$('#markdown-preview').html(response);
					});

				});

				textarea.keyup();


				textarea.scroll(function(e) {

					var offsetY = $(this).scrollTop();
					var height = $(this).prop("scrollHeight")
					var diff = offsetY/height;

					var previewHeight = $('#markdown-preview').prop("scrollHeight");
					var y = previewHeight * diff;
					$('#markdown-preview').scrollTop(y);

				});

		</script>

    </body>
</html>