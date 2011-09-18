<?php
	//Nick Pr&uuml;fen
  if (isset($_SESSION["nick"]))
  { $nickname = $_SESSION["nick"]; }
  
  elseif (isset($_POST["userinput"]))
  { $nickname = $_POST["userinput"]; }
  
  //PW Pr&uuml;fen
  if (isset($_SESSION["pw"]))
  { $pw = $_SESSION["pw"]; }
  
  elseif (isset($_POST["passinput"]))
  { $pw = $_POST["passinput"]; }?>
  
  
  <?php
if (checkstatus("portal_level")<"4")
{ echo "<h1>Zugriff verweigert!</h1>";
exit (); }?>

<table border="1"><tr><td>Startseite</td></tr>

<tr><td><form action="./onair/index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $nickname; ?>" />
<input type="hidden" name="passinput" value="<?php echo $pw; ?>" />
<button type="submit">>&nbsp;On Air</button></form></td></tr>

<tr><td><form action="./playlist/index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $nickname; ?>" />
<input type="hidden" name="passinput" value="<?php echo $pw; ?>" />
<button type="submit">>&nbsp;Playlist</button></form></td></tr>


<tr><td><form action="./banner/index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $nickname; ?>" />
<input type="hidden" name="passinput" value="<?php echo $pw; ?>" />
<button type="submit">>&nbsp;Banner</button></form></td></tr>

<tr><td><form action="./charts/index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $nickname; ?>" />
<input type="hidden" name="passinput" value="<?php echo $pw; ?>" />
<button type="submit">>&nbsp;Charts</button></form></td></tr>

<tr><td><form action="./download/index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $nickname; ?>" />
<input type="hidden" name="passinput" value="<?php echo $pw; ?>" />
<button type="submit">>&nbsp;Download</button></form></td></tr>

<tr><td><form action="./fundus/index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $nickname; ?>" />
<input type="hidden" name="passinput" value="<?php echo $pw; ?>" />
<button type="submit">>&nbsp;Fundus</button></form></td></tr>

<tr><td><form action="./leitfaden/index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $nickname; ?>" />
<input type="hidden" name="passinput" value="<?php echo $pw; ?>" />
<button type="submit">>&nbsp;Leitfaden</button></form></td></tr>

<tr><td><form action="./sendeplan/index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $nickname; ?>" />
<input type="hidden" name="passinput" value="<?php echo $pw; ?>" />
<button type="submit">>&nbsp;Sendeplan</button></form></td></tr>


<tr><td><form action="./urlaub/index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $nickname; ?>" />
<input type="hidden" name="passinput" value="<?php echo $pw; ?>" />
<button type="submit">>&nbsp;Urlaub</button></form></td></tr>




</table>