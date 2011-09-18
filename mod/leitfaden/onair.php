<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo '
   
<h4>Mod -> Leitfaden -> On Air</h4>
<ul type="circle">
<li>Der Stream darf nur für Radiointerne Werbung genutzt werden. Andernfalls kann der Moderator aus dem Team ausgeschlossen werden 
</li>

<li>10 bis 20 Uhr sollte der kommerzielle Stil überwiegen. 
</li>
<li>In diesem Sinne sollen die Hörer informiert werden über aktuelle Geschehnisse und Hintergrundinformationen. 
</li>
<li>Zu dieser Zeit soll nur in den ersten oder letzten 20 Sekunden in einen Titel reingesprochen werden 
</li>
<li>Folgende Musikrichtungen sind in dieser Zeit unerwünscht: House, R\'n\'B, Aggressiver Hip hop Deutsch(Sido....)Englisch(50 Cent....) Soul, Techno mit mehr als 140 bps, Hard-Rock, Ska, Metal, Comedy Sendungen wie "Der Kleine Nils" ,"Micheal Mittermeier" oder "Mario Barth" sowie andere. Mehr als 2 Titel pro Genre das eben genannt wurde, sind verboten.
</li>
<li>Ab 20 Uhr gilt der altbekannte „Webradiostil“. 
</li>
<li>Das Verhalten vor dem Mikrophon sollte als „öffentlichkeitstauglich“ angesehen werden.Sowohl im Auftreten, als auch in Äusserungen.
</li>
<li>"weiche" und harte Drogen sowie Alkohol in jeglicher Menge sind während des Streamens verboten. Wird ein Moderator erwischt, kann er aus dem Team ausgeschlossen werden 
</li>
<li>Kaffee, Tee und Tabak stehen zwar in dem Ruf, eine gewisse berauschende Wirkung zu haben, werden hiervon allerdings nicht berührt. 
</li>
<li>Gewaltverherrlichende, sexuelle, rassistische und sonstige Aussagen fernab der öffentlichen Meinung und der allgemeinen Moral sind verboten. 
</li>
<li>Jeder Moderator hat zwingend darauf zu achten einen wechselnden Musiktitel anzubieten. 
</li>
<li>Jeder Moderator möchte immer darauf achten, wie viel Zuhörer gerade zuhören, sich dementsprechend zu verhalten und auf die Hörer eingehen.Sam Benutzer können dieses direkt im Sam einstellen, für alle anderen empfehlen wir die Software "Radio Toolbox" 
</li>
<li>Die Musik ist in einem gemischtem Verhältnis gewünscht, dass heißt 80er, 90er und das Beste von heute, alles eben bisschen gemischt. 
</li>
<li>Ab 24 Uhr ist Platz für Sondersendungen jeglicher Art 
</li>
<li>Das PW für die Playlist wird in unregelmäßigen Abständen geändert, oder direkt in die Onairbox integriert. Neuer Benutzername: nanotechnologie, Passwort: playlist 
</li>
<li>Das durchsagen von anderen E-mail adressen außer der eigenen, sind verboten.</li>  </ul> 
<br />
   
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

