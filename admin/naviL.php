<?php
	//Nick Pr&uuml;fen
  if (isset($_SESSION["nick"]))
  { $nickname = $_SESSION["nick"]; }
  
  elseif (isset($_POST["userinput"]))
  { $nickname = $_POST["userinput"]; }
  
  //PW Pr&uuml;fen
  if (isset($_SESSION["pw"]))
  { $pw = $_SESSION["pw"]; }
  
  elseif (isset($_POST["passinput"]))
  { $pw = $_POST["passinput"]; }?>


<table border="0" cellspacing="5" cellpadding="5"><tr>
<?php

if (checkstatus("portal_level")>="15")
{
echo '
<td valign="buttom" align="center"><form action="./clean/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Aufr&auml;umen</button></form></td>'; 
}


if (checkstatus("bands_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./bands/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Bands</button></form></td>';}

if (checkstatus("chat_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./chat/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Chat</button></form></td>';}

if (checkstatus("charts_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./charts/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Charts</button></form></td>';}

if (checkstatus("download_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./download/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Download</button></form></td>';}

if (checkstatus("events_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./events/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Events</button></form></td>'; 
}



if (checkstatus("foto_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./foto/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Foto</button></form></td>';}

if (checkstatus("fundus_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./fundus/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Fundus</button></form></td>';}


if (checkstatus("gastebuch_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./gastebuch/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">G&auml;stebuch</button></form></td>';}

if (checkstatus("grusbox_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./grusbox/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Gru&szlig;box</button></form></td>';}

echo '</tr><tr>';

if (checkstatus("info_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./info/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Info Zentrum</button></form></td>';}


if (checkstatus("news_level")>="10")
{
echo '
<td><form action="./news/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">News</button></form></td>';
}

if (checkstatus("portal_level")>=15)
{ echo '
<td valign="buttom" align="center"><form action="./news_intern/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">News Intern</button></form></td>
';}

if (checkstatus("playlist_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./playlist/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Playlist</button></form></td>';}

if (checkstatus("podcast_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./podcast/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Podcast</button></form></td>';}

if (checkstatus("sendeplan_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./sendeplan/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Sendeplan</button></form></td>';}

if (checkstatus("portal_level")>="15")
{
echo '
<td valign="buttom" align="center"><form action="./relay/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Relay</button></form></td>';}

if (checkstatus("stats_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./stats/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Statistiken</button></form></td>';}

if (checkstatus("user_level")>="10")
{
echo '
<td valign="buttom" align="center"><form action="./verwaltung/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">User verwaltung</button></form></td>';}

if (checkstatus("portal_level")>="15")
{
echo'
<td valign="buttom" align="center"><form action="./webmaster/index.php" method="post">
<input type="hidden" name="userinput" value="'.$nickname.'" />
<input type="hidden" name="passinput" value="'.$pw.'" />
<button type="submit">Webmaster</button></form></td>'; }

?></tr>
</table>