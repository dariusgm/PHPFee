<?php 
if (function_exists("allcheck"))
{ allcheck("admin_grusbox","grusbox_level",10);
include("./lib/lib.php"); }
else
{ echo '<h1>Zugriff verweigert</h1>'; exit (); }
?>
<form method="post" action="index.php?x=kick">
<table><tr>
<tr><td>Stream: </td></tr>
<tr><td><select name="streamid"><option value="1">Stream 1</option><option value="2">Stream 2</option><option value="3">Stream 3</option></select></td></tr>
<tr><td><select name="_user"><option value="nonstop">Nonstop als Nachfolger</option><option value="user">User als Nachfolger</option></select></td></tr>

<tr><td><button type="submit">Ausf&uuml;hren</button></td></tr>
</table>
<?php userandpass(); ?>
</form>

<br /><br />
<?php kick_mod();?>