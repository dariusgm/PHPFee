<?php

if (checkstatus("fundus_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>

<?php if (isset($_POST["vorname"]) && isset($_POST["nachname"]) && isset($_POST["edituser"]))
{
	do_edit_adressen();
}

show_adressen();?>