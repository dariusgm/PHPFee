<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo '
   
<h4>Mod -> Leitfaden -> Grundlagen</h4>
<ul>
<li>Das Auftreten des Moderatoren sollte bei jeder Sendung eine höchstmögliche Proffesionalität sein. 
</li>
<li>Das PW für den TS für unregistrierte ist bei den Bewerbungs-Admins zu holen. In unregelmäßigen Abständen wird es geändert. Als registrierter Benutzer kommt man nach wie vor ohne Probleme in den TS. 
</li>
<li>Solltet Ihr von Hörern im Chat angesprochen werden, so verweist bitte an die Bewerbungsadmins-Admins. 
</li>
<li>
im MSN-Messi wäre es wünschenswert, wenn im Namen oder der Statusinformation unsere URL eingetragen ist 
</li>
<li>im Profil auf unserer HP ist auf jeden Fall die eMail-Addy von Discollection eingetragen sein, keine andere, private 
</li>
<li>Profile auf der HP sollen vollständig ausgefüllt werden. 
</li>
<li>Das Streamen mit Aktivierter Titelanzeige ist zu unterlassen. Stattdessen bitte die Zeichenkette "discollection-radio.de" eintragen. 
</li>
<li>Moderatoren haben sich neutral gegenüber den Zuhörern zu verhalten, Privates sollte auch privat bleiben, da es sich sonst negativ auf das Radio auswirkt und dann nicht mehr privat ist. Gleiches gilt für das Verhältnis zwischen Moderatoren untereinander, Neutralität ist zwingend zu wahren. Auch Grüße an Lebenspartner über den Stream sind zu unterlassen. 
</li>
<li>Während der Sendung sollten nur die Verantwortlichen den Moderator bei wirklich massiven Problemen anschreiben wenn etwas falsch läuft. (z.B. Mic stimmt nicht oder Musik klingt etwas unsauber ect...) um es vielleicht nachzuregeln, wenn möglich.
</li>
<li>Unstimmigkeiten sind persönlich zu klären und nicht über Foreneinträge 
</li>
<li>Wer den Nonstop kickt, muss nicht mehr im Forum posten, hier gilt eindeutig „Wer zuerst kommt, malt zuerst“. Wer aber den Nonstop kickt, muss bis zu, Beginn der nächsten Sendung und nicht nur für eine Stunde und Rückübergabe an Nonstop. 
</li><li>Anliegen an Andy per E-Mail an ihn schicken, da sonst die Gefahr besteht, dass Dinge untergehen, was nie b&ouml;se gemeint ist, aber die Informationen, die auf ihn einprasseln sind einfach sehr massiv. (Wendet euch zuerst an die Entsprechenden Verantwortlichen -> Mitwirkende)</li>
   <li>Wir bitten noch einmal eindringlich nicht in Gerede zu verfallen, wenn etwas seltsam erscheint, sondern die Admins anzusprechen. Alle Admins stehen für Rückfragen jederzeit zur Verfügung.</li></ul>
 
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

