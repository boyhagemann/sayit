@extends('layouts.default')

@section('top')

<div class="page-header clearfix">
	<h1 class="pull-left">
		@if(Input::get('q'))
		Search results for <em class="text-muted">{{{ Input::get('q') }}}</em>
		@else
		Articles
		@endif
	</h1>
	<div class="btn-group col-lg-3 pull-right">
		<a href="{{ URL::route('article.create') }}" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-pencil"></i>Add new article</a>
	</div>
</div>

@stop

@section('content')

<ul class="media-list">

</ul>

@foreach($articles as $article)
<li class="media">
	<a class="pull-left" href="#">
		<img src="http://placehold.it/65x65" width="65" height="65" alt="{{{ $article['user']['username'] }}}">
	</a>
	<div class="media-body">
		<h4 class="media-heading">
			<a href="{{ URL::route('article.show', $article['slug']) }}">{{{ $article['title'] }}}</a>
		</h4>
		<div class="text-muted">By {{{ $article['user']['email'] }}}</div>
		@if($article['teaser'])
		<p>{{{ $article['teaser'] }}}</p>
		@endif
	</div>
</li>
@endforeach

@stop

@section('sidebar')

@stop
