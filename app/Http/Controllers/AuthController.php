<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Http\Request;

class AuthController extends Controller {

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;

		$this->middleware('guest', ['except' => 'logout']);
	}

	/**
	 * Show login page
	 * 
	 * @return Response
	 */
	public function index()
	{
		return view('login');
	}


	/**
	 * Login user
	 * @param  Request $request [description]
	 * @return Response
	 */
	public function login(Request $request)
	{
		$this->validate($request, [
			'username' => 'required', 'password' => 'required',
		]);

		$credentials = $request->only('username', 'password');

		if ($this->auth->attempt($credentials))
		{
			if ($this->auth->user()->is_admin)
			{
				return redirect()->intended('/admin');
			}
			else
			{
				return redirect()->intended('/user');
			}
		}

		return redirect('/')->withInput($request->only('username', 'password'))->withErrors([
			'username' => 'These credentials do not match our records.',
		]);
	}


	/**
	 * Logout user
	 * @return Response
	 */
	public function logout()
	{
		$this->auth->logout();

		return redirect('/');
	}

}
