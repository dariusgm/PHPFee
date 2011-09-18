<!-- User Suchen -->
<?php if (allcheck(52,"","portal_level",0))
{
 echo '<h2>User suchen</h2>
 
 Hier hast Du die M&ouml;glichkeit registrierte Benutzer gezielt zu suchen. Wenn Du den Usernamen kennst, so gib ihn einfach in das Suchfeld ein.<br />
Willst Du erfahren, ob auch Leute aus Deiner N&auml;he bei uns registriert sind, so kannst Du &uuml;ber die Wohnort-Postleitzahl-Suche f&uuml;ndig werden.<br />
Die Suchergebnisse werden dann hier angezeigt.<br />
Bitte gib oben den Suchbegriff ein, um jemanden aus Deinem Freundeskreis oder aus Deiner Umgebung zu suchen.<br />
Die Suchergebnisse werden dann hier angezeigt.<br /><br />
 
<form method="post" action="index.php?x=search">
<table><tr><td>Username:</td><td><input type="text" name="searchuser" value="'.get_utf($_POST["searchuser"]).'" /></td></tr>
<tr><td>Wohnortpostleitzahl:</td><td><input type="text" name="searchplz" value="'.get_utf($_POST["searchplz"]).'" /></td></tr></table>
<table><tr><td><button type="submit">Suchen</button><input type="hidden" name="do" value="search" /></td></tr></table></form>

<hr />';

 include("./lib/search.php");
 search_user();

 } ?>


<!-- Suchen Ende -->