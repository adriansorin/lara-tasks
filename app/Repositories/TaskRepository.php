<?php namespace App\Repositories;

use App\Task;
use Validator;

class TaskRepository {

	/**
	 * Validate user properties
	 * @param  array  $data [description]
	 * @return Validator
	 */
	public function validate(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255|unique:tasks',
			'description' => 'required|max:255',
			'due_date' => 'required|date',
		]);
	}


	/**
	 * Create a new user
	 * @param  array  $data [description]
	 * @return User
	 */
	public function create(array $data)
	{
		return Task::create($data);

	}


	/**
	 * Get all unassigned tasks
	 * @return array
	 */
	public function getUnassignedTasks()
	{
		return Task::leftJoin('user_tasks', function($join){
			$join->on('tasks.id', '=', 'user_tasks.task_id');
		})
		->select('tasks.id', 'tasks.name', 'tasks.description', 'tasks.due_date', 'tasks.status')
		->whereNull('user_tasks.task_id')
		->get()
		->toArray();
	}


	/**
	 * Get all assigned tasks
	 * @return array
	 */
	public function getAssignedTasks()
	{
		return Task::leftJoin('user_tasks', function($join){
			$join->on('tasks.id', '=', 'user_tasks.task_id');
		})
		->leftJoin('users', function($join){
			$join->on('user_tasks.user_id', '=', 'users.id');
		})
		->select('tasks.id', 'tasks.name', 'tasks.description', 'tasks.due_date', 'tasks.status', 'users.username', 'user_tasks.user_id')
		->whereNotNull('user_tasks.task_id')
		->get()
		->toArray();
	}


	/**
	 * Validate status for admin users
	 * @param  array  $data [description]
	 * @return Validator
	 */
	public function validateStatusAdmin(array $data)
	{
		return Validator::make($data, [
			'id' => 'required|integer',
			'status' => 'required|in:closed',
		]);
	}


	/**
	 * Check the order of the statuses of a task
	 * @param  array  $data [description]
	 * @return void
	 */
	public function checkStatusOrder(array $data)
	{
		$task = Task::find($data['id']);

		switch ($task->status) {
			case 'new':
				if ($data['status'] != 'in progress')
				{
					throw new \Exception('Invalid status. Please select \'in progress\'');
				}

				break;
			
			case 'in progress':
				if ($data['status'] != 'done')
				{
					throw new \Exception('Invalid status. Please select \'done\' status');
				}

				break;

			default:
				throw new \Exception('Invalid status.');

				break;
		}
	}
}