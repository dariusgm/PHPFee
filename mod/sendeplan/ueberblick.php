<?php
session_start();
?>

<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { 
   include("./lib/lib.php"); 
   echo '
   
  ROT = STREAM 1 leer<br /><br />
GRÜN = STREAM 1 belegt<br /><br />
';

echo '<table width="850" border="1"><tr><td width="150">Zeit</td>


<td width="100">';
$tmp = datumsql(0);
echo ''.substr($tmp,8,2).'.'.substr($tmp,5,2).'.'.substr($tmp,0,4).'';echo '<br />';
 echo wochentag(0);
 echo '</td>';

echo '<td width="100">';
$tmp = datumsql(1);
echo ''.substr($tmp,8,2).'.'.substr($tmp,5,2).'.'.substr($tmp,0,4).'';echo '<br />';
echo wochentag(1);
echo '</td>';
 
echo '<td width="100">';
$tmp = datumsql(2);
echo ''.substr($tmp,8,2).'.'.substr($tmp,5,2).'.'.substr($tmp,0,4).'';echo '<br />';
echo wochentag(2);
echo '</td>'; 
 
echo '<td width="100">';
$tmp = datumsql(3);
echo ''.substr($tmp,8,2).'.'.substr($tmp,5,2).'.'.substr($tmp,0,4).'';echo '<br />';
echo wochentag(3);
echo '</td>';

echo '<td width="100">';
$tmp = datumsql(4);
echo ''.substr($tmp,8,2).'.'.substr($tmp,5,2).'.'.substr($tmp,0,4).'';echo '<br />';
echo wochentag(4);
echo '</td>';

echo '<td width="100">';
$tmp = datumsql(5);
echo ''.substr($tmp,8,2).'.'.substr($tmp,5,2).'.'.substr($tmp,0,4).'';echo '<br />';
echo wochentag(5);
echo '</td>';

echo '<td width="100">';
$tmp = datumsql(6);
echo ''.substr($tmp,8,2).'.'.substr($tmp,5,2).'.'.substr($tmp,0,4).'';echo '<br />';
echo wochentag(6);
echo '</td>';

echo '<td width="100">';
$tmp = datumsql(1);
echo ''.substr($tmp,8,2).'.'.substr($tmp,5,2).'.'.substr($tmp,0,4).'';echo '<br />';
echo wochentag(1);
echo '</td></tr>';

$zeit=0;
// Sieht die Tabelle runter,( Stunden)
while($zeit<24)
{
echo '<tr><td>'.$zeit.':00 - '.($zeit+1).':00</td>';


$i=0;
//Zieht sie Breit
while($i<8)
{ 
echo '<td>';
echo show_mod(datumsql($i),$zeit."00",($zeit."00"+100),1);
echo '';
//echo '<br /><font color="green">';
//echo show_mod(datumsql($i),$zeit."00",($zeit."00"+100),2);
//echo '</font> <br /><font color="black">';
//echo show_mod(datumsql($i),$zeit."00",($zeit."00"+100),3);
//echo '</font><br />';
echo '</td>';

$i++;

}
echo '</tr>';

$zeit++;
}   










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


















