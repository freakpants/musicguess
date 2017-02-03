<?php
// get username and pw for db
require("config.php");
error_reporting(E_ALL);

// open connection
$dbh = new PDO('mysql:host=localhost;dbname=' . $dbname , $user, $password);
		
$sql = "SET NAMES 'utf-8'";
$dbh->query($sql);
		
$sql = "SELECT pkey,artist,title FROM tracks WHERE itunes_id = 0 ORDER BY RAND()";
$sth = $dbh->prepare($sql);
$sth->execute();
$results = $sth->fetchAll();


$counter = 0;

foreach( $results as $data ){
	if( $counter === 20){
		break;
	}
	$title = preg_replace('/\s+/', '+', utf8_encode($data['title']));
	$artist = preg_replace('/\s+/', '+', utf8_encode($data['artist']));
	$pkey = $data['pkey'];
	
	$url = "https://itunes.apple.com/search?media=music&entity=song&term=" . $title . '+' . $artist;
	
	$string = file_get_contents( $url );
	$object = json_decode($string);
	
	$result = $object->results[0];
	
	echo $url.'</br>';
	
	// var_dump($string);

	if( isset($result->previewUrl) ){
		
		$itunes_id = $result->trackId;
		$preview = $result->previewUrl;
		$artist =  utf8_decode($result->artistName);
		$title =  utf8_decode($result->trackName);
		
		echo '<a href="' . $preview . '">' . $artist . ' - ' . $title .'</a></br>';

		
		$sql = "UPDATE tracks SET itunes_id = :id, itunes_artist = :artist, itunes_title = :title, preview_url = :preview WHERE pkey = :pkey";
		
		$sth = $dbh->prepare($sql);
		$sth->execute(
			array(
				":id" => $itunes_id, 
				":artist" => $artist,
				":title" => $title,
				":preview" => $preview,
				":pkey" => $pkey
			)
		);
		
		// echo $sql.'</br>';
	}
	
	$counter++;
}

// close connection
$dbh = null;
?>