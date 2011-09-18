<?php require_once("../lib.php");?>
<?php require_once("./lib/lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   {
	   
check_file_banner(1);
check_file_banner(2);
check_file_banner(3);
check_file_banner(4);
check_file_banner(5);
check_file_banner(6);
check_file_banner(7);
check_file_banner(8);
check_file_banner(9);
check_file_onair(1);   
check_file_onair(2);	   
	   
	    echo '<form method="post" action="index.php?x=edit" enctype="multipart/form-data"><input type="hidden" name="MAX_FILE_SIZE" value="500000"><table>';
$check_banner=check_banner(1);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>Banner 1:</td><td><input type="file" name="banner1" /></td><td><select name="do_banner1"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>';

$check_banner=check_banner(2);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>Banner 2:</td><td><input type="file" name="banner2" /></td><td><select name="do_banner2"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>';  

$check_banner=check_banner(3);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>Banner 3:</td><td><input type="file" name="banner3" /></td><td><select name="do_banner3"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>'; 

$check_banner=check_banner(4);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>Banner 4:</td><td><input type="file" name="banner4" /></td><td><select name="do_banner4"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>'; 

$check_banner=check_banner(5);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>Banner 5:</td><td><input type="file" name="banner5" /></td><td><select name="do_banner5"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>'; 

$check_banner=check_banner(6);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>Banner 6:</td><td><input type="file" name="banner6" /></td><td><select name="do_banner6"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>'; 

$check_banner=check_banner(7);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>Banner 7:</td><td><input type="file" name="banner7" /></td><td><select name="do_banner7"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>'; 

$check_banner=check_banner(8);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>Banner 8:</td><td><input type="file" name="banner8" /></td><td><select name="do_banner8"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>'; 

$check_banner=check_banner(9);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>Banner 9:</td><td><input type="file" name="banner9" /></td><td><select name="do_banner9"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>';

$check_banner=check_onair(1);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/onair'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>On Air 1:</td><td><input type="file" name="onair1" /></td><td><select name="do_onair1"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>';

$check_banner=check_onair(2);
if ($check_banner)
{ echo '<tr><td colspan="2"><img src="../../onair/onair'.$check_banner.'" /></td></tr>'; }
echo '<tr><td>On Air 2:</td><td><input type="file" name="onair2" /></td><td><select name="do_onair2"><option value="behalten">Behalten</option><option value="replace">Ersetzen / Hochladen</option></td></tr>';


userandpass();

echo '</table><table><tr><td><button type="submit">Speichern</td></tr></table></form>';
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
