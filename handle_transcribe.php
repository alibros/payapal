<?php
include_once('setup.php');

$trans=$_REQUEST['TranscriptionText'];
$answer = strtolower($trans);
$song = $_GET['song_name'];
$tid = $_GET['tid'];

if (strpos($uns, $song) !== false) {
	$sth = $dbh->prepare("UPDATE payapal_tweets SET verify_song = 1 WHERE tid = ?");
	$sth->execute(array($tid))
}
else {
	$sth = $dbh->prepare("UPDATE payapal_tweets SET verify_song = -1 WHERE tid = ?");
	$sth->execute(array($tid))
}

?>