<?php
// Get the PHP helper library from twilio.com/docs/php/install
require_once('Services/Twilio.php'); // Loads the library
 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC6fa8f5aa611cd0524b8134645666ac0f"; 
$token = "abdfd4c57c28f7c9727c51e6cc93d894"; 
$client = new Services_Twilio($sid, $token);
 
$client->account->messages->sendMessage("+441744582325", $_GET['phone'], "GREAT SUCCESS! You have succesfully paid ".$_GET['amount']." pounds to ".$_GET['name']);
?>