<?php 
if (function_exists("allcheck"))
{ allcheck("admin_grusbox","grusbox_level",10); 
include("./lib/lib.php");}
else
{ echo '<h1>Zugriff verweigert</h1>'; exit (); }
?>
<form method="post" action="index.php?x=log">
<table><tr><td>Seite: </td><td><input type="text" name="seite" value="<?php echo $_POST["seite"]; ?>" /></td></tr>
<tr><td>User: </td><td><input type="text" name="user" value="<?php echo $_POST["user"]; ?>" /></td>
<td><button type="submit">Ausf&uuml;hren</button></td></tr>
</table>
<?php userandpass(); ?>
</form>

<br /><br />
<?php show_log(); ?>