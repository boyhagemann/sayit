@extends('layouts.writer')


@section('top')

{{ Form::open(array('route' => 'article.store')) }}

<div class="page-header clearfix">
	<div class="form-group">
		{{ Form::text('title', null, array(
			'class' => 'form-control col-lg-12 input-article-title',
			'placeholder' => 'The title of this article...',
		)) }}
	</div>
</div>

@stop

@section('content')
<div id="markdown-editor" class="form-group textarea-markdown" data-url="{{ URL::route('article.preview') }}">
	{{ Form::textarea('markdown', null, array(
		'class' => 'form-control col-lg-12',
		'placeholder' => 'Enter something interesting...',
		'rows' => 20
	)) }}
</div>

<div class="form-group">
	<div class="">
		<label>{{ Form::radio('access', 'public', true); }} This article is visible for everyone</label>
	</div>
	<div class="">
		<label>{{ Form::radio('access', 'private'); }} Only visible for members of this channel</label>
	</div>
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