<table class="table">
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Description</th>
		<th>Due date</th>
		<th>Status</th>
	</tr>
	@if (count($tasks) > 0)
		@foreach ($tasks as $task)
		<tr>
			<td>{{$task['id']}}</td>
			<td>{{$task['name']}}</td>
			<td>{{$task['description']}}</td>
			<td>{{$task['due_date']}}</td>
			<td>
				@if ($task['status'] == 'closed' || $task['status'] == 'done')
					{{$task['status']}}
				@else
					<form class="form-horizontal" role="form" data-remote="{{ url('/user') }}" method="POST" action="{{ url('/user/status') }}" id="change-status-form">
						<input type="hidden" name="id" value="{{$task['id']}}">
						<select class="form-control" name="status" data-submits-form>
							<option value="new" @if ($task['status'] == 'new') selected @endif>New</option>
							<option value="in progress" @if ($task['status'] == 'in progress') selected @endif>In progress</option>
							<option value="done" @if ($task['status'] == 'done') selected @endif>Done</option>
						</select>
					</form>
				@endif
			</td>
		</tr>
		@endforeach
	@else
		<tr><td colspan="5" align="center">No results found!</td></tr>
	@endif
</table>