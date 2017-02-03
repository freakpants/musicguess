<?php
header("Content-Type: text/html");
// get username and pw for db
require("config.php");

if( isset( $_GET['login']) ){
	// get a mastertoken
	// exec("D:/nodejs/node.exe D:/playmusic/login.js", $output);
	// echo $output[0];
} else{
	if( isset( $_POST['track_id'] ) && $_POST['track_id'] !== '' ){
		$arg = escapeshellarg ( $_POST['track_id'] );
		exec("node ../get_stream_url_by_track_id.js " . $arg, $output);

		$stream_url = $output[0];
		$stream_url = json_decode($output[0])[0]->streamUrl;

		// turn streamurl into proxyurl, create acccess hash, save access hash to db
		$hash = hash ( "md5" , $stream_url );

		// open connection
		$dbh = new PDO('mysql:host=localhost;dbname=' . $dbname , $user, $password);

		$sql = "INSERT INTO musicguess (hash, stream_url) VALUES ('$hash', '$stream_url')";
		$dbh->query($sql);

		// close connection
		$dbh = null;

		echo json_encode($hash);

	} else {
		
		// open connection
		/* $dbh = new PDO('mysql:host=localhost;dbname=' . $dbname , $user, $password);



		$sql = "SET NAMES 'utf-8'";
		$dbh->query($sql);
		
		exec("node ../get_library.js", $output);
		$items = json_decode($output[0]);
		foreach( $items as $item ){
			$artist = utf8_decode( $item->artist );
			$title = utf8_decode( $item->title );
			
			$sql = "INSERT INTO tracks ( artist, title ) VALUES (:artist, :title)";
			$sth = $dbh->prepare($sql);
			$sth->execute(array(":artist" => $artist, ":title" => $title));
		}	
		
		// close connection
		$dbh = null; */
	}
}
  
