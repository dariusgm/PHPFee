<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo '
   
<h4>Mod -> Leitfaden -> Technische Grundlagen</h4>
<ul type="circle">

<li>Ab und an sind Änderungen in der Sendesoftware nötig. Diese sind SOFORT umzusetzen. Informiert wird per E-Mail 
</li>
<li>Bei Änderungen an der Sendesoftware oder Sendetechnik sind die Verantwortlichen Administratoren zu verständigen, damit Sie die Einstellungen auf dem Casting Stream Überprüfen können und die Freigabe erteilen.
</li>
<li>Die Verantwortlichen schneiden stichprobenartig den Stream mit, um nach der Sendung dem Moderator Verbesserungsvorschläge zukommen zu lassen. 
</li>
<li>Jeder Moderator MUSS seine Technik auf dem Castingstreams (8050 oder 8052) vor Sendebeginn überprüfen. 
</li>
<li>Wenn der Moderator NICHT vor einer Sendung ist, und er möchte den Castingstream nutzen, ist der Bewerbungsverantwortliche zu informieren 
</li>
<li>Sollten einmal kurzfristig Probleme auftreten, sollte der sendende Moderator auf jeden Fall entweder per Telefon oder ähnlichen Mitteln informiert werden. 
</li>
<li>Wenn er informiert wurde, schreibt er bitte in seinen Messinamen :" Problem bekannt " 
</li>
<li>Ist das Problem nicht auf die schnelle behebbar,muss schnellstmöglich ein Ersatz durch den ausfallenden Moderator gefunden werden. Außerdem ist im letzten Schritt die Sendeplanleitung zu informieren.
</li>
<li>Jeder Moderator sollte sich auch ausgiebig mit seiner Sendetechnik auseinandersetzen da die Verantwortlichen nicht immer sofort greifbar sind. Bei schwierigen Problemen bitte Termine ausmachen mit den Verantwortlichen da es dann etwas länger dauern könnte. Es ist dann immer etwas problematisch wenn man gesagt bekommt keine Zeit, weil es ja wirklich so sein kann. ( Also nicht gleich böse sein ).
</li></ul><br />
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

