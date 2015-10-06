## Browserstack Screenshots API

App to generate screenshots given a CSV with a list of URLS
- create user accounts and profile
- select enabled browsers
- schedule jobs to run at any time
- View screenshots by project name
- Email notifications when last job in a project is started

##Demo
http://youtu.be/6Y349Zugnmo

## Setup and Installation

###Required Software
- LAMP: MySQL, PHP >= 5.4, MCrypt PHP Extension
- Composer https://getcomposer.org/doc/00-intro.md
- Beanstalk http://kr.github.io/beanstalkd/download.html
- Beanstalk console https://github.com/ptrofimov/beanstalk_console
- Supervisor http://supervisord.org/installing.html
- Mandrill Key https://mandrill.com/
- Browserstack Screenshots API usr/pwd http://www.browserstack.com/screenshots/api
- Example configuration file .env.example.php should be updated and copied over to corresponding file. For example, .env.prod.php (based on APP_ENV environment variable)

###Configuration
1. copy `.env.example.php` to `.env.php`
2. fill in blanks in `.env.php` with correct info: keys, email etc
3. edit apache config for the site (On Ubuntu it's located in `/etc/apache2/sites-enabled/automation.conf` in my case)
4. add the following: `SetEnv APP_ENV production`
5. restart apache (On Ubuntu command is: `sudo service apache2 restart` )

###Installation
```
composer install
php artisan migrate
php artisan db:seed
```
###Refresh Browser List
```
php artisan db:seed --class="BrowserTableSeeder"
```
###Configure Supervisor
Restarting
```
sudo service supervisor start
sudo supervisorctl reload
```

/etc/supervisor/conf.d/queue.conf
```
[program:queue]
command=php artisan queue:listen
directory=/home/vagrant/laravel-root/automation
stdout_logfile=/home/vagrant/laravel-root/automation/app/storage/logs/supervisor.log
redirect_stderr=true
```

supervisorctl
```
supervisor> status
supervisor> reread
queue: available
supervisor> add queue
queue: added process group
supervisor> start queue
queue: ERROR (already started)
supervisor> status
queue                            RUNNING    pid 27174, uptime 0:00:11
```


###Recommendations
- Local installations should use homestead, as it provides ready to use system http://laravel.com/docs/4.2/homestead
- Digitalocean provides LAMP image with most software pre-installed. Feel free to use a referral link for a $10 credit: https://www.digitalocean.com/?refcode=40a47f269a5b


Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).


