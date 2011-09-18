<?php
session_start();
?>

<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo '
In diesem Men&uuml;punkt k&ouml;nnt ihr eure Sendezeiten abgeben. Sie werden dann direkt zu den Verantwortlichen verschickt, ihr m&uuml;&szlig;t KEINE extra E-Mail mehr verschicken.<br />
Bitte gebt eine ZEITSPANNE an, um es den Sendeplan Verantwortlichen einfach zu machen beim Planen. Es k&ouml;nnen bis zu 5 Sendezeiten in einem Durchgang vershcickt werden. Damit ihr den &Uuml;berblick behaltet, was ihr schon verschickt habt und was nicht, wird euch selber noch eine E-Mail mit den Sendezeiten geschickt. Viel Spa&szlig; beim ausf&uuml;llen !
<br />
Der Stream wird sp&auml;ter ausw&auml;hlbar sein.
<form method="post" action="index.php?x=einreichen"><table border="1">
<tr><td>Sendezeit:</td><td>Datum</td><td>Von</td><td>Bis</td><td>Stream</td></tr>
<tr><td>1</td><td><input type="text" name="datum1" value="31.12.2007" /></td><td><input type="text" name="von1" value="12:00" /></td><td><input type="text" name="bis1" value="18:00" /></td><td><input type="hidden" name="stream1" value="1" />1</td></tr>
<tr><td>2</td><td><input type="text" name="datum2" value="" /></td><td><input type="text" name="von2" value="" /></td><td><input type="text" name="bis2" value="" /></td><td><input type="hidden" name="stream2" value="1" />1</td></tr>
<tr><td>3</td><td><input type="text" name="datum3" value="" /></td><td><input type="text" name="von3" value="" /></td><td><input type="text" name="bis3" value="" /></td><td><input type="hidden" name="stream3" value="1" />1</td></tr>
<tr><td>4</td><td><input type="text" name="datum4" value="" /></td><td><input type="text" name="von4" value="" /></td><td><input type="text" name="bis4" value="" /></td><td><input type="hidden" name="stream4" value="1" />1</td></tr>
<tr><td>5</td><td><input type="text" name="datum5" value="" /></td><td><input type="text" name="von5" value="" /></td><td><input type="text" name="bis5" value="" /></td><td><input type="hidden" name="stream5" value="1" />1</td></tr>
<input type="hidden" name="userinput" value="'. $_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'. $_POST["passinput"].'" />


</table>
<button type="submit">Absenden</button>
</form>   

   ';
   
   include("./lib/lib.php");
   send_sendeplan();
   
   }
   else
   {
   echo '<h1>Zugriff verweigert.</h1> ';
   exit();
   }
}
else
{
echo '<h1>Zugriff verweigert.</h1> ';
exit();
}


?>






