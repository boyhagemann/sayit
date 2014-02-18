@extends('layouts.default')

@section('content')

<h1>{{{ $article['title'] }}}</h1>

{{ $article['html'] }}

@stop