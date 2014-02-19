@extends('layouts.default')

@section('top')

<div class="page-header clearfix">
	<h1 class="pull-left">{{{ $article['title'] }}}</h1>
	<div class="col-lg-3 pull-right">
		<a href="" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-edit"></i> Edit this article</a>
	</div>
</div>

@stop

@section('content')

{{ $article['html'] }}

@stop

@section('sidebar')
<div class="media">
	<a class="pull-left" href="#">
		<img src="http://placehold.it/65x65" width="65" height="65" alt="{{{ $article['user']['username'] }}}">
	</a>
	<div class="media-body">
		<h4>{{{ $article['user']['username'] }}}</h4>
		<p>
			<a href="#" class="btn btn-primary btn-xs" role="button"><i class="glyphicon glyphicon-star"></i> Follow</a> <a href="#" class="btn btn-default btn-xs" role="button"><i class="glyphicon glyphicon-search"></i> View articles</a>
		</p>
	</div>
</div>
<hr>

@if($article['metadata'])
<blockquote>
    @foreach($article['metadata'] as $label => $value)
    <h4>{{{ $label }}}</h4>
    <h5 class="text-muted">{{{ $value }}}</h5>
    @endforeach    
</blockquote>
@endif

@if($article['key'])
<blockquote>
	<h5 class="text-muted">Use this key in other articles to link to this article. <a href="">Show me</a></h5>
	<h6>{{{ $article['key'] }}}</h6>
</blockquote>
@endif


@stop