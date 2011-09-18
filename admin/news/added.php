<?php 
if (function_exists("allcheck"))
{ allcheck("admin_news","news_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_news","news_level",10); }
?>
<?php include("./lib/lib.php");?>
<?php added_news();?>
<table border="1">
<form name="added" method="post" action="index.php?x=added">
<?php userandpass();?>
<input type="hidden" name="do" value="added" />
<tr><td width="100"><input type="text" name="datum" value="<?php echo (date(Y) .'-'. date(m) .'-'. date(d)); ?>" /></td><td width="50"><input type="text" size="50" maxlenght="50" name="titel" value="Titel"  /></td><td><button type="submit">Hinzufuegen</td></tr>
<tr><td colspan="3"><input type="text" size="100" maxlenght="100" name="kurznews" value="Kurznews (Fuer die Hauptseite)" /></td></tr>
<tr><td colspan="3"><textarea name="news" rows="10" cols="75">News</textarea></td></tr></form></table>