<?php 
echo"<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo"<!-- page located at http://example.com/complex_gather.xml -->";
echo"<Response>";
echo"        <Say>";
echo"	     If you're really, really sure you want to make this payment. listen to this song.";
echo"        </Say>";
echo"        <Play>".$_GET['song_url']."</Play>";
echo"    <Record transcribe=\"true\" transcribeCallback=\"/handle_transcribe.php?song_name=".urlencode($_GET['song_name'])."&tid=".$_GET['tid']."\"  method=\"GET\" finishOnKey=\"*\" action=\"/goodbye.php\" /> <Say>I did not receive a recording</Say>";
echo"</Response>";
?>