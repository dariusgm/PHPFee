<!--Stream 1-->
<?php if (allcheck(56,"",false,""))
{ 
	
echo '<h2>Stream 1</h2>
<table cellpadding="5" summary="Pop-Fox.de stream radio webradio spaß lustig fun">
<tr><td><img src="./streams/dsl.png" alt="DSL:" /></td><td><a href=""><img src="./streams/winamp.png" alt="" border="0"  /></a></td><td><a href=""><img src="./streams/wmp.png" alt="" border="0"  /></a></td><td><a href=""><img src="./streams/real.png" alt="" border="0" /></a></td><td rowspan="2"><a href="psradio:"><img src="./streams/phonostar.png" alt="" border="0"  /></a></td><td><a href="" target="_blank">Webplayer</a></td></tr>
<tr><td><img src="./streams/isdn.png" alt="ISDN:" /></td><td><a href=""><img src="./streams/winamp.png" alt="" border="0"  /></a></td><td><a href=""><img src="./streams/wmp.png" alt="" border="0"  /></a></td><td><a href=""><img src="./streams/real.png" alt="" border="0" /></a></td><td><a href="" target="_blank">Webplayer</a></td></table>
<br />';}
		
include("./lib/stream.php");
include("./onair/banner1.htm");

echo '<br /><br />
Aktuell sendet: <b>';
get_utf(include("./onair/onair_text1.htm"));
echo '</b><br />
Thema der Sendung: '; get_utf(include("./onair/banner_text1.htm"));
echo '<br />';
get_mod_stats(1);
?>
<!-- Stream 1 Ende -->