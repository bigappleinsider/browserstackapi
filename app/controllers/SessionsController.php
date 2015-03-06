<?php

class SessionsController extends \BaseController {
	public function profile()
    {
        $data['auth'] = Auth::user();
		return View::make('sessions.profile', $data);
	}
	public function profileSave()
    {
        $rules = array(
            'username'             => 'required',
            'name'             => 'required',
            'email'            => 'required|email',
            //'email'            => 'required|email|unique:users',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::route('sessions.profile')->withErrors($validator);
        }
        else {
            $user = Auth::user();
            $user->username = Input::get('username');
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            return Redirect::route('sessions.profile')->with('success', 'Profile is Saved Successfully');
        }
    }
    public function changePassword()
    {
        $rules = array(
            'password'         => 'required',
            'password_confirm' => 'required|same:password'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::route('sessions.profile')->withErrors($validator);
        }
        else {
            $user = Auth::user();
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            return Redirect::route('sessions.profile')->with('success', 'Profile is Saved Successfully');
        }

    }



	/**
	 * Show the form for creating a new resource.
	 * GET /sessions/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sessions
	 *
	 * @return Response
	 */
	public function store()
    {
        $input = Input::all();
        $attempt = Auth::attempt([
            'email' => $input['email'],
            'password' => $input['password'],
        ]);

        if($attempt) return Redirect::route('screenshots-api.index')->with('flash_message', 'You have been logged in!');
        return Redirect::back()->with('flash_message', 'Invalid credentials')->withInput();
    }
	/**
	 * Remove the specified resource from storage.
	 * DELETE /sessions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
    {
        Auth::logout();
        return Redirect::home()->with('flash_message', 'You have been logged out');
	}

}
