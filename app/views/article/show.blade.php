@extends('layouts.default')

@section('top')

<div class="page-header clearfix">
	<h1 class="pull-left">{{{ $article['title'] }}}</h1>
	<div class="btn-group col-lg-3 pull-right">
		<a href="" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-edit"></i> Edit this article</a>
	</div>
</div>

@stop

@section('content')

{{ $article['html'] }}

@stop

@section('sidebar')

<blockquote>

    @foreach($article['metadata'] as $label => $value)
    <h4>{{{ $label }}}</h4>
    <h5 class="text-muted">{{{ $value }}}</h5>
    @endforeach    
</blockquote>

@if($article['key'])
<blockquote>
	<h5 class="text-muted">Use this key in other articles to link to this article. <a href="">Show me</a></h5>
	<h6>{{{ $article['key'] }}}</h6>
</blockquote>
@endif


@stop