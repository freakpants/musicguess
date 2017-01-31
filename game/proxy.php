<?php
// Set your return content type
header('Content-type: audio/mpeg');
header("Accept-Ranges:bytes");
header("Content-length:12000000");

$hash = $_GET['hash'];

// get username and pw for db
require("config.php");

// open connection
$dbh = new PDO('mysql:host=localhost;dbname=' . $dbname , $user, $password);
		
$sql = "SELECT stream_url FROM musicguess WHERE hash = :hash";
$sth = $dbh->prepare($sql);
$sth->execute(array(':hash' => $hash));
$daurl = $sth->fetchColumn();



$sql = "DELETE FROM musicguess WHERE hash = :hash";
$sth = $dbh->prepare($sql);
$sth->execute(array(':hash' => $hash));

// close connection
$dbh = null;
 
// Get that website's content
$handle = fopen($daurl, "r");


 
// If there is something, read and return
if ($handle) {
    while (!feof($handle)) {
        $buffer = fgets($handle, 4096);
        echo $buffer;
    }
    fclose($handle);
} else {
	echo 'handle filed';
}
?>