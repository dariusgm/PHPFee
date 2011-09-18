<?php 
if (function_exists("allcheck"))
{ allcheck("admin_events","events_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_events","events_level",10); }
?>

<?php include("./lib/lib.php");?>
<table border="1">
<form method="post" action="index.php?x=show" enctype="multipart/form-data">
<?php userandpass();?>
<input type="hidden" name="do" value="added" />
<tr><td width="100">Datum: <input type="text" name="datum" value="<?php echo date("Y-m-d");?>" /></td><td width="100">Anfangszeit: <input type="text" name="uhrzeit" value="18:00" /></td>
<td width="50" colspan="2"><input type="text" size="50" maxlenght="150" name="titel" value="Titel"  /></td></tr>
<tr><td>Banner: <input type="file" name="datei" /></td></tr>
<tr><td colspan="3"><textarea name="text" rows="10" cols="75">Beschreibung</textarea></td></tr></table>
<table border="1"><tr><td><button type="submit">Hinzufuegen</td></tr></form></table>