<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { 
 echo '<u>Charts</u>
<br />
Wir sind der Meinung, dass die Charts selbsterkl&auml;rend sind. Sollten Fragen hierzu auftauchen, wendet Euch bitte an einen Webmaster, damit ein Text erg&auml;nzt werden kann.
';
   
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



