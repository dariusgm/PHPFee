<?php 
if (function_exists("allcheck"))
{ allcheck("admin_info","info_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_info","info_level",10); }
?>
<u>Info Zentrum</u>
<br />
Im Info Zentrum k&ouml;nnen Nachrichten an bestimmte Benutzergruppen geschrieben werden. Zur Auswahl stehen folgende Gruppen:<br />
<u>Alle Moderatoren + Adminmod:</u> Dies sind alle Moderatoren und alle Admins, die auch Moderatoren sind.<br />
<u>Alle Admins:</u> Dies sind alle
