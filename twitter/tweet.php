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

header('Location: /');
?>