<?php

if (checkstatus("fundus_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>

<?php do_added_adressen();?>
<table><form method="post" action="index.php?x=adressenadded"><tr><td>Username:</td><td><input type="text" name="nick" /></td></tr>
<tr><td>Vorname:</td><td><input type="text" name="vorname" /></td></tr>
<tr><td>Nachname:</td><td><input type="text" name="nachname" /></td></tr>
<tr><td>Straße:</td><td><input type="text" name="strasse" /></td></tr>
<tr><td>Hausnummer:</td><td><input type="text" name="hausnr" /></td></tr>
<tr><td>PLZ:</td><td><input type="text" name="plz" /></td></tr>
<tr><td>Ort:</td><td><input type="text" name="ort" /></td></tr>
<tr><td>Land:</td><td><input type="text" name="land" /></td></tr>
<tr><td>Diverses:</td><td><input type="text" name="diverses" /></td></tr>
<tr><td><button type="submit">Hinzufügen</button></td></tr>
<?php userandpass();?></form></table>