<!-- Registrieren -->
<?php if (allcheck(51,"",false,""))
{echo '
<h2>Registrieren</h2>

 


<table>
<form method="post" action="index.php?x=do_register">
<tr><td width="100">Nickname:</td><td><input type="text" size="20" maxlength="20" name="nick" value="" /></td></tr>
<tr><td>Passwort:</td><td><input type="password" size="20" maxlength="20" name="pw" value="" /></td></tr>
<tr><td>Nochmal Passwort:</td><td><input type="password" size="20" name="pw2" maxlength="20" name="p" value="" /></td></tr>
<tr><td>E-Mail:</td><td><input type="text" size="50" maxlength="50" name="email" value="" /></td></tr>
<tr><td>Geschlecht:</td><td><select name="sex"><option value="m">M&auml;nnlich</option><option value="w">Weiblich</option></select></td></tr>
</table><br /><br />

<input type="hidden" name="do" value="register" />
Ich habe die oben stehenden Nutzungsbedingungen gelesen und bin mit ihnen einverstanden. Au&szlig;erdem bin ich damit einverstanden E-Mails von Pop-Fox.de zu erhalten mit Programmhinweisen und Neuerungen in Bezug auf das Radio. Eine Weitergabe der Daten an Dritte geschiet nicht!<br />
Ich bin mir bewu&szlig;t, dass die Angabe einer falschen oder ung&uuml;ltigen E-Mail-Adresse dazu f&uuml;hrt, dass mein Account nicht aktiviert werden kann.<br /><select name="acc_agb">
 <option value="0" checked="checked">Nein</option>
 <option value="1">Ja</option>
</select><br /><br /><button type="submit">Absenden</button> 
</form>

<br /><br />
<b>Merke</b>
<br />
<br />
Gib den Namen ein, so wie du ihn auf unserer Website benutzen willst, er l&auml;&szlig;t sich hinterher nicht mehr &auml;ndern! An deine angegebene Adresse schicken wir einen Aktivierungscode. Erst dann ist dein Nickname benutzbar. <br />
Folgende zeichen sind nicht erlaubt: <b> < > ; & &uuml; &ouml; &auml; &szlig; </b>
<br /><br />
</span>'; }?>
</td>
<td class="naviwhite" width="30"></td>
<td></td></tr>
<tr><td colspan="5"></td></tr>
</table>

<!-- Registrieren Ende-->