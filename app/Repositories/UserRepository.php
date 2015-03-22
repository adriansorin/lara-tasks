<?php namespace App\Repositories;

use App\User;
use Validator;

class UserRepository {

	/**
	 * Validate user properties
	 * @param  array  $data [description]
	 * @return Validator
	 */
	public function validate(array $data)
	{
		return Validator::make($data, [
			'username' => 'required|max:255|unique:users',
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'is_admin' => 'boolean',
			'password' => 'required|confirmed|min:6',
		]);
	}


	/**
	 * Create a new user
	 * @param  array  $data [description]
	 * @return User
	 */
	public function create(array $data)
	{
		$params = [
			'username' => $data['username'],
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'password' => bcrypt($data['password']),
		];

		if (array_key_exists('is_admin', $data)) {
			$params['is_admin'] = $data['is_admin'];
		}

		return User::create($params);

	}


	/**
	 * Delete a user
	 * @param  integer $id [description]
	 * @return [type]     [description]
	 */
	public function delete($id)
	{
		$user = User::find($id);

		return $user->delete();
	}


	/**
	 * Validate update of user data
	 * @param  array  $data [description]
	 * @return Validator
	 */
	public function validateEdit(array $data)
	{
		return Validator::make($data, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'is_admin' => 'boolean',
			'password' => 'confirmed|min:6',
		]);
	}


	/**
	 * Update user data
	 * @param  array  $data [description]
	 * @return User
	 */
	public function update(array $data)
	{
		$params = [
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
		];

		if (!empty($data['password'])) {
			$params['password'] = bcrypt($data['password']);
		}

		if (array_key_exists('is_admin', $data)) {
			$params['is_admin'] = $data['is_admin'];
		} else {
			$params['is_admin'] = '0';
		}

		return User::findOrFail($data['id'])->update($params);

	}


	/**
	 * Get tasks assigned to a user
	 * @return array
	 */
	public function getAssignedTasks($userId)
	{
		return User::leftJoin('user_tasks', function($join){
			$join->on('users.id', '=', 'user_tasks.user_id');
		})
		->leftJoin('tasks', function($join){
			$join->on('user_tasks.task_id', '=', 'tasks.id');
		})
		->select('tasks.id', 'tasks.name', 'tasks.description', 'tasks.due_date', 'tasks.status', 'user_tasks.user_id')
		->whereNotNull('user_tasks.task_id')
		->where('users.id', '=', $userId)
		->get()
		->toArray();
	}


	/**
	 * Validate status for admin users
	 * @param  array  $data [description]
	 * @return Validator
	 */
	public function validateStatusUser(array $data)
	{
		return Validator::make($data, [
			'id' => 'required|integer',
			'status' => 'required|in:new,in progress,done',
		]);
	}
}