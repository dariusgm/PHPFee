<?php

if (checkstatus("fundus_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>

<?php do_added_geschenke();?>
<table><form method="post" action="index.php?x=geschenkeadded">
<tr><td>Name:</td><td><input type="text" name="name" /></td></tr>
<tr><td>Beschreibung:</td><td><input type="text" name="beschreibung" /></td></tr>
<tr><td>Anzahl:</td><td><input type="text" name="anzahl" /></td></tr>
<tr><td>Sponsorname:</td><td><input type="text" name="sponsor_name" /></td></tr>
<tr><td>Sponsorurl:</td><td><input type="text" name="sponsor_url" /></td></tr>
<tr><td>Sponsoruser:</td><td><input type="text" name="sponsor_user" /></td></tr>
<tr><td>Kosten:</td><td><input type="text" name="kosten" /></td></tr>
<tr><td><button type="submit">Hinzufügen</button></td></tr>
<?php userandpass();?></form></table>