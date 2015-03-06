<?php

class BrowsersController extends \BaseController {

	/**
	 * Display a listing of browsers
	 *
	 * @return Response
	 */
	public function index()
    {
        $data = Input::all();
        if(empty($data['num'])){
            $data['num'] = 10;
        }
        if(empty($data['page'])){
            $data['page'] = 1;
        }

        if(empty($data['sortBy'])){
            $data['sortBy'] = 'id';
        }
        if(!empty($data['direction']) && $data['direction'] == 'desc'){
            $data['direction'] = 'asc';
        }
        else{
            $data['direction'] = 'desc';
        }

        $browsers = Browser::orderBy($data['sortBy'], $data['direction'])
            ->paginate($data['num']);


		return View::make('browsers.index', ['browsers' => $browsers, 'data' => $data]);
	}

	/**
	 * Show the form for creating a new browser
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('browsers.create');
	}
	/**
	 * Store a newly created browser in storage.
	 *
	 * @return Response
	 */
	public function store()
    {
        /*
		$validator = Validator::make($data = Input::all(), Browser::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        Browser::create($data);
         */
        $data = Input::all();
        $checked = array_values($data['enabled']);
        if($data['action'] == 'enable'){
            DB::table('browsers')
                ->whereIn('id', $checked)
                ->update(array('enabled' => 1));
        }
        else if($data['action'] == 'disable'){
             DB::table('browsers')
                ->whereIn('id', $checked)
                ->update(array('enabled' => 0));
        }

        return Redirect::back()->with('message_success','Operation Successful !');
		//return Redirect::route('browsers.index');
	}

	/**
	 * Display the specified browser.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$browser = Browser::findOrFail($id);

		return View::make('browsers.show', compact('browser'));
	}

	/**
	 * Show the form for editing the specified browser.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$browser = Browser::find($id);

		return View::make('browsers.edit', compact('browser'));
	}

	/**
	 * Update the specified browser in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$browser = Browser::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Browser::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$browser->update($data);

		return Redirect::route('browsers.index');
	}

	/**
	 * Remove the specified browser from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Browser::destroy($id);

		return Redirect::route('browsers.index');
	}

}
