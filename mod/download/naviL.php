<?php
require_once("../lib.php");
?>

<table border="1"><tr><td><form action="../index.php" method="post">
<input type="hidden" name="userinput" value="<?php echo $_POST["userinput"]; ?>" />
<input type="hidden" name="passinput" value="<?php echo $_POST["passinput"]; ?>" />
<button type="submit">MOD Startseite</button></form></td></tr>

<tr><td>
<?php
$file="";
$text=">&nbsp;Download<br />Info";

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
$file="software";
$text=">&nbsp;Software";

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
$file="musik";
$text=">&nbsp;Musik";

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
$file="msn";
$text=">&nbsp;MSN Adressen";

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
$file="msninfo";
$text=">&nbsp;MSN Anleitung";

if ($_GET["x"]==$file)
{echo $text; }
else
{ echo '<form action="index.php?x='.$file.'" method="post">
<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
<button type="submit">'.$text.'</button></form>'; } ?>

</td></tr>
</table>