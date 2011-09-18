<?php
//Page Kompression Aktivieren
ob_start("ob_gzhandler");

// Bibliothek zum Abfragen von Status Informationen
require_once("./lib/status.php"); 

//Bibliothek f&uuml;r die Statistiken
require_once("./lib/stats.php");

include("header.php");
?><div class="navi_links" style="z-index:2;">
<?php include("naviL.php");?>
</div>
<div class="inhalt" style="z-index:2;">
<?php 

if (isset($_GET["x"]))
{ 
 $filename = ($_GET["x"]);
 if (file_exists(str_replace(".","",$filename) . ".php"))
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
?>
</div>
<div class="navi_rechts" style="z-index:2;">
<?php include("naviR.php");?>
</div>
<div class="fuss">
<?php include("fooder.php")
;?>
</div>
</body></html>
