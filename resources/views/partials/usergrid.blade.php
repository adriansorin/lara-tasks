<table class="table">
	<tr>
		<th>#</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Username</th>
		<th>Operations</th>
	</tr>
	@if (count($users) > 0)
		@foreach ($users as $user)
		<tr>
			<td>{{$user->id}}</td>
			<td>{{$user->first_name}}</td>
			<td>{{$user->last_name}}</td>
			<td>{{$user->username}}</td>
			<td>
				<a class="btn btn-success" href="{{ url('/admin/edituser/' . $user->id) }}" role="button">Edit</a>
				<a class="btn btn-danger" data-remote-link="{{ $user->id }}" data-remote-redirect="{{ url('/') }}" href="{{ url('/admin/deleteuser') }}" role="button">Delete</a>
			</td>
		</tr>
		@endforeach
	@else
		<tr><td colspan="5" align="center">No results found!</td></tr>
	@endif
</table>