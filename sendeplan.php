<!-- Sendeplan -->
<?php if (allcheck(53,"",false,""))
{
echo '<h2>Sendplan</h2>
Informiert Euch &uuml;ber die Sendungen auf Discollection-Radio.<br /><br />';

include ("./lib/sendeplan.php");

echo '
<table summary="Sendeplan Heute" frame="void" cellspacing="0" cellpadding="0">
<tr><td class="justwhite"><ul><li> Heute </li></ul></td></tr></table>';
show(0); 

echo '
<table summary="Sendeplan Morgen" frame="void" cellspacing="0" cellpadding="0">
<tr><td class="justwhite"><ul><li> Morgen </li></ul></td></tr></table>
';
show(1);

 

for ($i=2;$i<8;$i++) 
{ 
echo '<br /><br />';
echo wochentag($i);
echo '<br />';
echo datum($i);
echo '<br />';
show($i); 
echo '<br />';

}

}
?>
<br /><br />
<a href="sendeplan_druck.php" target="_blank"><u>Druckversion</u></a>
</td>
<td class="naviwhite" width="30"></td>
<td></td></tr>
<tr><td colspan="5"></td></tr>
</table>
<!-- Sendeplan Ende-->