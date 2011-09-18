<?php 
if (function_exists("allcheck"))
{ allcheck("admin_foto","foto_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_foto","foto_level",10); }
?>
<u>Fotos</u>
<br />
Im Fotomen&uuml; werden die von den Usern hochgeladenen Fotos kontrolliert und ggfs. freigeschaltet oder abgelehnt.<br />
Im Men&uuml; <b>"Fotos freischalten"</b> sind die zu bearbeitenden Freischaltungen gelistet. Sollte ein Foto abgelehnt werden, so w&auml;hle den Ablehnungsgrund aus, der dann dem User in einer IM angegeben wird.<br />
Im Men&uuml; <b>"Letzte Freischaltungen"</b> kannst Du Dir einen &Uuml;berblick &uuml;ber die zuletzt bearbeiteten Fotos verschaffen und auch &uuml;ber die Entscheidung, ob diese OK oder nicht OK waren.
