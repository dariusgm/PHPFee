<?php

if (checkstatus("fundus_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>

<?php
do_uebersicht();
show_uebersicht();?>