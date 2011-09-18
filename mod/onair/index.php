<?php
session_start();
ob_start("ob_gzhandler");
include("header.php");?>
<table cellspacing="0" cellpadding="0"><tr>
<td valign="top" width="150"><?php include("naviL.php"); ?></td>
<td valign="top" width="655"><?php 
// Pr&uuml;fe ob Dateiname angeh&auml;ngt wurde, falls ja
// Pr&uuml;fe ob die Datei Lokal vorhanden ist falls ja
// Include in die Haupttabelle
if (isset($_GET["x"]))
{
$filename = $_GET["x"];
 if (file_exists($filename . ".php"))
 {
 include($filename . ".php");
 }
 else
 {
 include("main.php");
 }
}
else
{
	include("main.php"); 
}

;?></td>
</tr>
</table>
</body></html>
