@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a class="btn btn-primary" href="{{ url('/tasks/add') }}" role="button">Add New Task</a>
				</div>
			</div>
		</div>

		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Unassigned tasks</div>

				@include('partials.tasksgridfree')
			</div>
		</div>

		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Assigned tasks</div>

				@include('partials.tasksgridtaken')
			</div>
		</div>
	</div>
</div>
@endsection
