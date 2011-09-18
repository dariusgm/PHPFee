<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo '
   
Charts Links<br />
DCR Übernimmt keine Gew&auml;hr f&uuml;r die Aktualit&auml;t der bereitgestellten Informationen.<br />
DCR stellt NUR Informationen bereit. Die Musik wird von DCR <u><b>NICHT</b></u> zur verfügung gestellt !<br />
Sollten Seiten nicht mehr erreichbar sein, bitte Tuxi per E-Mail oder IM melden !
<br />
<table><tr><td><b>Anbieter</b></td><td><b>Link</b></td></tr>
<tr><td>Mix1</td><td><a href="http://www.mix1.de" target="_blank">http://www.mix1.de/</a></td></tr>
<tr><td>TIP: campus-charts</td><td><a href="http://www.campuscharts.de/charts/" target="_blank">http://www.campuscharts.de/charts/</a></td></tr>

<tr><td>TIP: MTV</td><td><a href="http://mtv.de/charts/index.php" target="_blank">http://mtv.de/charts/index.php</a></td></tr>
<tr><td>Viva</td><td><a href="http://www.viva.tv/Charts/Index/" target="_blank">http://www.viva.tv/Charts/Index</a></td></tr>
<tr><td>SWR 3</td><td><a href="http://www.swr3.de/musik/charts/" target="_blank">http://www.swr3.de/musik/charts</a></td></tr>
<tr><td>TIP :Amazon</td><td><a href="http://www.amazon.de/gp/bestsellers/music" target="_blank">http://www.amazon.de/gp/bestsellers/music</a></td></tr>
<tr><td>Musikload</td><td><a href="http://www.musicload.de/special?pageid=7&catid=1" target="_blank">http://www.musicload.de/special?pageid=7&catid=1</a></td></tr>
<tr><td>musiknews</td><td><a href="http://www.musiknews.de/musik-charts-deutschland.html" target="_blank">http://www.musiknews.de/musik-charts-deutschland.html</a></td></tr>
<tr><td>Music One</td><td><a href="http://www.musicone.de/leftcat01.php" target="_blank">http://www.musicone.de/leftcat01.php</a></td></tr>
<tr><td>AOL</td><td><a href="http://musik.aol.de/Charts/" target="_blank">http://musik.aol.de/Charts/</a></td></tr>
<tr><td>Charts-service</td><td><a href="http://www.chartsservice.de/" target="_blank">http://www.chartsservice.de</a></td></tr>



</table>';

   
   }
   else
   {
   echo '<h1>Zugriff verweigert.</h1> ';
   exit();
   }
}
else
{
echo '<h1>Zugriff verweigert.</h1> ';
exit();
}


?>







