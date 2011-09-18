<?php 
if (function_exists("allcheck"))
{ allcheck("admin_playlist","playlist_level",10);
include("./lib/lib.php"); }
else
{exit(); }
reload_musik();

?>