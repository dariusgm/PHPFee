<?php
session_start();
?>

<?php require_once("./lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo'
   
   <!-- Kopf -->
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
   "../xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
   <head>
    <title>Discollection -> MOD STARTSEITE</title>
    <link rel="stylesheet" type="text/css" href="format.css" />
   </head>
   <body><table align="center" summary="Logo von Discollection-radio.de" frame="void" cellspacing="0" cellpadding="0" width="100%">
   <tr><td><img src="test.gif" /></td></tr>
   <tr><td class="justgrey">&nbsp;</td></tr>
   </table>
   <!-- Kopf Ende -->
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
