<?php 
if (function_exists("allcheck"))
{ allcheck("admin_bands","bands_level",10); }
else
{ require_once("../lib.php");
allcheck("admin_bands","bands_level",10); }
?>
<u>Bands</u>
<br />
In diesem Men&uuml; habt Ihr die M&ouml;glichkeit unseren Besuchern Bands vorzustellen.<br />
Einpflegen k&ouml;nnt Ihr neben nat&uuml;rlich dem Bandnamen eine Kurzbeschreibung, die auf der Startseite angezeigt wird,<br />
 eine ausf&uuml;hrliche Beschreibung, die bei Aufruf der Bandinfo angezeigt wird, und die Homepage der Band.<br /><br />
Desweiteren ist es m&ouml;glich diverse Dateien zur Band hochzuladen.<br />
Unter <b>"Vorstellung"</b> k&ouml;nnt Ihr, sofern vorhanden, eine MP3-Datei der Band hochladen, in der sich die Band selbst vorstellt.<br />
Angezeigt wird diese MP3-Datei auf der Startseite und kann von jedem Besucher der Seite angeh&ouml;rt werden.<br />
Unter <b>"Musik 1"</b> bis <b>"Musik 5"</b> k&ouml;nnt Ihr Musiktitel der Bands hochladen, die dann f&uuml;r die Moderatoren im Downloadbereich <br />
zur Verf&uuml;gung stehen.<br />
Das Vorschaubild wird mit der Kurzbeschreibung auf der Startseite angezeigt, das Vollbild wird in der Bandvorstellung angezeigt.<br /><br />
Im Men&uuml;punkt <b>"Bands hinzuf&uuml;gen"</b> legt Ihr neue Eintr&auml;ge an.<br />
Im Men&uuml;punkt <b>"Bands editieren"</b> k&ouml;nnt Ihr Eintr&auml;ge von bereits eingef&uuml;gten Bands &auml;ndern oder l&ouml;schen.<br />
