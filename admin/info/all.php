<?php 
if (function_exists("allcheck"))
{ allcheck("admin_info","info_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_info","info_level",10); }
?>
<?php
require_once("./lib/lib.php");
do_send_all();
?>

<table border="1"><form method="post" action="index.php?x=all"><tr><td>Betreff:</td><td colspan="2"><input type="text" name="betreff" value="Kein Betreff" /></td></tr>
<tr><td colspan="2">Deine Nachricht:<br /><textarea name="text" cols="30" rows="10"></textarea></td></tr>
<tr><td>Senden als:</td><td><select name="send_as"><option value="user">User Einstellung</option><option value="im">Mitteilung</option><option value="email">E-Mail</option><option value="both"> IM + E-Mail</option></select></td></tr>
</table>
<?php userandpass(); ?>
<button type="submit">Senden</button> 

</form>

</form>
