<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('BrowserTableSeeder');
		//$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
	DB::statement("SET foreign_key_checks=0");
	Report::truncate();
	User::truncate();
	DB::statement("SET foreign_key_checks=1");
        $admin = Role::create(['name' => 'admin']);
        $member = Role::create(['name' => 'member']);
        $config = Config::get('app.admin');
        $user = new User;
        $user->username = $config['name'];
        $user->email = $config['email'];
        $user->password = Hash::make($config['password']);
        $user->save();
        $user->assignRole($admin);
        $user->assignRole($member);

        //$user->roles()->attach()->withTimestamps();

    }

}


class BrowserTableSeeder extends Seeder {

    public function run()
    {
        $browsers = file_get_contents('http://www.browserstack.com/screenshots/browsers.json');
        $browsers = json_decode($browsers, true);
        Browser::truncate();
        Browser::insert($browsers);

    }

}



/*
DB::table('users')->delete();
User::create(array('email' => 'foo@bar.com'));
*/

/*
        $mongo = new MongoClient('mongodb://automate:7gGyTAJv@ds053160.mongolab.com:53160/automate');
        $collection = $mongo->automate->browsers;
        $collection->drop();

        $collection->batchInsert($browsers);


*/
