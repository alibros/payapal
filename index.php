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
	<meta name="author" content="Untame.net">

	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="js/jquery-1.6.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/init.js"></script>

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
	</style>

</head>

<body>

	<!-- Section #1 -->
	<section id="intro" data-speed="6" data-type="background">
		<div class="container">
	    	<div class="hero-unit">
	    		<h1>Pay A Pal</h1>
	    		<p>Send payments easily</p>
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
		          		echo "<a href=\"https://www.sandbox.paypal.com/webapps/auth/protocol/openidconnect/v1/authorize?response_type=code&scope=openid+profile+email+address+email+phone&client_id=ATT0HxAFzMYwAoRii7jF1okec0YkFoXgVTbKFVeNi43pTea5aBsdytj60FVR&redirect_uri=http%3A%2F%2Fpayapal.dyl.anjon.es%2Fpaypal%2Fcallback.php\" class=\"btn btn-large btn-default\">Paypal</a>";
		          	else
					    echo "<img src=\"images/check.png\"> ".$user['paypal_email']."";
		          ?>
		          </h3>
		        </div>
	    	</div>

	    	<?php if((!empty($user['paypal_id'])) && (!empty($user['twitter_id']))) { ?>
	    	<div class="row-fluid">
		        <div id="phone-well" class="span12 well">
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
				<h1>How does it work?</h1>
			</div>
			<div class="row-fluid">
		        <div class="span4">
		          <h2>More Details</h2>
		          <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque cursus nisl consectetur et.</p>
		          <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque cursus nisl consectetur et.</p>
		          <p><a class="btn btn-success">View details &raquo;</a></p>
		        </div><!-- /.span4 -->
		        <div class="span4">
		         	<div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="images/check.png">
						</a>
						<div class="media-body">
						    <h4 class="media-heading">Media heading</h4>
						    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante.
						</div>
					</div>
		         	<div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="images/check.png">
						</a>
						<div class="media-body">
						    <h4 class="media-heading">Media heading</h4>
						    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante.
						</div>
					</div>
		         	<div class="media">
						<a class="pull-left" href="#">
					    	<img class="media-object" src="images/check.png">
						</a>
						<div class="media-body">
						    <h4 class="media-heading">Media heading</h4>
						    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante.
						</div>
					</div>
		        </div><!-- /.span4 -->
		        <div class="span4">
		          <h2>A Thing</h2>
		          
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