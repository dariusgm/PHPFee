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
if (checkstatus("playlist_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>

<?php
echo '
<table border="1"><tr><td><form action="../index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">ADMIN Startseite</button></form></td></tr>';
?>

<tr><td>
<?php
$file="";
$text=">&nbsp;Podcast<br />Info";

if ($_GET["x"]=="")
{echo $text; }
else
{ echo '<form action="index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>
<tr><td>

<?php
$file="added";
$text=">&nbsp;Podcast<br />hinzuf&uuml;gen";

if ($_GET["x"]==$file)
{echo $text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>
<tr><td>

<?php
$file="edit";
$text=">&nbsp;Podcast<br />bearbeiten";

if ($_GET["x"]==$file)
{echo $text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>
<tr><td>

<?php
$file="public";
$text=">&nbsp;Podcast<br />ver&ouml;ffentlichen";

if ($_GET["x"]==$file)
{echo $text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>

</table>