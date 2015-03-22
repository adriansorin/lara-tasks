@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Add New User</div>
				<div class="panel-body"></div>
				<form class="form-horizontal" role="form" data-remote method="POST" action="{{ url('/admin/adduser') }}" id="add-user-form">
					<div class="form-group">
						<label class="col-md-4 control-label">Username</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="username" value="{{ old('username') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">First Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Last Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Password</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Confirm Password</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password_confirmation">
						</div>
					</div>

					<div class="form-group" style="text-align: center;">
						<div class="checkbox">
					    	<label>
					      		<input type="checkbox" name="is_admin" value="1"> Is Admin
					    	</label>
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
