@extends('layouts.default')

@section('content')

@foreach($articles as $article)
<div class="">
	{{{ $article['user']['email'] }}}: <a href="{{ URL::route('article.show', $article['slug']) }}">{{{ $article['title'] }}}</a>
</div>
@endforeach

@stop