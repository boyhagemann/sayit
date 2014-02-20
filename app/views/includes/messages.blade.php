

@if(Session::get('success'))
<div class="alert alert-success">
	<strong>Success:</strong>
	{{ Session::get('success') }}
</div>
@endif

@if(Session::get('error'))
<div class="alert alert-warning">
	<strong>Error:</strong>
	{{ Session::get('error') }}
</div>
@endif

@if(Session::get('info'))
<div class="alert alert-info">
	<strong>Info:</strong>
	{{ Session::get('info') }}
</div>
@endif