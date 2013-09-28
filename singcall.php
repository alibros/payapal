<?php
// Include the Twilio PHP library
require 'Services/Twilio.php';
	// Set our Account SID and AuthToken
	$sid = 'AC6fa8f5aa611cd0524b8134645666ac0f';
	$token = 'abdfd4c57c28f7c9727c51e6cc93d894';
	
	// A phone number you have previously validated with Twilio
	$phonenumber = 	$_GET['phone'];
	// Instantiate a new Twilio Rest Client
	$client = new Services_Twilio($sid, $token, $version);

	try {
		// Initiate a new outbound call
		$call = $client->account->calls->create(
			'+441744582325',   // The number of the phone initiating the call
			$phonenumber, // The number of the phone receiving call
			urlencode('http://payapal.dyl.anjon.es/singxml.php?song_name='.$_GET['song_name']."&tid=".$_GET['tid']."&song_url=".$_GET['song_url']) // The URL Twilio will request when the call is answered
		);
		echo 'Started call: ' . $call->sid;
	} catch (Exception $e) {
		echo 'Error: ' . $e->getMessage();
	}
?>

