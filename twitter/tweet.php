<?php
include_once('../setup.php');

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

if(empty($_POST['tweet'])) {
	header('Location: /');
	exit();
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user['twitter_oauth_token'], $user['twitter_oauth_token_secret']);
$status = $connection->post('statuses/update', array('status' => $_POST['tweet']));

if(!empty($user['twilio_pin'])) {
	$pin = rand(pow(10, 3), pow(10, 4)-1);
	echo $pin;
	$sth = $dbh->prepare("UPDATE payapal_users SET twilio_pin = ? WHERE id = ?");
	$sth->execute(array($pin, $user['id']));
}

header('Location: /?tweeted');
?>