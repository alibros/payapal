<?php
session_start();

function dbh() {
	try {
		$dbh = new PDO("mysql:host=localhost;dbname=dylan8902_main;charset=utf8", "dylan8902_main", "encarta2");
	}
	catch(PDOException $e) {
		error(503, "The database has gone walkabout! :(");
	}
	if(!$dbh) {
		error(503, "The database has gone walkabout! :(");
	}
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	return $dbh;
}

function getUser() {
	global $dbh;
	$sth = $dbh->prepare("SELECT * FROM payapal_users WHERE twitter_id = ? LIMIT 1");
	$sth->execute(array($_SESSION['twitter']['user']['id_str']));
	return $sth->fetch(PDO::FETCH_ASSOC);
}

$dbh = dbh();
$user = getUser();

?>
