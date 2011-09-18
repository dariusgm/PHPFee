<?php
if (checkstatus("portal_level")<"5")
{ echo "<h1>Zugriff verweigert!</h1>";exit(); }?>

<?php include("./lib/lib.php");
if ($_POST["do"]=="send")
{ send_urlaub(); }
else
{ show_urlaub(); }?>