<?php

if (checkstatus("user_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>

<?php
if (checkstatus("user_level")>=15)
{ edit_user_sadmin(); }
elseif (checkstatus("user_level")==10)
{ edit_user_admin(); }
?>


<h4>User Verwaltung</h4>
<form action="index.php" method="post">
<table><tr><td>Username: </td><td><input type="text" name="searchuser" value="" /></td></tr>
<tr><td colspan="2">oder:</td></tr>
<tr><td>ID: </td><td><input type="text" name="searchid" value="<?php if (isset($_GET["nickid"])) { echo $_GET["nickid"]; } ?>" /></td></tr>
<tr><td><button type="submit">Suchen</button>
<?php userandpass();?><input type="hidden" name="do" value="search" />
</table>
</form>

<?php
if (checkstatus("user_level")>=15)
{   del_user_sadmin();
	search_user_sadmin(); }
elseif (checkstatus("user_level")==10)
{ search_user_admin(); }



?>