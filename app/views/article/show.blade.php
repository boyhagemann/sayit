@extends('layouts.default')

@section('navbar')

<div class="sb-toggle-right"><i class="glyphicon glyphicon-plus"></i></div>

@stop

@section('top')

<div class="page-header clearfix">
	<h1 class="pull-left">{{{ $article['title'] }}}</h1>
	<div class="btn-group pull-right">
		@if(Sentry::check())
		<a href="{{ URL::route('article.edit', $article->slug) }}" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-edit"></i> Edit this article</a>
		@else
		<a href="{{ URL::route('article.edit', $article->slug) }}" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-lock"></i> Login to edit</a>
		@endif
	</div>
</div>

@stop

@section('content')

<div class="blank-holder">
	{{ $article['html'] }}
</div>

@stop

@section('sidebar')

<div class="container-fluid">

	<div class="media media-user">
		<h5 class="text-muted">Posted by user:</h5>
		<h4>{{{ $article['user']['username'] }}}</h4>
		<a class="pull-left user-image" href="#">
			<img src="http://placehold.it/65x65" width="65" height="65" alt="{{{ $article['user']['username'] }}}">
		</a>
		<div class="media-body">
		</div>
		<div class="clearfix">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet nunc nec sem tincidunt hendrerit. Mauris hendrerit lacinia nunc, eget tempor tortor ullamcorper vel.</p>
			<p>
				<a href="#" class="btn btn-primary btn-xs" role="button"><i class="glyphicon glyphicon-user"></i> Follow</a> <a href="#" class="btn btn-default btn-xs" role="button"><i class="glyphicon glyphicon-search"></i> View articles</a>
			</p>
		</div>
	</div>

	@if($article['channel'])
	<h5 class="text-muted">Posted in channel:</h5>
	<h4>{{{ $article['channel']['title'] }}}</h4>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet nunc nec sem tincidunt hendrerit. Mauris hendrerit lacinia nunc, eget tempor tortor ullamcorper vel.</p>
	<p>
		<a href="#" class="btn btn-primary btn-xs" role="button"><i class="glyphicon glyphicon-star"></i> Follow</a> <a href="#" class="btn btn-default btn-xs" role="button"><i class="glyphicon glyphicon-search"></i> View channel</a>
	</p>
	@endif
	<h5 class="text-muted">Tagged by:</h5>
	<ul class="list-unstyled">
		<li><a href="{{ URL::route('article.index') }}?q=%23tag" class="label label-default">tag</a></li>
		<li><a href="{{ URL::route('article.index') }}?q=%23%22tweede+tag%22" class="label label-default">tweede tag</a></li>
	</ul>

</div>

@stop

@section('bottom')

	@if($article['metadata'])
	<div class="col-lg-4">
		@foreach($article['metadata'] as $label => $value)
		<h4>{{{ $label }}}</h4>
		<p class="text-muted">{{{ $value }}}</p>
		@endforeach
	</div>
	@endif

	@if($article['key'])
	<div class="col-lg-4">
		<h4>Link to this article</h4>
		<p class="text-muted">Use this key in other articles to link to this article.<br><a href="">Show me how</a></p>
		<p><code>{{{ $article['key'] }}}</code></p>
	</div>
	@endif

@stop