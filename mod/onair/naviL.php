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

<table border="1"><tr><td><form action="../index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $_POST["userinput"]; ?>" />
<input type="hidden" name="passinput" value="<?php echo $_POST["passinput"]; ?>" />
<button type="submit">MOD Startseite</button></form></td></tr>

<tr><td>
<?php
$file="";
$text=">&nbsp;On Air Infos";

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
$file="stream&id=1";
$text=">&nbsp;Stream 1 Connect";

if ($_GET["id"]==1)
{echo $text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>
<tr><td>

<?php
$file="stream&id=2";
$text=">&nbsp;Stream 2 Connect";

if ($_GET["id"]==2)
{echo $text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>
<tr><td>

<?php
$file="stream&id=3";
$text=">&nbsp;Stream 3 Connect";

if ($_GET["id"]==3)
{echo $text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>
<tr><td>

<?php
$file="multi";
$text=">&nbsp;Multiuser";

if ($_GET["x"]==$file)
{echo $text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>
<tr><td>

<?php
$file="casting";
$text=">&nbsp;Casting Eingabe";

if ($_GET["x"]==$file)
{echo $text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>
</table>