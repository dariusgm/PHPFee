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
if (checkstatus("portal_level")<"5")
{ echo "<h1>Zugriff verweigert!</h1>"; exit();}?>

<table border="1"><tr><td><form action="../index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $_POST["userinput"]; ?>" />
<input type="hidden" name="passinput" value="<?php echo $_POST["passinput"]; ?>" />
<button type="submit">MOD Startseite</button></form></td></tr>

<tr><td>
<?php
$file="";
$text=">&nbsp;Banner<br />Info";

if ($_GET["x"]=="")
{echo $text; }
else
{ echo '<form action="index.php" method="post">
<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>
<tr><td>

<?php
$file="edit";
$text=">&nbsp;Banner<br />verwalten";

if ($_GET["x"]==$file)
{echo $text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>



</table>