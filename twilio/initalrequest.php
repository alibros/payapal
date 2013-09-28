<?php 
echo"<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo"<Response>";
echo"    <Gather timeout=\"7\" numDigits=\"4\"  action=\"payprocess.php?tid=".$_GET['tid']."&amp;code=".$_GET['code']."\" method=\"GET\">";
echo"        <Say>";
echo"	     Hello there ".$_GET['name'].". You are receiving this call because you've tweeted to pay a pal. enter the 4 digit code now. And make sure you enter it correctly. Or your phone will explode.";
echo"        </Say>";
echo"    </Gather>";
echo"    <Gather timeout=\"7\" numDigits=\"4\"  action=\"payprocess.php?tid=".$_GET['tid']."&amp;code=".$_GET['code']."\" method=\"GET\">";
echo"        <Say>";
echo"	     We didn't receive any input. please try again.";
echo"        </Say>";
echo"    </Gather>";
echo"    <Gather timeout=\"7\" numDigits=\"4\"  action=\"payprocess.php?tid=".$_GET['tid']."&amp;code=".$_GET['code']."\" method=\"GET\">";
echo"        <Say>";
echo"	     We didn't receive any input. please try again.";
echo"        </Say>";
echo"    </Gather>";
echo"    <Gather timeout=\"7\" numDigits=\"4\"  action=\"payprocess.php?tid=".$_GET['tid']."&amp;	code=".$_GET['code']."\" method=\"GET\">";
echo"        <Say>";
echo"	     We didn't receive any input. please try again.";
echo"        </Say>";
echo"    </Gather>";
echo"</Response>";
?>