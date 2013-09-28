<?php
	include_once('setup.php');
	$dbh->execute("TRUNCATE TABLE payapal_users");
	$dbh->execute("TRUNCATE TABLE payapal_tweets");
	session_destroy();
 
	header('Location: /');
?>