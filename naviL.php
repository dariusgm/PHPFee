<!-- Navi Links -->
<ul style="list-style-type:disc;">
<?php 
if (!isset($_GET["x"]))
 { echo	'<li class="navi_links_aktiv"><br />Startseite</li>'; }
else
 { echo '<li><a href="index.htm" class="navi_links">Startseite</a></li>'; } ?>
 <?php if ($_GET["x"]=="news")
 { echo	'<li class="navi_links_aktiv">Neuigkeiten</li>'; }
else
 { echo '<li><a href="news.htm" class="navi_links">Neuigkeiten</a></li>';}?> 
  <?php if ($_GET["x"]=="sendeplan")
 { echo	'<li class="navi_links_aktiv">Sendeplan</li>'; }
else
 { echo '<li><a href="sendeplan.htm" class="navi_links">Sendeplan</a></li>'; } ?>
 <?php if ($_GET["x"]=="events")
 { echo	'<li class="navi_links_aktiv">Events</li>'; }
else
 { echo '<li><a href="events.htm" class="navi_links">Events</a></li>'; } ?>
 <?php if ($_GET["x"]=="bands")
 { echo	'<li class="navi_links_aktiv">Bands</li>'; }
else
 { echo '<li><a href="bands.htm" class="navi_links">Bands</a></li>';}?> 
<?php if ($_GET["x"]=="forum")
 { echo	'<li class="navi_links_aktiv">Forum</li>'; }
else
 { echo '<li><a href="./forum/index.php" target="_blank" class="navi_links">Forum</a></li>';}?> 
<?php if ($_GET["x"]=="chat")
 { echo	'<li class="navi_links_aktiv">Chat</li>'; }
else
 { echo '<li><a href="chat.htm" class="navi_links">Chat</a></li>';}?>
 <?php if ($_GET["x"]=="charts")
 { echo	'<li class="navi_links_aktiv">Charts</li>'; }
else
 { echo '<li><a href="charts.htm" class="navi_links">Charts</a></li>';}?> 
  <?php if ($_GET["x"]=="gbook")
 { echo	'<li class="navi_links_aktiv">G&auml;stebuch</li>'; }
else
 { echo '<li><a href="gaestebuch.htm" class="navi_links">G&auml;stebuch</a></li>';}?> 
<?php if ($_GET["x"]=="podcast")
 { echo	'<li class="navi_links_aktiv">Podcast</li>'; }
else
 { echo '<li><a href="podcast.htm" class="navi_links">Podcast</a></li>';}?> 
<?php if ($_GET["x"]=="download")
 { echo	'<li class="navi_links_aktiv">Download</li>'; }
else
 { echo '<li><a href="download.htm" class="navi_links">Download</a></li>';}?> 
<?php if ($_GET["x"]=="faq")
 { echo	'<li class="navi_links_aktiv">Fragen?</li>'; }
else
 { echo '<li><a href="faq.htm" class="navi_links">Fragen?</a></li>';}?> 
 <?php if ($_GET["x"]=="verlinken")
 { echo	'<li class="navi_links_aktiv">Verlinken</li>'; }
else
 { echo '<li><a href="verlinken.htm" class="navi_links">Verlinken</a></li>'; } ?> 
   <?php if ($_GET["x"]=="tell-a-friend")
 { echo	'<li class="navi_links_aktiv">Weiterempfehlen</li>'; }
else
 { echo '<li><a href="tell-a-friend.htm" class="navi_links">Weiterempfehlen</a></li>';}?> 
 
 
 
 
 
 
<?php if ($_GET["x"]=="bewerben")
 { echo	'<li class="navi_links_aktiv">Bewerben</li>'; }
else
 { echo '<li><a href="bewerben.htm" class="navi_links">Bewerben</a></li>';}?>

 <?php if ($_GET["x"]=="impressum")
 { echo	'<li class="navi_links_aktiv">Impressum</li>'; }
else
 { echo '<li><a href="impressum.htm" class="navi_links">Impressum</a></li>';}?>
 <?php if ($_GET["x"]=="kontakt")
 { echo	'<li class="navi_links_aktiv">Kontakt</li>'; }
else
 { echo '<li><a href="kontakt.htm" class="navi_links">Kontakt</a></li>';}?>
  <?php if ($_GET["x"]=="mitwirkende")
 { echo	'<li class="navi_links_aktiv">Mitwirkende</li>'; }
else
 { echo '<li><a href="mitwirkende.htm" class="navi_links">Mitwirkende</a></li>';}?>
   <?php if ($_GET["x"]=="partner")
 { echo	'<li class="navi_links_aktiv">Partner</li>'; }
else
 { echo '<li><a href="partner.htm" class="navi_links">Partner</a></li>';}?>
<?php if ($_GET["x"]=="spenden")
 { echo	'<li class="navi_links_aktiv">Spenden</li>'; }
else
 { echo '<li><a href="spenden.htm" class="navi_links">Spenden</a></li>';}?>
 <?php## if ($_GET["x"]=="teamspeak")
 ##{ echo	'<li class="navi_links_aktiv">Teamspeak</li>'; }
##else
 ##{ echo '<li><a href="teamspeak.htm" class="navi_links">Teamspeak</a></li>';}
 ?>
 <?php if ($_GET["x"]=="about")
 { echo	'<li class="navi_links_aktiv">&Uuml;ber uns</li>'; }
else
 { echo '<li><a href="ueber-uns.htm" class="navi_links">&Uuml;ber uns</a></li>';}?>


 
 </ul>
 
<!-- Navi Links Ende -->