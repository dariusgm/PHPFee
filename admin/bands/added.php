<?php 
if (function_exists("allcheck"))
{ allcheck("admin_bands","bands_level",10); }
else
{ require_once("../lib.php");
allcheck("admin_bands","bands_level",10); }
?>

<form method="post" action="index.php?x=edit" enctype="multipart/form-data">
Felder mit einem <b>!</b> M&uuml;ssen ausgef&uuml;llt werden. Anderenfalls werden die Eingabe und der Upload verworfen<b>!</b>

<table width="500" border="1"><tbody><tr><td><b>!</b> Bandname: <input type="text" name="name" value="" /></td></tr>

<tr><td><br /><b>!</b> KURZBESCHREIBUNG: <br /><textarea name="kurztext" cols="50" rows="7">Kurz-Beschreibung (Max 200 Zeichen)</textarea></td></tr>
<tr><td><br /><b>!</b> BESCHREIBUNG: <br /><textarea name="text" cols="50" rows="20">Beschreibung </textarea>
<tr><td>Homepage: <input type="text" name="link" value="http://www." /></td></tr></table>
<br />
<table width="500" border="1"><tr><td>Vorstellung :</td><td width="200"><input type="file" name="vorstellung" /></td></tr>
<tr><td>Musik 1 :</td><td><input type="file" name="musik1" /></td></tr>
<tr><td>Musik 2 :</td><td><input type="file" name="musik2" /></td></tr>
<tr><td>Musik 3 :</td><td><input type="file" name="musik3" /></td></tr>
<tr><td>Musik 4 :</td><td><input type="file" name="musik4" /></td></tr>
<tr><td>Musik 5 :</td><td><input type="file" name="musik5" /></td></tr>
<tr><td><b>!</b> Vorschau Bild : </td><td><input type="file" name="vorschau" /></td></tr>
<tr><td><b>!</b> Vollbild : </td><td><input type="file" name="vollbild" /></td></tr>
</tbody></table>
<input type="hidden" name="do" value="added" />
<input type="hidden" name="userinput" value="<?php echo $_POST["userinput"];?>" />
<input type="hidden" name="passinput" value="<?php echo $_POST["passinput"];?>" />
<table><tr><td><button type="submit">Hinzuf&uuml;gen</button></td></tr></table></form>