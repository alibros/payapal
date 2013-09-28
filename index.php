<?php
include_once('setup.php');
$dbh = null;
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<title>Pay A Pal</title>
	<meta name="description" content="Twitter Bootstrap Parallax Tutorial with HTML5 / CSS3 / JavaScript">
	<meta name="author" content="Dylan Jones, Ali Bros">

	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="js/jquery-1.6.1.min.js"></script>

	<style type="text/css">
		html {
			text-align: center;
		}
		#intro { 
			background: #0079C1; 
			height: auto;  
			margin: 0 auto; 
		    width: 100%; 
		    position: relative; 
		    box-shadow: 0 0 50px rgba(0,0,0,0.8);
		    padding: 50px 0;
		}
		#home { 
			background: url(images/home.jpg) 50% 0 fixed; 
			height: auto;  
			margin: 0 auto; 
		    width: 100%; 
		    position: relative; 
		    box-shadow: 0 0 50px rgba(0,0,0,0.8);
		    padding: 50px 0;
		}
		#about { 
			background: url(images/about.png) 50% 0 fixed; 
			height: auto;
			margin: 0 auto; 
		    width: 100%; 
		    position: relative; 
		    box-shadow: 0 0 50px rgba(0,0,0,0.8);
		    padding: 100px 0;
		    color: #fff;
		}
		#paypal-well, #twitter-well {
			min-height: 175px;
		}
		h3 a {
			margin-top: 10px;
		}

		/* Non-essential demo stuff */
		.hero-unit {
			background-color: #fff;
		    box-shadow: 0 0 20px rgba(0,0,0,0.1);
		}
		.media-object { width: 64px; height: 64px; padding-bottom: 30px }
		#who img {
			border-radius: 30px;
		}
	</style>

</head>

