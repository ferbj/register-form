@if(count($errors))
	<div class="alert alert-danger">
		<strong>Error!</strong> Hubo problemas con sus campos.
		<br/>
		<ul>
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif