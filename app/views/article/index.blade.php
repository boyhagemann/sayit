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
	<div class="btn-group pull-right">
		<a href="{{ URL::route('article.create') }}" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-pencil"></i>Add new article</a>
	</div>
</div>

@stop

@section('content')

<ul class="media-list article-list">

@foreach($articles as $article)
<li class="media blank-holder article-list__item article-list__access_{{ $article['access']  }}">
	<a class="pull-left" href="#">
		<img src="http://placehold.it/65x65" width="65" height="65" alt="{{{ $article['user']['username'] }}}">
	</a>
	<div class="media-body">
		<h3 class="media-heading article-list__title">
			<a href="{{ URL::route('article.show', $article['slug']) }}">{{{ $article['title'] }}}</a>
		</h3>
		<div class="text-muted article-list__meta">
			@if($article['access'] == 'private')
			<i class="glyphicon glyphicon-lock article-list__locked"></i>
			@endif
			By <a href="{{ URL::route('article.index') }}?q=%40{{ $article['user']['username'] }}" class=" article-list__user-link">{{{ $article['user']['email'] }}}</a>
			@if($article['channel'])
			in channel <a href="{{ URL::route('article.index') }}?q=%24{{ $article['channel']['slug'] }}" class="article-list__channel-link">{{ $article['channel']['title'] }}</a>
			@endif
		</div>
		@if($article['teaser'])
		<p>{{{ $article['teaser'] }}}</p>
		@endif
	</div>
</li>
@endforeach

</ul>

@stop

@section('sidebar')

@stop
