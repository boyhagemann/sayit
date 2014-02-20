@extends('layouts.writer')


@section('top')

{{ Form::model($article, array('route' => array('article.update', $article->id), 'method' => 'put')) }}

<div class="page-header clearfix">
	<div class="form-group">
	{{ Form::text('title', null, array('class' => 'form-control col-lg-12')) }}
	</div>
</div>

@stop

@section('content')
<div id="markdown-editor" class="form-group textarea-markdown" data-url="{{ URL::route('article.preview') }}">
	{{ Form::textarea('markdown', null, array('class' => 'form-control col-lg-12', 'rows' => 20)) }}
</div>

@stop

@section('sidebar')
<div id="markdown-preview">

</div>
@stop

@section('bottom')

<div class="row">
	<div class="col-lg-2">
		{{ Form::submit('Save changes', array('class' => 'btn btn-primary btn-lg')) }}
	</div>
	<div class="col-lg-2">
		{{ Form::submit('Save & Publish', array('class' => 'btn btn-danger btn-lg')) }}
	</div>

</div>

{{ Form::close() }}

@stop