<?php
include("./lib/sendeplan.php");
include("./lib/status.php");
include("./lib/stats.php");
if (allcheck(71,"",false,""))
{
echo '
Discollection-radio.de Sendeplan, Druckversion
<table summary="Sendeplan Heute" frame="void" cellspacing="0" cellpadding="0">
<tr><td><ul><li> Heute </li></ul></td></tr></table>';
show(0); 

echo '
<table summary="Sendeplan Morgen" frame="void" cellspacing="0" cellpadding="0">
<tr><td><ul><li> Morgen </li></ul></td></tr></table>
';
show(1);

 

for ($i=2;$i<8;$i++) 
{ 

echo '<br /><table summary="Sendeplan ';  
echo wochentag($i); 
echo '" frame="void" cellspacing="0" cellpadding="0">
<tr><td><ul><li>';
echo wochentag($i);
echo '<br /> ';
echo datum($i);
echo '</li></ul></td></tr></table>';
 show($i); 

}
}

?>