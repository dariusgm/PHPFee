<!--Mitteilungen-->

<?php if (allcheck(40,"",false,""))
{


include("./lib/mitteilungen.php");
 if ($_POST["do"]=="send" || $_POST["do"]=="verify")
{do_send();}

 do_del();
 do_archiv();
 show_re();
 
echo '<b>Empfangen:</b><br />';
 show_get();
echo '<hr />
<b>Archiv:</b><br />';
 show_archiv();
echo '
<hr />
<b>Verfassen:</b><br />
<form method="post" action="mitteilungen.htm">
<table border="1">
<tr><td>An:</td><td><input type="text" name="username" value="'. $_GET["nick"].'" /></td><td><a href="suchen.htm">User Suchen</a></td></tr>
<tr><td>Betreff:</td><td colspan="2"><input type="text" name="betreff" value="Kein Betreff" /></td></tr>
<td colspan="3">Deine Nachricht:<br /><textarea name="text" cols="30" rows="10"></textarea></td></tr>
</table>

<button type="submit" />Ausf&uuml;hren</button><select name="do">
 <option value="send">| Senden</option>
 <option value="archiv">|- + Speichern</option> 
 <option value="verify">|- + Automatische Best&auml;tigung</option> 
</select>
</form>'; }?>

<!-- Mitteilungen Ende -->