<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\UserRepository;

class AdminController extends Controller {

	public function __construct(Guard $auth, UserRepository $user)
	{
		$this->auth = $auth;
		$this->user = $user;

		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$users = User::all();

		return view('admin', ['users' => $users]);
	}


	/**
	 * Show form for adding new user
	 * @return Response
	 */
	public function getAdduser()
	{
		return view('adduser');
	}


	/**
	 * Add new user
	 * @param  Request        $request [description]
	 * @return Response
	 */
	public function postAdduser(Request $request)
	{
		$validate = $this->user->validate($request->all());

		if ($validate->fails())
		{
			$this->throwValidationException(
				$request, $validate
			);
		}

		$this->user->create($request->all());

		return response()->json(['success' => ['User succesfully created.']]);

	}


	/**
	 * Delete a user
	 * @param  Request $request [description]
	 * @return Response
	 */
	public function postDeleteuser(Request $request)
	{
		$this->user->delete($request->id);

		return response()->json(['success' => ['User succesfully deleted.']]);
	}


	/**
	 * Show update user details form
	 * @param  integer $id [description]
	 * @return Response
	 */
	public function getEdituser($id)
	{
		$user = User::findOrFail($id);

		return view('edituser', ['user' => $user]);
	}


	/**
	 * Update user settings
	 * @param  Request $request [description]
	 * @return Response
	 */
	public function postEdituser(Request $request)
	{
		$validate = $this->user->validateEdit($request->all());

		if ($validate->fails())
		{
			$this->throwValidationException(
				$request, $validate
			);
		}

		$this->user->update($request->all());

		return response()->json(['success' => ['User succesfully updated.']]);
	}

	
	/**
	 * Search users
	 * @param  Request $request [description]
	 * @return Response
	 */
	public function postSearch(Request $request)
	{
		if (trim($request->username) == '')
		{
			$users = User::all();
		}
		else
		{
			$users = User::where('username', '=', $request->username)->get();
		}

		return view('admin', ['users' => $users]);
	}

}
