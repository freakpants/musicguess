"# musicguess" - a simple music guessing game for airconsole

requires php/msql/airconsole

Instructions:

- extract directory into root of webserver or subdirectory
- run the sql in musicguess.sql and tracks.sql in your database to create the necessary tables
- create /game/config.php with the mysql credentials:  
```php
	<?php
	$dbname = 'dbname';
	$user = 'username';
	$password = 'password';
	?>
```
- test your game by navigating to http://www.airconsole.com/simulator/#PATH_TO_YOUR_WEBSERVER/game/
