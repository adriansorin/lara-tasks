<?php namespace App\Repositories;

use App\UserTask;
use Validator;

class UserTaskRepository {

	/**
	 * Validate user properties
	 * @param  array  $data [description]
	 * @return Validator
	 */
	public function validate(array $data)
	{
		return Validator::make($data, [
			'user_id' => 'required|integer',
			'task_id' => 'required|integer|unique:user_tasks',
		]);
	}


	/**
	 * Create a new user
	 * @param  array  $data [description]
	 * @return User
	 */
	public function create(array $data)
	{
		return UserTask::create($data);
	}
}