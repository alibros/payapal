<?php
include_once('../setup.php');

/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/verify_credentials');
$_SESSION['twitter']['user'] = json_decode(json_encode($content), true);

$res = getUser();

if($res) {
	$sth = $dbh->prepare("UPDATE payapal_users SET twitter_name = ?, twitter_handle = ?, twitter_oauth_token = ?, twitter_oauth_token_secret = ?, twitter_location = ? WHERE id = ?");
	$sth->execute(array($_SESSION['twitter']['user']['name'], $_SESSION['twitter']['user']['screen_name'], $access_token['oauth_token'], $access_token['oauth_token_secret'], $_SESSION['twitter']['user']['location'], $res['id']));
}
else {
	$sth = $dbh->prepare("INSERT INTO payapal_users (twitter_id, twitter_name, twitter_handle, twitter_oauth_token, twitter_oauth_token_secret, twitter_location) VALUES (?, ?, ?, ?, ?, ?)");
	$sth->execute(array($_SESSION['twitter']['user']['id_str'], $_SESSION['twitter']['user']['name'], $_SESSION['twitter']['user']['screen_name'], $access_token['oauth_token'], $access_token['oauth_token_secret'], $_SESSION['twitter']['user']['location']));
}
$sth = $dbh->prepare("SELECT * FROM payapal_users WHERE twitter_id = ? LIMIT 1");
$sth->execute(array($_SESSION['twitter']['user']['id_str']));
$_SESSION['user'] = $sth->fetch(PDO::FETCH_ASSOC);

header('Location: /');

$dbh = null;
?>