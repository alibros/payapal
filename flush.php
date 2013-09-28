<?php
	include_once('setup.php');
	$sth = $dbh->prepare("TRUNCATE TABLE payapal_users");
	$sth->execute();
	$sth = $dbh->prepare("TRUNCATE TABLE payapal_tweets");
	$sth->execute();
	session_destroy();
	header('Location: /');
?>