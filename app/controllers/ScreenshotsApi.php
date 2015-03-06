<?php
use Carbon\Carbon;

class ScreenshotsApi {
   public function fire($job, $data){

        if ($job->attempts() > 1)
        {
            $job->delete();
        }
        $config = Config::get('app.browserstack');
        //Log::info($data);
        $client = new GuzzleHttp\Client();
        $request = $client->createRequest('POST', 'http://www.browserstack.com/screenshots', [
                'headers' => ['Content-type' => 'application/json'],
                'auth' =>  [$config['username'], $config['password']],
                'body' => json_encode($data['data'])
        ]
        );
        $response = $client->send($request);
        $response = $response->json();

        $report = Report::find($data['report']['id']);
        $report->job_id = $response['job_id'];
        $report->save();
        if($data['notify']){
            $user = User::find($report->user_id);
            if($user){
                Mail::send('emails.jobcompleted', array('filename' => $report->filename), function($message) use ($user)
                {
                        $message->to($user->email, $user->username)->subject('Browserstack Job completed ');
                });
            }
        }
        $job->delete();
    }
}

