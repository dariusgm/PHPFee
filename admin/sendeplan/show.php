<?php 
if (function_exists("allcheck"))
{allcheck("admin_sendeplan","sendeplan_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_sendeplan","sendeplan_level",10); }
?>
<table summary="Die Discollection Radio Sendeplan" frame="void" cellspacing="0" cellpadding="0">
<tr><td colspan="5"><img src="./sample/oben.jpg" height="7" width="655" /></td></tr>
<tr><td><img src="./sample/links.jpg" height="850" width="7" /></td>
<td class="naviwhite" width="30"></td>
<td class="justwhite" width="655" height="300"><span id="maintext"><br /><br />



<?php
include ("./lib/lib.php");
?>

<table summary="Sendeplan Heute" frame="void" cellspacing="0" cellpadding="0">
<tr><td class="justwhite"><?php wochentag(0); ?></td></tr><tr>
<td>Heute</td></tr></table><br /><br />
<?php show(0);?>
<hr />
<?php
$i=1;
while ($i < 13)
{ 
echo '<table summary="Sendeplan" frame="void" cellspacing="0" cellpadding="0">
<tr><td class="justwhite">'.wochentag($i).'</td></tr><td><td>'.datumsql($i). '</td></tr></table><br /><br />';
show($i);
$i++;
echo "<hr />";
}
?>
	










<td class="naviwhite" width="30"></td>
<td><img src="./sample/rechts.jpg" height="850" width="7" /></td></tr>
<tr><td colspan="5"><img src="./sample/unten.jpg" height="7" width="655" /></td></tr>
</table>
<!-- Sendeplan Ende-->