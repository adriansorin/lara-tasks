@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Update User Details</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>

				<form class="form-horizontal" role="form" data-remote="{{ url('/') }}" method="POST" action="{{ url('/admin/edituser') }}" id="edit-user-form">
					<input type="hidden" name="id" value="{{ $user->id }}">

					<div class="form-group">
						<label class="col-md-4 control-label">Username</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="username" value="{{ $user->username }}" disabled>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">First Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Last Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">New Password (Blank if not required)</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Confirm New Password</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password_confirmation">
						</div>
					</div>

					<div class="form-group" style="text-align: center;">
						<div class="checkbox">
					    	<label>
					    		@if ($user->is_admin)
					      			<input type="checkbox" name="is_admin" checked value="1"> Is Admin
					      		@else
					      			<input type="checkbox" name="is_admin" value="1"> Is Admin
					      		@endif
					    	</label>
					  	</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
