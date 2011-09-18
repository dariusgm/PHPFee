<?php if (checkstatus("portal_level")<15)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>

<?php include("./lib/lib.php");
if(isset($_POST[id]))
{edit_relayserver();}

show_relayserver();

?>
