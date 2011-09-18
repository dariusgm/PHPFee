<!-- Kontakt -->
<?php if (allcheck(38,"",false,""))
{
echo '<h2>Kontakt</h2>
<form method="post" action="kontakt.htm">
<table border="1">
<tr><td>Ihr Benutzername ( falls vorhanden )</td><td><input type="text" name="kontakt_user" value="'.$_SESSION["nick"].'" /></td></tr>


</table>
<form>';

}?>
<!-- Kontakt Ende -->