<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'users';

    static function getRules($userid = null){
        $rules = array(
            'username'             => 'required',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required',
            'password_confirm' => 'required|same:password'
        );
        if(!empty($userid)){
            $rules['email'] .= ','.$userid;
        }
        return $rules;
    }



	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = array('username', 'email');

    public function roles() {
        return $this->belongsToMany('Role')->withTimeStamps();
    }

    public function hasRole($name) {
        foreach($this->roles as $role){
            if($role->name == $name){
                return true;
            }
        }
        return false;
    }

    public function assignRole($role) {
        $this->roles()->attach($role);
    }

    public function removeRole($role) {
        $this->roles()->detach($role);
    }


}
