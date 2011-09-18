<?php 
if (function_exists("allcheck"))
{ allcheck("admin_chat","chat_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_chat","chat_level",10); }
?>
<h4>Chat</h4>
<?php
fsockopen("http://irc.ist-on.de",6667, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fputs ($fp, "GET / HTTP/1.0\r\n\r\n");
    while (!feof($fp)) {
        echo fgets($fp,128);
    }
    fclose($fp);
}
