@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Assigned tasks</div>

				@include('partials.usertasks')
			</div>
		</div>
	</div>
</div>
@endsection
