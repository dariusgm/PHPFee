<?php

if (checkstatus("fundus_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>


<?php if (isset($_POST["name"]) && isset($_POST["beschreibung"]) && isset($_POST["editid"]))
{
	do_edit_geschenke();
}

show_geschenke();?>

