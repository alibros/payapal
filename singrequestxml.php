<?php 
echo"<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo"<!-- page located at http://example.com/complex_gather.xml -->";
echo"<Response>";
echo"        <Say>";
echo"	     If you're really, really sure you want to make this payment, complete this sentence. An economy based on endless growth is, ";
echo"        </Say>";
echo"    <Record transcribe=\"true\" transcribeCallback=\"/handle_transcribe.php\"/> "
echo"</Response>";
?>