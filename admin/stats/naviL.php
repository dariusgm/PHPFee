<?php
	
function get_nick() {
	//Nick Pr&uuml;fen
  if (isset($_SESSION["nick"]))
  { $nickname = $_SESSION["nick"]; }
  
  elseif (isset($_POST["userinput"]))
  { $nickname = $_POST["userinput"]; }
 return $nickname; 
 }
 
 function get_pw()
 {
  //PW Pr&uuml;fen
  if (isset($_SESSION["pw"]))
  { $pw = $_SESSION["pw"]; }
  
  elseif (isset($_POST["passinput"]))
  { $pw = $_POST["passinput"]; }
  return $pw; 
}
  ?>

  
<?php
if (checkstatus("stats_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>


<?
function write_box($file,$text)
{
echo '<tr><td>';
if ($_GET["x"]==$file)
{echo '>&nbsp;'.$text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.get_nick().'" />
<input type="hidden" name="passinput" value="'.get_pw().'" />
<button type="submit">>&nbsp;'.$text.'</button></form>'; }
echo '</td></tr>';}?>



<?php
echo '
LINKS: <br />
<table border="1"><tr><td><form action="../index.php" method="post">
<input type="hidden" name="userinput" value="'.get_nick().'" />
<input type="hidden" name="passinput" value="'.get_pw().'" />
<button type="submit">ADMIN Startseite</button></form></td></tr>';
?>

<tr><td>
<?php
$file="";
$text=">&nbsp;Infos";

if ($_GET["x"]=="")
{echo $text; }
else
{ echo '<form action="index.php" method="post">
<input type="hidden" name="userinput" value="'.get_nick().'" />
<input type="hidden" name="passinput" value="'.get_pw().'" />
<button type="submit">'.$text.'</button></form>'; } ?>

<?php 
write_box("start","Startseite");
write_box("news","News");
write_box("sendeplan","Sendeplan");
write_box("events","Events");
write_box("download","Download");
write_box("charts","Charts");
write_box("teamspeak","Teamspeak");
write_box("tell-a-friend","Tell-a-friend");
write_box("bands","Bands");
write_box("podcast","Podcast");
write_box("chat","Chat");
write_box("forum","Forum");
write_box("gbook","Gästebuch");
write_box("search","User suchen");
write_box("log-in","Log-in");
write_box("register","registrieren");
write_box("akti","aktivieren");
write_box("password","Passwort");
write_box("about","Über uns");
write_box("partner","Partner");
write_box("shop","Shop");
write_box("bewerben","Bewerbung");
write_box("faq","FAQ");
write_box("mitwirkende","Mitwirkende");
write_box("kontakt","Kontakt");
write_box("impressum","Impressum");



?>

</table>