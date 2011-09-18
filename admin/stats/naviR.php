<?php
if (checkstatus("stats_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>




<?php
echo '
RECHTS: <br />
<table border="1"><tr><td><form action="../index.php" method="post">
<input type="hidden" name="userinput" value="'.get_nick().'" />
<input type="hidden" name="passinput" value="'.get_pw().'" />
<button type="submit">ADMIN Startseite</button></form></td></tr>';
?>


<?php 
write_box("stream1","Stream 1");
write_box("stream2","Stream 2");
write_box("edit","Profil ändern");
write_box("show","Profil anzeigen");
write_box("mitteilungen","Mitteilungen");
write_box("foto","Fotomenü");
write_box("gbedit","Gästebuch");
write_box("block","Blockliste");
write_box("referer","Referer");
write_box("browser","Browser");
write_box("stats_user","Einzelstatistiken");
write_box("stats_bot","Bots");



?>

</table>