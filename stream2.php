<!-- Stream 2 -->
<h2>Stream 2</h2>
<?php if (allcheck(57,"",false,""))
{ 
	
echo '<br />
<table cellpadding="5" summary=" stream radio webradio spaß lustig fun">
<tr><td><img src="./streams/dsl.png" alt="DSL:" /></td><td><a href=""><img src="./streams/winamp.png" alt="Klicke HIER um den  Stream 2 mit dem Winamp zu öffnen" border="0"  /></a></td><td><a href=""><img src="./streams/wmp.png" alt="Klicke HIER um den  Stream 2 mit dem Windows Media Player zu öffnen" border="0"  /></a></td><td><a href=""><img src="./streams/real.png" alt="Klicke hier um den  Stream 2 mit dem Real Player zu öffnen" border="0" /></a></td><td rowspan="2"><a href="psradio:"><img src="./streams/phonostar.png" alt="Klicke HIER um den  Stream 2 mit dem Phonostar zu öffnen" border="0"  /></a></td><td><a href="" target="_blank">Webplayer</a></td></tr>
<tr><td><img src="./streams/isdn.png" alt="ISDN:" /></td><td><a href=""><img src="./streams/winamp.png" alt="Klicke HIER um den  Stream 2 mit dem Winamp zu öffnen" border="0"  /></a></td><td><a href=""><img src="./streams/wmp.png" alt="Klicke HIER um den  Stream 2 mit dem Windows Media Player zu öffnen" border="0"  /></a></td><td><a href=""><img src="./streams/real.png" alt="Klicke hier um den  Stream 2 mit dem Real Player zu öffnen" border="0" /></a></td><td><a href="" target="_blank">Webplayer</a></td></table>
<br />';}
		
include("./lib/stream.php");
include("./onair/banner2.htm");

echo '<br /><br />
Aktuell sendet: <b>';
get_utf(include("./onair/onair_text2.htm"));
echo '</b><br />
Thema der Sendung: '; get_utf(include("./onair/banner_text2.htm"));
echo '<br />';
get_mod_stats(2);
?>
<!-- Stream 2 Ende -->