<!-- Verlinkung -->

<?php if (allcheck(69,"",false,""))
{
echo '
Du willst verlinken? Nichts einfacheres als das. 
Wenn du deine eigene kleine private Homepage hast, und wenig Erfahrung im Einbinden von Inhalten hast, empfehlen wir dir unsere Komplettl&ouml;sung. In ihr sind alle n&ouml;tigen Elemente und Layout so, dass du einfach alles auf deiner Seite hast. Ist das nicht "Wunderbar" ? Wir bieten euch 2 L&ouml;sungen an. Einmal einfache HTML ( mit unterst&uuml;tzung von PHP Dateien die Ihr einbinden k&ouml;nnt, und auf der anderen Seite JavaScript Datein. Kurz die Vor- und Nachteile: 


<br /><br />
Vorteile PHP + HTML:

<ul type="circle"> 
<li>Einfach einzurichten</li>
<li>Individuell gestaltbar</li> 
<li>Sofortiges Aktualisieren bei Seitenwechsel / Refresh</li>
</ul> 

Nachteile PHP + HTML

<ul type="circle">
<li>Verz&ouml;gert insgesamt die Ladezeit der Seite etwas</li></ul> 
     

Vorteile JavaScript

<ul type="circle">
<li>Noch einfacher zu installieren</li>
<li>Da es &uuml;ber den Besucher l&auml;uft, wird nichts auf dem Server gebraucht. ( Kein php n&ouml;tig!)</li>
</ul>

Nachteile JavaScript 

<ul type="circle">
<li>Kann beim Besucher deaktiviert sein</li>
<li>Probleme beim Wechsel des Moderatoren ( z.T. starke verz&ouml;gerung der Anzeige</li>
<li>Erfordert etwas Grundwissen im bereich HTML</li> 
<li>Einige Anbieter erlauben nicht das einbinden von JavaScript aus externen Quellen</li>
</ul> 

<b>Wir empfehlen die Benutzung von PHP soweit m&ouml;glich!</b>

Hier ein paar Banner von uns. Ihr k&ouml;nnt sie entweder auf euren Internetspeicherplatz hochladen oder den Quellcode aus der Box benutzen.

<br /><br />';

include("./lib/verlinken.php");
show_box();
}
?>
<!-- Verlinkung Ende -->