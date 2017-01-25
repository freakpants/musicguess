"# musicguess" - a simple music guessing game for airconsole

requires node/php/msql/airconsole

Instructions:

- extract directory into root of webserver or subdirectory
- create /game/config.php with the mysql credentials:
	```php
	<?php
	$user = 'username';
	$password = 'password';
	?>
	```
- create /config.js with the google play credentials:
	```Javascript
	function email(){
		return "emailadress";
	}
	function pw() {
		return 'password';
	}
	module.exports.email = email;
	module.exports.pw = pw;
	```
	
	NOTE: If you are using 2FA on your google account, you need to provide an App
	Password instead. These are created on https://myaccount.google.com/apppasswords
	
- run npm install in the directory root (this should install the playmusic package)

- test your game by navigating to http://www.airconsole.com/simulator/#PATH_TO_YOUR_WEBSERVER/game/