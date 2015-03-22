<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Repositories\TaskRepository;
use App\Repositories\UserTaskRepository;

class TaskController extends Controller {

	public function __construct(Guard $auth, TaskRepository $task, UserTaskRepository $userTask)
	{
		$this->auth = $auth;
		$this->task = $task;
		$this->userTask = $userTask;

		$this->middleware('auth');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$unassignedTasks = $this->task->getUnassignedTasks();
		$assignedTasks = $this->task->getAssignedTasks();
		$allUsers = User::select('id', 'username')->where(['is_admin' => 0])->get()->toArray();

		return view('task', [
			'unassignedTasks' => $unassignedTasks,
			'allUsers' => $allUsers,
			'assignedTasks' => $assignedTasks
		]);
	}


	/**
	 * Show form for adding new task
	 * @return Response
	 */
	public function getAdd()
	{
		return view('addtask');
	}


	/**
	 * Add new task
	 * @param  Request        $request [description]
	 * @return Response
	 */
	public function postAdd(Request $request)
	{
		$validate = $this->task->validate($request->all());

		if ($validate->fails())
		{
			$this->throwValidationException(
				$request, $validate
			);
		}

		$this->task->create($request->all());

		return response()->json(['success' => ['Task succesfully created.']]);

	}


	/**
	 * Assign a task to a user
	 * @param  Request $request [description]
	 * @return Response
	 */
	public function postAssign(Request $request)
	{
		$validate = $this->userTask->validate($request->all());

		if ($validate->fails())
		{
			$this->throwValidationException(
				$request, $validate
			);
		}

		$this->userTask->create($request->all());

		return response()->json(['success' => ['Task succesfully assigned.']]);
	}


	/**
	 * Update status by admin
	 * @param  Request $request [description]
	 * @return Response
	 */
	public function postStatus(Request $request)
	{
		$validate = $this->task->validateStatusAdmin($request->all());

		if ($validate->fails())
		{
			$this->throwValidationException(
				$request, $validate
			);
		}

		Task::findOrFail($request->id)->update(['status' => $request->status]);

		return response()->json(['success' => ['Status succesfully updated.']]);
	}

}
