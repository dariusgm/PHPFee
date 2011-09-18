<?php

if (checkstatus("user_level")<10)
{ echo '<h1>Zugriff verweigert</h1>';
exit ();}?>

User die einen neuen Rang bekommen sollen, 
m&uuml;ssen zus&auml;tzlich ein neuen Portal Level bekommen. Sonst wird das Men&uuml; auf der Hauptseite nicht angezeigt!


<?php
if (checkstatus("user_level")>=10)
{ 
	
echo '<table border="1"><tr><td>Portal Level:';	
	
	show_user_admin("portal_level");

echo '<br /></td><td>News Level';

	show_user_admin("news_level"); 	
	
echo '<br /></td><td>Sendeplan Level';	

	show_user_admin("sendeplan_level"); 
	
echo '<br /></td><td>Chat Level';	

	show_user_admin("Chat_level"); 	
		
echo '<br /></td></tr>';	
	 
// 2te Zeile


echo '<tr><td>Userverwaltung:';	
	
	show_user_admin("user_level");

echo '<br /></td><td>Download Level';

	show_user_admin("download_level"); 	
	
echo '<br /></td><td>Charts Level';	

	show_user_admin("charts_level"); 
	
echo '<br /></td><td>G&auml;stebuch Level';	

	show_user_admin("gastebuch_level"); 	
		
echo '<br /></td></tr>';	

//3te Zeile

echo '<tr><td>Info-Mailer:';	
	
	show_user_admin("info_level");

echo '<br /></td><td>Playlist Level';

	show_user_admin("playlist_level"); 	
	
echo '<br /></td><td>Stats Level';	

	show_user_admin("stats_level"); 
	
echo '<br /></td><td>Homepage Level';	

	show_user_admin("homepage_level"); 	
		
echo '<br /></td></tr>';

}
	 
	 
?>



