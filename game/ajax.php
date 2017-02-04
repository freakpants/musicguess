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
		$dbh = new PDO('mysql:host=localhost;dbname=' . $dbname , $user, $password);

		$sql = "SET NAMES 'utf-8'";
		$dbh->query($sql);
		
		$sql = "SELECT * FROM tracks";
		$sth = $dbh->prepare($sql);
		$sth->execute();
		$results = $sth->fetchAll();

		// close connection
		$dbh = null;
		
		foreach ( $results as &$result ){
			$result['artist'] = utf8_encode( $result['artist'] );
			$result['title'] = utf8_encode( $result['title'] );
			$result['itunes_artist'] = utf8_encode( $result['itunes_artist'] );
			$result['itunes_title'] = utf8_encode( $result['itunes_title'] );
			
			unset($result[0]);
			unset($result[1]);
			unset($result[2]);
			unset($result[3]);
			unset($result[4]);
			unset($result[5]);
			unset($result[6]);
		}
		
		$json = json_encode($results);
	
		echo $json;		
	}
}
  
