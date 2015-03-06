<?php

class Report extends \Eloquent {
	protected $fillable = ['filename', 'url', 'job_id', 'state', 'user_id', 'name'];
}
