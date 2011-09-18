<?php 
if (function_exists("allcheck"))
{ allcheck("admin_podcast","podcast_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_podcast","podcast_level",10); }
?>
<table><tr><td><u>Podcast hinzuf&uuml;gen</u></td></tr>
<tr><td>Ein klick auf "Podcast hinzuf&uuml;gen" &ouml;ffnet dir eine Eingabeoberfl&auml;che um neue Podcast hochzuladen.<td></tr>
<tr><td><u>Podcast bearbeiten</u></td></tr>
<tr><td>Ein klick auf "Podcast bearbeiten" &ouml;ffnet dir eine Eingabeoberfl&auml;che zum bearbeiten der bereits hochgeladenen Podcast's.<td></tr>
<tr><td><u>Podcast ver&ouml;ffentlichen</u></td></tr>
<tr><td>Ein Klick auf diese Schaltfl&auml;che stellt alle hochgeladenen Podcasts Online, die Entsprechende RSS ( b.z.w. XML) Datei wird hier erst aktualisiert.<td></tr>

</table>
