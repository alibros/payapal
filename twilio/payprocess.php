<?php
include_once('../setup.php');

$digits=$_GET['Digits'];
$tid=$_GET['tid'];
$code = $_GET['code'];

if ($digits==$code) {
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	echo "<Response><Say>Thank you. your request has been successfully processed. Goodbye!</Say></Response>";

	$sth = $dbh->prepare("UPDATE payapal_tweets SET verify_pin = 1 WHERE id = ?");
	$sth->execute(array($tid));
}
else {
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	echo "<Response><Say> Oops. that was wrong. your phone will now explode in 3, 2, 1</Say>
	<Play>http://payapal.dyl.anjon.es/twilio/bomb.mp3</Play>
	</Response>";
	$sth = $dbh->prepare("UPDATE payapal_tweets SET verify_pin = -1 WHERE id = ?");
	$sth->execute(array($tid));
}

?>