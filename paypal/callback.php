<?php
include_once('../setup.php');

if(empty($_SESSION['paypal']['access_token'])) {

	$ch = curl_init("https://api.sandbox.paypal.com/v1/identity/openidconnect/tokenservice");

	curl_setopt_array($ch,
	  array(
	    CURLOPT_POST           => 1,
	    CURLOPT_POSTFIELDS     => 'client_id=ATT0HxAFzMYwAoRii7jF1okec0YkFoXgVTbKFVeNi43pTea5aBsdytj60FVR&client_secret=EDvHVhDM2-jGPxWhZrLHjUU8rMMiKpooJVcEHwsi8idlHAD11Rm6eLKOOxit&grant_type=authorization_code&code='.$_GET['code'],
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_SSL_VERIFYPEER => FALSE 
	  )
	);

	$response = curl_exec($ch);
	$auth = json_decode($response,true);
	
	$_SESSION['paypal']['refresh_token'] = $auth['refresh_token'];
	$_SESSION['paypal']['access_token'] = $auth['access_token'];

}


$ch = curl_init("https://api.sandbox.paypal.com/v1/identity/openidconnect/userinfo/?schema=openid");
curl_setopt_array($ch,
  array(
    CURLOPT_POST           => 0,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_SSL_VERIFYPEER => FALSE,
    CURLOPT_HTTPHEADER     => array("Authorization: Bearer ".$_SESSION['paypal']['access_token'])
  )
);
$response = curl_exec($ch);
$_SESSION['paypal']['user'] = json_decode($response,true);

$res = getUser();

if($res) {
	$sth = $dbh->prepare("UPDATE payapal_users SET twilio_number = ?, paypal_name = ?, paypal_email = ?, paypal_id = ?, paypal_city = ?, paypal_access_token = ?, paypal_refresh_token = ? WHERE id = ?");
	$sth->execute(array($_SESSION['paypal']['user']['phone_number'], $_SESSION['paypal']['user']['name'], $_SESSION['paypal']['user']['email'], $_SESSION['paypal']['user']['user_id'], $_SESSION['paypal']['user']['address']['locality'], $_SESSION['paypal']['access_token'], $_SESSION['paypal']['refresh_token'], $res['id']));
}
else {
	$sth = $dbh->prepare("INSERT INTO payapal_users (twilio_number, paypal_name, paypal_email, paypal_id, paypal_city, paypal_access_token, paypal_refresh_token) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$sth->execute(array($_SESSION['paypal']['user']['phone_number'], $_SESSION['paypal']['user']['name'], $_SESSION['paypal']['user']['email'], $_SESSION['paypal']['user']['user_id'], $_SESSION['paypal']['user']['address']['locality'], $_SESSION['paypal']['access_token'], $_SESSION['paypal']['refresh_token']));
}
$sth = $dbh->prepare("SELECT * FROM payapal_users WHERE paypal_id = ? LIMIT 1");
$sth->execute(array($_SESSION['paypal']['user']['user_id']));
$_SESSION['user'] = $sth->fetch(PDO::FETCH_ASSOC);


/*
$post["intent"] = "authorize";
$post["redirect_urls"]["return_url"] = "http://payapal.dyl.anjon.es/";
$post["redirect_urls"]["cancel_url"] = "http://payapal.dyl.anjon.es/?cancel";
$post["payer"]["payment_method"] = "paypal";
$post["transactions"][0]["amount"]["total"] = "50.00";
$post["transactions"][0]["amount"]["currency"] = "GBP";
$post["description"] = "Pay A Pal will send money to people you tweet #payapal";

$post = json_encode($post);
echo $post;
$ch = curl_init("https://api.sandbox.paypal.com/v1/payments/payment");

curl_setopt_array($ch,
  array(
    CURLOPT_POST           => TRUE,
    CURLOPT_POSTFIELDS     => $post,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_SSL_VERIFYPEER => FALSE,
    CURLOPT_HTTPHEADER     => array("Authorization: Bearer ".$_SESSION['paypal']['access_token'], "Content-type: application/json", "Content-length: ".strlen($post))
  )
);

$response = curl_exec($ch);
echo $_SESSION['paypal']['access_token'];
echo "<br><br><br>";
var_dump($response);
var_dump(curl_getinfo($ch));
*/

header('Location: /?paypal');

$dbh = null;
?>