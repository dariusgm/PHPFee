<?php
function show_box()
{	if (is_numeric($_POST["art"]) && is_numeric($_POST["element"]) && is_numeric($_POST["stream"]))
	{
		if ($_POST["art"]==1)
		{
			echo 'Dein PHP Code:<br /><br /><textarea cols="75" rows="3">';
			if ($_POST["element"]==1)
			{ echo htmlentities('<?php include("onair_text'.$_POST["stream"].'.htm");?>');
			echo '</textarea><br /><br />Beispiel: ';
			include("onair_text".$_POST["stream"].".htm");
			}		 
			
			if ($_POST["element"]==2)
			{ echo htmlentities('<?php include("onair'.$_POST["stream"].'.htm");?>');
			echo '</textarea><br /><br />Beispiel:';
			include("onair".$_POST["stream"].".htm");
			}
			
			if ($_POST["element"]==3)
			{ echo htmlentities('<?php include("banner_text'.$_POST["stream"].'.htm");?>');
			echo '</textarea><br /><br />Beispiel:';
			include("onair/banner_text".$_POST["stream"].".htm");
			}
			
			if ($_POST["element"]==4)
			{ echo htmlentities('<?php include("banner'.$_POST["stream"].'.htm");?>');
			echo '</textarea><br /><br />Beispiel:';
			include("onair/banner".$_POST["stream"].".htm");
			}
			
			if ($_POST["element"]==5)
			{ echo htmlentities('<?php include("banner'.$_POST["stream"].'.htm");?>');
			echo '</textarea><br /><br />Beispiel:';
			include("onair/banner".$_POST["stream"].".htm");
			}			
			echo '<a href="verlinken.htm">Möchtest du noch etwas generieren ?</a>';			
			
        }
        
        if($_POST["art"]==2)
        {
	       echo 'Dein Code:<br /><br /><textarea cols="75" rows="3">';
	        if ($_POST["element"]==1)
	        { echo htmlentities('<script language="JavaScript" src="onair'.$_POST["stream"].'.js"><a href="http://www.discollection-radio.eu/stream'.$_POST["stream"].'.htm">A</a></script>');

			echo '</textarea><br /><br />Beispiel:
			<script language="JavaScript" src="onair'.$_POST["stream"].'.js"><a href="http://www.discollection-radio.eu/stream'.$_POST["stream"].'.htm">B</a></script>';
			
			}	
	        
	        
	        
	    }
	
}
else
{ write_box(); }
}

function write_box()
{echo '<form method="post" action="verlinken.htm"><table summary="Generieungsformular f&uuml;r externes Einbinden" border="1">
<tr><th>Infotext</th><th>Kurzname</th><th>Auswahlmen&uuml;</th></tr>
<tr><td>Sollte bei dir das direkte Einbinden von PHP m&ouml;glich sein, w&auml;hle hier PHP+HTML, andernfalls IFRAME (JavaScript)</td><td>Einbingunsart</td><td><select name="art"><option value="2">IFRAME / JavaScript.</option><option value="1">PHP</option></select></td></tr>
<tr><td>W&auml;hle hier, welches Element du haben m&ouml;chtest. M&ouml;chtest du es einfach haben, w&auml;hle die Standarteinstellung "einfach" und es wird dir ein Fertiges Paket generiert das du 1:1 auf deine Seite setzen kannst. W&auml;hlst du nur bestimme Elemente aus, wird dir nur der daf&uuml;r ben&ouml;tigte Code angezeigt. Achte dabei bitte drauf das diese zus&auml;tzlich <a href="#formatierung">Formatiert</a> werden m&uuml;ssen.</td><td>Element:</td><td><select name="element"><option value="5">einfach</option><option value="1">Nur Moderatorname</option><option value="2">Moderatorbild</option><option value="3">Titel der Sendung</option><option value="4">Banner der Sendung</option></select></td></tr>
<tr><td>W&auml;hle welchen Stream du einbinden m&ouml;chtest. Auf dem ersten l&auml;uft nur Eurodance, der 2te ist gemischt. Weitere sind Zur Zeit nicht geplant.</td><td>Stream</td><td><select name="stream"><option value="1">Eurodance (Stream 1)</option><option value="2">Gemischt (Stream 2)</option></select></td></tr>
<tr><td>Falls du dich f&uuml;r ein komplettpaket entscheidest, kannst du hier eine Farbenkombination ausw&auml;hlen</td><td>Farb-kombination</td><td><select name="farbe"><option value="1">Grau / Rot</option><option value="2">Dunkelrot / Gold</option></td></tr>
<tr><td colspan="3"><button type="submit" style="width:100%;">Generieren</button></td></tr>
</table></form>';}

?>