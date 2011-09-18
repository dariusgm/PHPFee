<!-- Stream 3-->
<h2>Stream 3</h2>
<?php if (allcheck(70,"",false,""))
{ 
	
echo '<br />
<table cellpadding="5" summary="Pop-Fox.de stream radio webradio spaß lustig fun">
<tr><td><img src="./streams/dsl.png" alt="DSL:" /></td><td><a href=""><img src="./streams/winamp.png" alt="Klicke HIER um den Pop-Fox.de Stream 3 mit dem Winamp zu öffnen" border="0"  /></a></td><td><a href=""><img src="./streams/wmp.png" alt="Klicke HIER um den Pop-Fox.de Stream 3 mit dem Windows Media Player zu öffnen" border="0"  /></a></td><td><a href=""><img src="./streams/real.png" alt="Klicke hier um den Pop-Fox.de Stream 3 mit dem Real Player zu öffnen" border="0" /></a></td><td rowspan="2"><a href="psradio:"><img src="./streams/phonostar.png" alt="Klicke HIER um den Pop-Fox.de Stream 3 mit dem Phonostar zu öffnen" border="0"  /></a></td><td><a href="" target="_blank">Webplayer</a></td></tr>
<tr><td><img src="./streams/isdn.png" alt="ISDN:" /></td><td><a href=""><img src="./streams/winamp.png" alt="Klicke HIER um den Pop-Fox.de Stream 3 mit dem Winamp zu öffnen" border="0"  /></a></td><td><a href=""><img src="./streams/wmp.png" alt="Klicke HIER um den Pop-Fox.de Stream 3 mit dem Windows Media Player zu öffnen" border="0"  /></a></td><td><a href=""><img src="./streams/real.png" alt="Klicke hier um den Pop-Fox.de Stream 3 mit dem Real Player zu öffnen" border="0" /></a></td><td><a href="" target="_blank">Webplayer</a></td></table>
<br />';}
		
include("./lib/stream.php");
include("./onair/banner3.htm");

echo '<br /><br />
Aktuell sendet: <b>';
get_utf(include("./onair/onair_text3.htm"));
echo '</b><br />
Thema der Sendung: '; get_utf(include("./onair/banner_text3.htm"));
echo '<br />';
get_mod_stats(1);
?>
<!-- Stream 3 Ende -->