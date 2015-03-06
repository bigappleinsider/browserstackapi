<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::orderBy('created_at', 'desc')->paginate(12);

		return View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
    {
        $data = [];
        //$data['roles'] = Role::all();
        $data['roles'] = DB::table('roles')->lists('name','id');
		return View::make('users.create', $data);
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), User::getRules());

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user = User::create($data);
        $user->password = Hash::make($data['password']);
        $user->save();
        $role = Role::find($data['role']);
        $user->assignRole($role);
		return Redirect::route('users.index');
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = User::findOrFail($id);
        //print_r($user->roles());
        /*
        exit;
        foreach($user->roles as $r){
            //print_r($r->name);
            $role = Role::find($r->id);
            break;
        }
         */

        $roles = DB::table('roles')->lists('name','id');
		return View::make('users.edit', compact('user', 'roles'));
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);

		$validator = Validator::make($data = Input::all(), User::getRules($id));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $user->update($data);

        $user->password = Hash::make($data['password']);
        $user->save();



		return Redirect::route('users.index');
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(Auth::user()->id == $id){
		    return Redirect::route('users.index')->withErrors(['error', 'Operation not permitted by design. Admin user may not delete his own account']);
        }
		User::destroy($id);

		return Redirect::route('users.index');
	}

}
