@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/search') }}" id="search-user-form">
				<div class="panel panel-default">
					<div class="panel-heading">
						<label class="col-md-1 control-label">Username</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="username">
						</div>

						<button type="submit" class="btn btn-primary">Search</button>
					</div>
				</div>
			</form>

			<div class="panel panel-default">
				<div class="panel-heading">
					<a class="btn btn-primary" href="{{ url('/admin/adduser') }}" role="button">Add New User</a>
				</div>

				@include('partials.usergrid')
			</div>
		</div>
	</div>
</div>
@endsection
