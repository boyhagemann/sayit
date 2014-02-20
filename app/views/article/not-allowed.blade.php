@extends('layouts.default')

@section('top')

<div class="page-header clearfix">
	<h1 class="pull-left">Oops...</h1>
</div>

@stop

@section('content')

	<h2>You are not allowed to view this article</h2>
	<p>
		It seems you are not allowed to read the full contents of this article.
		If you want, you can send a request message to the channel moderator to
		allow access to this article.
	</p>
	<a href="" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-envelope"></i> Request access</a>

@stop
