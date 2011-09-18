<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { 
   
echo '<u>Download</u>
<br />
Hier stehen Euch Software, Musik (wird sp&auml;ter erl&auml;utert) und die MSN-Adressen der Team-Mitglieder zum Download bereit.<br />
Bei der <b>Software</b> handelt es sich um kostenlos und als Free- oder Shareware erh&auml;ltliche Programme, die von Moderatoren als n&uuml;tzlich empfunden werden.
Solltet auch Ihr ein n&uuml;tzliches Tool oder Programm kennt, welches noch nicht gelistet ist, wende sich bitte an einen Download-Admin, damit es hinzugef&uuml;gt werden kann.<br />
Bei der hier zur Verf&uuml;gung gestellten <b>Musik</b> handelt es sich um Lieder der vorgestellten Bands, sowie um Titel unsere Partner aus dem K&uuml;nstlerbereich.<br />
Die Moderatoren verpflichten sich beim Download, die Musik nicht an Nicht-Moderatoren von Discollection-Radio weiterzugeben.<br />
F&uuml;r neue Moderatoren stellen wir im Bereich <b>MSN Adressen</b> die MSN-Adressen aller Teammitglieder als Datei zum Download und Import in MSN zur Verf&uuml;gung.<br />
Die Anleitung zum Import in MSN findet Ihr unter dem Punkt <b>MSN Anleitung</b>.';
   
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


