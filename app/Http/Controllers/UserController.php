<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\User;
use App\Task;
use App\Repositories\UserRepository;
use App\Repositories\TaskRepository;

class UserController extends Controller {

	public function __construct(Guard $auth, UserRepository $user, TaskRepository $task)
	{
		$this->auth = $auth;
		$this->user = $user;
		$this->task = $task;

		$this->middleware('user', ['except' => 'index']);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$tasks = $this->user->getAssignedTasks($this->auth->user()->id);

		return view('user', ['tasks' => $tasks]);
	}


	/**
	 * Update status for tasks
	 * @return Response
	 */
	public function postStatus(Request $request)
	{
		$validate = $this->user->validateStatusUser($request->all());

		if ($validate->fails())
		{
			$this->throwValidationException(
				$request, $validate
			);
		}

		try {
			
			$this->task->checkStatusOrder($request->all());

		} catch (\Exception $e) {

			return new JsonResponse(['error' => [$e->getMessage()]], 422);

		}

		Task::findOrFail($request->id)->update(['status' => $request->status]);

		return response()->json(['success' => ['Status succesfully updated.']]);
	}

}
