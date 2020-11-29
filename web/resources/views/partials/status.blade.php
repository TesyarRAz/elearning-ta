@if(session()->has('status'))
	<div class="callout callout-info">
		<p>{{ session('status') }}</p>
	</div>
@endif

@if($errors->any())
	<div class="callout callout-danger">
		<p>{{ $errors->first() }}</p>
	</div>
@endif