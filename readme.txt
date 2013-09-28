<?php

registration
----------------
-> twitter button
	->twitter login and auth

-> paypal button
	->paypal authentication

-> tweet field

phone pin verification
------------------------
 tid,phone,code,name -> /paycallrequest.php

	-> verify.php: tid=tid, success=1/0, type=code

phone song verification
-------------------------
tid, phone, song_name, song_url -> singcall.php

	-> verify.php: tid=tid, success=1/0, type=song

-> pay pal request to pay
