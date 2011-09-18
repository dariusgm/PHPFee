<?php
ob_start("ob_gzhandler");

if ($_GET["x"]!="print")
{ include("header.php");
echo '
<table cellspacing="0" cellpadding="0"><tr>
<td valign="top" width="150">';
include("naviL.php"); 
echo '</td>
<td valign="top" width="655">'; 
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
}
else
{  
	include("print.php"); }

?></td>
</tr>
</table>
</body></html>
