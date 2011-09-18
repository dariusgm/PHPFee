<?php 
if (function_exists("allcheck"))
{ allcheck("admin_download","download_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_download","download_level",10); }
?>
<u>Download</u>
<br />
Wir haben die M&ouml;glichkeit unseren Usern Dateien zum Download zur Verf&uuml;gung zu stellen.<br />
Vor dem Hochladen und Ver&ouml;ffentlichen bedenkt bitte, dass es sich um lizenzfreie Dateien (Software, Musiktitel, etc.) handeln muss.<br />
Im Men&uuml;punkt <b>"Downloads anzeigen"</b> habt Ihr eine Komplett&uuml;bersicht aller zum Download zur Verf&uuml;gung gestellten Dateien.<br />
Beim <b>"Download hinzuf&uuml;gen"</b> beachtet bitte den Rang, den ein User im Portal haben muss, um auf den Download zugreifen zu k&ouml;nnen.<br />
<u>Gast:</u> jeder (auch nicht registrierter) Besucher des Portals kann in der Navigationsleiste &uuml;ber den Link <b>"Download"</b> auf die Datei zugreifen.<br />
<u>reg. User:</u> jeder registrierte Benutzer des Portals kann in der Navigationsleiste &uuml;ber den Link <b>"Download"</b> auf die Datei zugreifen.<br />
<u>Moderator:</u> die Moderatoren haben im Moderatorenbereich des Portals Zugriff auf die f&uuml;r sie zur Verf&uuml;gung gestellten Dateien. Dies k&ouml;nnen z.B. Jingles sein oder Musikdateien aus dem Band-Men&uuml;.<br />
Der Titel des Downloads sollte kurz, knapp, aber pr&auml;zise und selbsterkl&auml;rend sein!<br />
Im Men&uuml;punkt <b>"Downloads editieren"</b> habt Ihr die M&ouml;glichkeit bereits eingerichtete Downloads zu &auml;ndern oder zu l&ouml;schen.<br />
