<?php
include_once('../setup.php');

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);
$tweets = $connection->get('search/tweets', array('q' => '#payapal'));
$tweets = json_decode(json_encode($tweets), true);
print_r($tweets);

$tweet_search = $dbh->prepare("SELECT * FROM payapal_tweets WHERE tweet_id = ?");
$user_search = $dbh->prepare("SELECT * FROM payapal_users WHERE twitter_id = ?");
$insert = $dbh->prepare("INSERT INTO payapal_tweets (tweet_id, from_handle, from_id, to_handle, to_id, text, amount) VALUES (?, ?, ?, ?, ?, ?, ?)");

for ($a=0; $a<count($tweets['statuses']); $a++) {
	$tweet = $tweets['statuses'][$a];

	if(empty($tweet['in_reply_to_screen_name'])) {
		echo "Not directed to anyone\n";
	}
	else {
		$tweet_search->execute(array($tweet['id_str']));
		$res = $tweet_search->fetch(PDO::FETCH_ASSOC);

		if (!empty($res)) {
			echo "It exists already\n";
		}
		else {

			$pieces = explode(" ", $tweet['text']);
			for ($i = 0; $i < count($pieces); ++$i) {
			    if ($pieces[$i]=="pounds" || $pieces[$i]=="quid") {
			    	$value = $pieces[$i-1];
			    } 
			    else if (strpos($pieces[$i], "£") !== false) {
			       $value = substr($pieces[$i],2);
			   }
			}

			if (!isset($value)) {
				echo "No value in this tweet\n";
			}
			else {
				$insert->execute(array($tweet['id_str'], $tweet['user']['screen_name'], $tweet['user']['id_str'], $tweet['in_reply_to_screen_name'], $tweet['in_reply_to_user_id_str'], $tweet['text'], $value));
				$tid = $dbh->lastInsertId();

				$user_search->execute(array($tweet['in_reply_to_user_id_str']));
				$user = $user_search->fetch(PDO::FETCH_ASSOC);

				if(!$user) {
					echo "User not found\n";
				}
				else {
					$_GET['tid'] = 1;
					$_GET['phone'] = $user['twilio_number'];
					$_GET['code'] = $user['twilio_pin'];
					$_GET['name'] = $user['twitter_name'];
					include('../paycallrequest.php');
				}
			}
		}
	}
}
?>