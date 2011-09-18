<?php 
if (function_exists("allcheck"))
{ allcheck("admin_podcast","podcast_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_podcast","podcast_level",10); }
?>
<?php include("./lib/lib.php");?>
<?php do_added_podcast();?>
<form method="post" action="index.php?x=added" enctype="multipart/form-data">
<table><input type="hidden" name="userinput" value="<?php echo $_POST["userinput"];?>" />
<input type="hidden" name="passinput" value="<?php echo $_POST["passinput"];?>" />
<tr><td>Titel:</td><td><input type="text" name="titel" value="" /></td></tr>
<tr><td>Autor:</td><td><input type="text" name="author" value="" /></td></tr>
<tr><td>Keywords:</td><td><input type="text" name="keywords" value="popfox Webradio " /></td></tr>
<tr><td>Datei:</td><td><input type="file" name="mp3" /></td></tr>
<tr><td>Beschreibung:</td><td><textarea name="beschreibung" rows="5" cols="25"></textarea></td></tr>
<tr><td><button type="submit">hinzuf&uuml;gen</button></td></tr>
</table>
</form>