<?php 
if (function_exists("allcheck"))
{ allcheck("admin_playlist","playlist_level",10);
include("./lib/lib.php"); }
else
{exit(); }
show_create_genre();

?>
