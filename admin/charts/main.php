<?php 
if (function_exists("allcheck"))
{ allcheck("admin_charts","charts_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_charts","charts_level",10); }
?>
<h4>Charts</h4>
