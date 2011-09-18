<?php 
if (function_exists("allcheck"))
{ allcheck("admin_download","download_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_download","download_level",10); }
?>

<?php include("./lib/lib.php");?>
<?php added_download();?>
Bitte aus dem Originaldateinamen alle Deutschen umlaute und Leerzeichen entfernen!
<form method="post" action="index.php?x=added" enctype="multipart/form-data">
<table><tr><td>Hier die Datei ausw&auml;hlen (Max 50 MB)</td><td><input type="file" name="datei" /></td></tr>
<tr><td>Usergruppe</td><td><select name="level">
 <option value="1">G&auml;ste</option>
  <option value="2">reg. User</option>
 <option value="3">Moderatoren</option>
 <option value="4">Admins</option>
</select></td>
<tr><td>Datum</td><td><input type="text" name="datum" value="<?php echo date(Y).'-'.date(m).'-'.date(d);?>" /></td></tr>
<tr><td>Titel:</td><td><input type="text" name="titel" value="" /></td></tr>
<tr><td>Beschreibung:</td><td><textarea name="beschreibung" rows="10" cols="50">Beschreibung</textarea></td></tr>
<?php userandpass();?>
</table><button type="submit">Hochladen</button>
</form>

