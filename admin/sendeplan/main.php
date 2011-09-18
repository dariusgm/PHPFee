<?php 
if (function_exists("allcheck"))
{allcheck("admin_sendeplan","sendeplan_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_sendeplan","sendeplan_level",10); }
?>

TEXT