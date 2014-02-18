@extends('layouts.default')

@section('content')

<div class="page-header">
    <h1>{{{ $article['title'] }}}</h1>
</div>


{{ $article['html'] }}

@stop

@section('sidebar')

<blockquote>
    @foreach($article['metadata'] as $label => $value)
    <h4>{{{ $label }}}</h4>
    <h5 class="text-muted">{{{ $value }}}</h5>
    @endforeach    
</blockquote>


@stop