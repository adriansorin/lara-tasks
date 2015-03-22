<table class="table">
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Description</th>
		<th>Due date</th>
		<th>Status</th>
		<th>Assigned to</th>
	</tr>
	@if (count($assignedTasks) > 0)
		@foreach ($assignedTasks as $task)
		<tr>
			<td>{{$task['id']}}</td>
			<td>{{$task['name']}}</td>
			<td>{{$task['description']}}</td>
			<td>{{$task['due_date']}}</td>
			<td>
				@if ($task['status'] != 'done')
					{{$task['status']}}
				@else
					<form class="form-horizontal" role="form" data-remote="{{ url('/tasks') }}" method="POST" action="{{ url('/tasks/status') }}" id="change-status-form">
						<input type="hidden" name="id" value="{{$task['id']}}">
						<select class="form-control" name="status" data-submits-form>
							<option value="done" selected>Done</option>
							<option value="closed">Closed</option>
						</select>
					</form>
				@endif
			</td>
			<td>{{$task['username']}}</td>
		</tr>
		@endforeach
	@else
		<tr><td colspan="6" align="center">No results found!</td></tr>
	@endif
</table>