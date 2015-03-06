<?php
use Carbon\Carbon;

class ScreenshotApiController extends \BaseController {

    private $browserFields = ['id', 'browser', 'browser_version', 'os_version', 'device'];

	/**
	 * Display a listing of the resource.
	 * GET /screenshotapi
	 *
	 * @return Response
	 */
	public function index()
    {

        if(Input::get('name') && Input::get('search')){
            $name = Input::get('name');
            $reports = Report::where('name', 'LIKE', $name.'%')->orderBy('created_at', 'desc')->paginate(12);
        }
        else if(Input::get('name') && Input::get('view')){
            return $this->showAll();
            //return Redirect::action('ScreenshotApiController@showAll', Input::all());
        }
        else{
            $reports = Report::orderBy('created_at', 'desc')->paginate(12);
        }
        $data['reports'] = $reports;
        return View::make('screenshots.api.index', $data);
    }
    private function getBrowserGroupForApi()
    {
        $os = Browser::groupBy('os')->get()->toArray();
        $browsers = [];
        foreach($os as $item){
            $browsersByOs = Browser::where('os', 'LIKE', $item['os'])
                ->where('enabled', '=', '1')
                ->get($this->browserFields)->toArray();
            $browsers[] = ['os' => $item['os'], 'items' => $browsersByOs];
        }
        return $browsers;
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /screenshotapi/create
	 *
	 * @return Response
	 */
	public function create()
    {
        $data['os'] = $this->getBrowserGroupForApi();
        //return $data['browsers'];
        return View::make('screenshots.api.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /screenshotapi
	 *
	 * @return Response
	 */
	public function store()
	{

        $rules = ['name' => 'required|min:5','urls' => 'required', 'browsers' => 'required'];
        $validator = Validator::make(
            $data = Input::all(),
            $rules
        );

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $user = Auth::user();
        $browsers = Input::get('browsers');
        $name = Input::get('name');
        $schedule = Input::get('schedule');
        $selectedBrowsers = $this->getSelectedBrowsers($browsers);
        //browser stack has a problem with 15 browsers => 30 screenshots at the same time
        $groupCount = 10;
        if(Input::hasFile('urls'))
        {
            $file = Input::file('urls');
            //$filename = time() . '-' .$file->getClientOriginalName();
            $filename = time() . '.csv';
            $filepath = public_path().'/data/reports/';
            $file = $file->move($filepath, $filename);
            //$csv_file_contents = file_get_contents($filepath.$filename);
            $csv_file_parsed = Excel::load($filepath.$filename)->all()->toArray();
            $selectedBrowsers = array_chunk($selectedBrowsers, $groupCount);

            /* send notification when last link */
            $num_links = count($selectedBrowsers);
            foreach($csv_file_parsed as $key => $url){
                $num_groups = count($selectedBrowsers);
                foreach($selectedBrowsers as $group_key => $group){
                    if($key == $num_links-1 && $group_key == $num_groups-1){
                        $this->sendApiRequest($name, $user->id, $group, $url[0], $filename, $schedule, $key, true);
                    }
                    else{
                        $this->sendApiRequest($name, $user->id, $group, $url[0], $filename, $schedule, $key);
                    }
                }
            }
        }
        return Redirect::route('screenshots-api.index');
    }
    private function getSelectedBrowsers($browsers){
        $selectedBrowsers = Browser::whereIn('id', $browsers)->get(['browser', 'browser_version', 'os_version', 'device', 'os'])->toArray();
        $browsers = [];
        foreach($selectedBrowsers as $current){
            if(empty($current['browser_version'])){
                $current['browser_version'] = null;
            }
            if(!empty($current['device'])){
                $current['orientation'] = 'portrait';
                $browsers[] = $current;
                $current['orientation'] = 'landscape';
                $browsers[] = $current;
            }
            else{
                unset($current['device']);
                $browsers[] = $current;
            }
        }
        return $browsers;
    }
    private function sendApiRequest($name, $user_id, $browsers, $url, $filename, $schedule, $key, $notify = false){
        $data = ['browsers' => $browsers, 'url' => $url, 'wait_time' => 60, 'local' => true];
        $now = Carbon::now();
        $schedule = new Carbon($schedule);
        if($schedule->gte($now)){
            $date = $schedule->addSeconds($key*80);
        }
        else{
            $date = Carbon::now()->addSeconds($key*80);
        }
        $report = $this->createReportRecord($name, $filename, $url, $user_id, $date);
        Queue::later($date, 'ScreenshotsApi', ['data' => $data, 'notify' => $notify, 'report' => $report]);
    }
    /* Create report db record and return record */
    private function createReportRecord($name, $filename, $url, $user_id, $schedule){
        $report = new Report;
        $report->name = $name;
        $report->filename = $filename;
        $report->url = $url;
        $report->user_id = $user_id;
        $report->schedule = new Carbon($schedule);
        $report->save();
        return $report;
    }
    private function getScreenshotsData($job_id)
    {
        $client = new GuzzleHttp\Client();
        //$data = ['browsers' => $browsers, 'url' => $url];
        $url = "http://www.browserstack.com/screenshots/".$job_id.".json";
        $request = $client->createRequest('GET', $url, [
                'headers' => ['Content-type' => 'application/json'],
        ]
        );
        return $client->send($request)->json();
    }


	/**
	 * Display the specified resource.
	 * GET /screenshotapi/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $report = Report::find($id);
        $data['data'] = $this->getScreenshotsData($report->job_id);
        $data['report'] = $report;
        return View::make('screenshots.api.show', $data);
	}
	/**
	 * Display all screenshots for the filename
	 * GET /screenshotapi/all/{filename}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showAll()
    {
        $name = Input::get('name');
        $reports = Report::where('name', 'LIKE', $name.'%')->get();
        $screenshots = [];
        foreach($reports as $report){
            if(empty($report->job_id)) continue;
            $screenshots[] = $this->getScreenshotsData($report->job_id);
        }
        //display message if no screenshots found
        if(empty($screenshots)){
            return Redirect::route('screenshots-api.index')->withErrors(['Selected jobs were not processed yet. Please check date scheduled for '.$name]);
        }
        $data['screenshots'] = $screenshots;
        $data['report'] = $reports;
        return View::make('screenshots.api.all', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /screenshotapi/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /screenshotapi/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /screenshotapi/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
