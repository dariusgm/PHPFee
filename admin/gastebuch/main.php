<?php 
if (function_exists("allcheck"))
{ allcheck("admin_gastebuch","gastebuch_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_gastebuch","gastebuch_level",10); }
?>
<?php
if (checkstatus("gastebuch_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>

<u>G&auml;stebuch</u>
<br />
Hier werden die Eintr&auml;ge der User in unserem &ouml;ffentlichen G&auml;stebuch kontrolliert und freigeschaltet.<br />
Die Bearbeitung findet im Men&uuml; <b>"Anzeigen"</b> statt. Eintr&auml;ge, die zu kontrollieren sind, haben den Status "Privat".<br />
Soll der G&auml;stebucheintrag ver&ouml;ffentlicht werden, so ist der Status auf "&Ouml;ffentlich" zu &auml;ndern und &uuml;ber "Ausf&uuml;hren" zu best&auml;tigen.<br />
Eintr&auml;ge, die nicht ver&ouml;ffentlicht werden sollen, werden mit dem Status "L&ouml;schen" versehen und &uuml;ber "Ausf&uuml;hren" dann tats&auml;chlich gel&ouml;scht.


