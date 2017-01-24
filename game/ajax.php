<?php
  header("Content-Type: text/html");
  if( isset( $_POST['track_id'] ) && $_POST['track_id'] !== '' ){
	$arg = escapeshellarg ( $_POST['track_id'] );
	exec("D:/nodejs/node.exe D:/playmusic/get_stream_url_by_track_id.js " . $arg, $output);
  } else {
	exec("D:/nodejs/node.exe D:/playmusic/get_library.js", $output);  
  }
  
  echo implode('', $output);