<body>

	<!-- Section #1 -->
	<section id="intro" data-speed="6" data-type="background">
		<div class="container">
	    	<div class="hero-unit">
	    		<h1><img src="/images/logo.png" alt="Pay A Pal"></h1>
	    		<small style="text-align:right">powered by paypal</small>
	    	</div>
	    </div>
	</section>

	<!-- Section #2 -->
	<section id="home" data-speed="4" data-type="background">
		<div class="container">
			<div class="row-fluid">
		        <div id="twitter-well" class="span6 well">
		          <h2>Register your Twitter</h2>
		          <h3>
		          <?php
		          	if(empty($user['twitter_id']))
		          		echo "<a href=\"/twitter/redirect.php\" class=\"btn btn-large btn-primary\">Twitter</a>";
		          	else
					    echo "<img src=\"images/check.png\"> ".$user['twitter_handle']."";
		          ?>
		          </h3>
		        </div>
		        <div id="paypal-well" class="span6 well">
		          <h2>Register your PayPal</h2>
		          <h3>
		          <?php
		          	if(empty($user['paypal_id']))
		          		echo "<a href=\"https://www.sandbox.paypal.com/webapps/auth/protocol/openidconnect/v1/authorize?response_type=code&scope=openid+profile+email+address+email+phone+https%3A%2F%2Furi.paypal.com%2Fservices%2Fexpresscheckout&client_id=ATT0HxAFzMYwAoRii7jF1okec0YkFoXgVTbKFVeNi43pTea5aBsdytj60FVR&redirect_uri=http%3A%2F%2Fpayapal.dyl.anjon.es%2Fpaypal%2Fcallback.php\" class=\"btn btn-large btn-default\">Paypal</a>";
		          	else
					    echo "<img src=\"images/check.png\"> ".$user['paypal_email']."";
		          ?>
		          </h3>
		        </div>
	    	</div>

			<?php if(isset($_GET['tweeted'])) { ?>
	    	<div class="row-fluid">
		        <div id="sent-well" class="span12 well">
		          <h2>TWEET SENT</h2>
		          <a href="/">send another</a>
		        </div>
	    	</div>

	    	<script type="text/javascript">
	    	$(document).ready(function() {
				$('html, body').animate({
			        scrollTop: $("#sent-well").offset().top
			    }, 3000);
	    	});
	    	</script>

	    	<div class="row-fluid">
		        <div id="map-well" class="span12 well">
		          <h2>Map</h2>
		          <img src="https://maps.googleapis.com/maps/api/staticmap?center=51.99651,%20-0.74276&amp;zoom=10&amp;size=900x300&amp;sensor=true">
		        </div>
	    	</div>

	    	<?php if(!empty($user['twilio_pin'])) { ?>
	    	<div class="row-fluid">
		        <div id="pin-well" class="span12 well">
		          <h2>Verification PIN #</h2>
		          <p style="margin-bottom:30px">We are calling your phone: +447747466782, please enter the following code:</p>
		          <code style="font-size:32pt"><?php echo $user['twilio_pin']; ?></code>
		        </div>
	    	</div>
	    	<?php } ?>

	    	<?php } else if((!empty($user['paypal_id'])) && (!empty($user['twitter_id']))) { ?>
	    	<div class="row-fluid">
		        <div id="tweet-well" class="span12 well">
		          <h2>Send a tweet</h2>
		          <div class="input-append">
		          	<form action="/twitter/tweet.php" method="post">
		          		<input type="text" name="tweet" value="@ali_bros here's the &pound;1 I owe you! #payapal" class="input-xxlarge">
		            	<button id="tweet" class="btn btn-warning">Tweet</button>
		            </form>
  				  </div>
		        </div>
	    	</div>
	    	<?php } ?>

	    </div>
	</section>

	<!-- Section #3 -->
	<section id="about" data-speed="2" data-type="background">
		<div class="container">
			<div class="page-header">
				<h1>What is this?</h1>
			</div>
			<div class="row-fluid">
		        <div class="span8 text-left">
		          	<h2>Over The Air 2013</h2>
		          	<h3>27th - 28th September, 2013</h3>
		        </div>
		        <div class="span4 text-right">
		        	<a href="https://github.com/alibros/payapal" class="btn btn-large btn-default">It's on Github!</a>
		        </div>
			</div>
			<div class="row-fluid">

		        <div class="span4">
		        	<h2>What?</h2>
		          	<div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="images/padlock.png">
						</a>
						<div class="media-body text-left">
						    <h4 class="media-heading">Quadruple Authentication</h4>
						    Your account is safe with Twitter auth, PayPal auth, Verified Phone Number Confirmed and Audio Message. The new authentication standard. 
						</div>
					</div>
		         	<div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="images/check.png">
						</a>
						<div class="media-body text-left">
						    <h4 class="media-heading">Social</h4>
						    The perfect tool for publicly thanking your pals for lending you money. Let the world know how generous they are.
						</div>
					</div>
		         	<div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="images/check.png">
						</a>
						<div class="media-body text-left">
						    <h4 class="media-heading">Simple</h4>
						    You can send people money in a casual tweet with the addition of a hashtag. Wowza!
						</div>
					</div>
				</div>

		        <div class="span4">
		        	<h2>How?</h2>
		         	<div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="/images/twitter.png">
						</a>
						<div class="media-body text-left">
						    <h4 class="media-heading">Twitter</h4>
						    Used for sign in and sending and receiving payment notifications.
						</div>
					</div>
		         	<div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="/images/paypal.png">
						</a>
						<div class="media-body text-left">
						    <h4 class="media-heading">Paypal</h4>
						    Sign in and the payment bit.
						</div>
					</div>
		         	<div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="/images/twilio.png">
						</a>
						<div class="media-body text-left">
						    <h4 class="media-heading">Twilio</h4>
						    For the extra authentication fun.
						</div>
					</div>
		        </div>

		        <div id="who" class="span4">
		          <h2>Who?</h2>
		          <div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="/images/dylan.jpg">
						</a>
						<div class="media-body text-left">
						    <h4 class="media-heading">Dylan Jones</h4>
						    A software engineer at BT in Cardiff.
						    <p><a href="http://twitter.com/dylan8902">@dylan8902</a></p>
						</div>
					</div>
		         	<div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="/images/ali.jpg">
						</a>
						<div class="media-body text-left">
						    <h4 class="media-heading">Ali Bros</h4>
						    Mobile application maker for some company.
						    <p><a href="http://twitter.com/ali_bros">@ali_bros</a></p>
						</div>
					</div>
		        </div>

	    	</div>
	    </div>
	</section>

	<script src="https://www.paypalobjects.com/js/external/api.js"></script>
	<script>
	paypal.use( ["login"], function(login) {
	  login.render ({
	    "appid": "ATT0HxAFzMYwAoRii7jF1okec0YkFoXgVTbKFVeNi43pTea5aBsdytj60FVR",
	    "authend": "sandbox",
	    "scopes": "profile email address phone https://uri.paypal.com/services/paypalattributes",
	    "containerid": "paypal",
	    "locale": "en-gb",
	    "returnurl": "http://payapal.dyl.anjon.es/paypal/callback.php"
	  });
	});
	</script>

</body>

</html>