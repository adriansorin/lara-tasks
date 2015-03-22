@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Add New Task</div>
				<div class="panel-body"></div>
				<form class="form-horizontal" role="form" data-remote method="POST" action="{{ url('/tasks/add') }}" id="add-task-form">
					<div class="form-group">
						<label class="col-md-4 control-label">Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="{{ old('name') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Description</label>
						<div class="col-md-6">
							<textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Due date</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="due_date" value="{{ old('due_date') }}">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Add
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
