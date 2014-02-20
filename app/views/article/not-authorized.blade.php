@extends('layouts.default')

@section('top')

<div class="page-header clearfix">
	<h1 class="pull-left">Oops...</h1>
</div>

@stop

@section('content')

<div class="blank-holder">
	<h2>You are not logged in</h2>
	<p>
		It seems you need to be logged in to view this article.
	</p>
	<a href="" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-lock"></i> Login</a>
</div>

@stop
