<table class="table">
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Description</th>
		<th>Due date</th>
		<th>Status</th>
		<th>Assign</th>
	</tr>
	@if (count($unassignedTasks) > 0)
		@foreach ($unassignedTasks as $task)
		<tr>
			<td>{{$task['id']}}</td>
			<td>{{$task['name']}}</td>
			<td>{{$task['description']}}</td>
			<td>{{$task['due_date']}}</td>
			<td>{{$task['status']}}</td>
			<td>
				<form class="form-horizontal" role="form" data-remote="{{ url('/tasks') }}" method="POST" action="{{ url('/tasks/assign') }}" id="assign-task-form">
					<input type="hidden" name="task_id" value="{{$task['id']}}">
					<select class="form-control" name="user_id" data-submits-form>
						<option value="">Assign to user</option>
						@if (count($allUsers) > 0)
							@foreach ($allUsers as $user)
								<option value="{{ $user['id'] }}">{{ $user['username'] }}</option>
							@endforeach
						@endif
					</select>
				</form>
			</td>
		</tr>
		@endforeach
	@else
		<tr><td colspan="6" align="center">No results found!</td></tr>
	@endif
</table>