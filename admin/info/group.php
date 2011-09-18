<?php 
if (function_exists("allcheck"))
{ allcheck("admin_info","info_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_info","info_level",10); }
?>
<?php
require_once("./lib/lib.php");
do_send_group();
?>

Es k&ouml;nnen bis zu 5 Gruppen ausgew&auml;hlt werden an die die IM versendet werden soll.
<table border="1"><form method="post" action="index.php?x=group"><tr><td>Betreff:   <input type="text" name="betreff" value="Kein Betreff" /></td></tr>
<td colspan="2">Deine Nachricht:<br /><textarea name="text" cols="30" rows="10"></textarea></td></tr>
<tr><td>Gruppe1 aussuchen:
<select name="group1">
<option value="0">Ausw&auml;hlen:</option>
<option value="0">---ADMIN---</option>
<option value="1">Portal</option>
<option value="2">News</option>
<option value="3">Sendeplan</option>
<option value="4">Chat</option>
<option value="5">Verwaltung</option>
<option value="6">Download</option>
<option value="7">Charts</option>
<option value="8">G&auml;stebuch</option>
<option value="9">Infozentrum</option>
<option value="10">Playlist</option>
<option value="11">Gru&szlig;box</option>
<option value="12">Statistiken</option>
<option value="13">Forum</option>
<option value="14">Homepage</option>
<option value="15">Bands</option>
<option value="16">Podcast</option>
<option value="17">Foto</option>
<option value="18">Bewerbung</option>
<option value="19">Urlaub</option>
<option value="0">---MOD---</option>
<option value="51">Portal</option>
<option value="52">News</option>
<option value="53">Sendeplan</option>
<option value="54">Chat</option>
<option value="55">Verwaltung</option>
<option value="56">Download</option>
<option value="57">Charts</option>
<option value="58">G&auml;stebuch</option>
<option value="59">Infozentrum</option>
<option value="510">Playlist</option>
<option value="511">Gru&szlig;box</option>
<option value="512">Statistiken</option>
<option value="513">Forum</option>
<option value="514">Homepage</option>
<option value="515">Bands</option>
<option value="516">Podcast</option>
<option value="517">Foto</option>
<option value="518">Bewerbung</option>
<option value="519">Urlaub</option>
<?php 
if (checkstatus("portal_level")==15)
{ echo '
<option value="0">---USER---</option>
<option value="101">Portal</option>
<option value="102">News</option>
<option value="103">Sendeplan</option>
<option value="104">Chat</option>
<option value="105">Verwaltung</option>
<option value="106">Download</option>
<option value="107">Charts</option>
<option value="108">G&auml;stebuch</option>
<option value="109">Infozentrum</option>
<option value="1010">Playlist</option>
<option value="1011">Gru&szlig;box</option>
<option value="1012">Statistiken</option>
<option value="1013">Forum</option>
<option value="1014">Homepage</option>
<option value="1015">Bands</option>
<option value="1016">Podcast</option>
<option value="1017">Foto</option>
<option value="1018">Bewerbung</option>
<option value="1019">Urlaub</option></select>';}?>
</td></tr>



<tr><td>Gruppe2 aussuchen:
<select name="group1">
<option value="0">Ausw&auml;hlen:</option>
<option value="0">---ADMIN---</option>
<option value="1">Portal</option>
<option value="2">News</option>
<option value="3">Sendeplan</option>
<option value="4">Chat</option>
<option value="5">Verwaltung</option>
<option value="6">Download</option>
<option value="7">Charts</option>
<option value="8">G&auml;stebuch</option>
<option value="9">Infozentrum</option>
<option value="10">Playlist</option>
<option value="11">Gru&szlig;box</option>
<option value="12">Statistiken</option>
<option value="13">Forum</option>
<option value="14">Homepage</option>
<option value="15">Bands</option>
<option value="16">Podcast</option>
<option value="17">Foto</option>
<option value="18">Bewerbung</option>
<option value="19">Urlaub</option>
<option value="0">---MOD---</option>
<option value="51">Portal</option>
<option value="52">News</option>
<option value="53">Sendeplan</option>
<option value="54">Chat</option>
<option value="55">Verwaltung</option>
<option value="56">Download</option>
<option value="57">Charts</option>
<option value="58">G&auml;stebuch</option>
<option value="59">Infozentrum</option>
<option value="510">Playlist</option>
<option value="511">Gru&szlig;box</option>
<option value="512">Statistiken</option>
<option value="513">Forum</option>
<option value="514">Homepage</option>
<option value="515">Bands</option>
<option value="516">Podcast</option>
<option value="517">Foto</option>
<option value="518">Bewerbung</option>
<option value="519">Urlaub</option>
<?php 
if (checkstatus("portal_level")==15)
{ echo '
<option value="0">---USER---</option>
<option value="101">Portal</option>
<option value="102">News</option>
<option value="103">Sendeplan</option>
<option value="104">Chat</option>
<option value="105">Verwaltung</option>
<option value="106">Download</option>
<option value="107">Charts</option>
<option value="108">G&auml;stebuch</option>
<option value="109">Infozentrum</option>
<option value="1010">Playlist</option>
<option value="1011">Gru&szlig;box</option>
<option value="1012">Statistiken</option>
<option value="1013">Forum</option>
<option value="1014">Homepage</option>
<option value="1015">Bands</option>
<option value="1016">Podcast</option>
<option value="1017">Foto</option>
<option value="1018">Bewerbung</option>
<option value="1019">Urlaub</option></select>';}?>
</td></tr>

<tr><td>Gruppe3 aussuchen:
<select name="group1">
<option value="0">Ausw&auml;hlen:</option>
<option value="0">---ADMIN---</option>
<option value="1">Portal</option>
<option value="2">News</option>
<option value="3">Sendeplan</option>
<option value="4">Chat</option>
<option value="5">Verwaltung</option>
<option value="6">Download</option>
<option value="7">Charts</option>
<option value="8">G&auml;stebuch</option>
<option value="9">Infozentrum</option>
<option value="10">Playlist</option>
<option value="11">Gru&szlig;box</option>
<option value="12">Statistiken</option>
<option value="13">Forum</option>
<option value="14">Homepage</option>
<option value="15">Bands</option>
<option value="16">Podcast</option>
<option value="17">Foto</option>
<option value="18">Bewerbung</option>
<option value="19">Urlaub</option>
<option value="0">---MOD---</option>
<option value="51">Portal</option>
<option value="52">News</option>
<option value="53">Sendeplan</option>
<option value="54">Chat</option>
<option value="55">Verwaltung</option>
<option value="56">Download</option>
<option value="57">Charts</option>
<option value="58">G&auml;stebuch</option>
<option value="59">Infozentrum</option>
<option value="510">Playlist</option>
<option value="511">Gru&szlig;box</option>
<option value="512">Statistiken</option>
<option value="513">Forum</option>
<option value="514">Homepage</option>
<option value="515">Bands</option>
<option value="516">Podcast</option>
<option value="517">Foto</option>
<option value="518">Bewerbung</option>
<option value="519">Urlaub</option>
<?php 
if (checkstatus("portal_level")==15)
{ echo '
<option value="0">---USER---</option>
<option value="101">Portal</option>
<option value="102">News</option>
<option value="103">Sendeplan</option>
<option value="104">Chat</option>
<option value="105">Verwaltung</option>
<option value="106">Download</option>
<option value="107">Charts</option>
<option value="108">G&auml;stebuch</option>
<option value="109">Infozentrum</option>
<option value="1010">Playlist</option>
<option value="1011">Gru&szlig;box</option>
<option value="1012">Statistiken</option>
<option value="1013">Forum</option>
<option value="1014">Homepage</option>
<option value="1015">Bands</option>
<option value="1016">Podcast</option>
<option value="1017">Foto</option>
<option value="1018">Bewerbung</option>
<option value="1019">Urlaub</option></select>';}?>
</td></tr>

<tr><td>Gruppe4 aussuchen:
<select name="group1">
<option value="0">Ausw&auml;hlen:</option>
<option value="0">---ADMIN---</option>
<option value="1">Portal</option>
<option value="2">News</option>
<option value="3">Sendeplan</option>
<option value="4">Chat</option>
<option value="5">Verwaltung</option>
<option value="6">Download</option>
<option value="7">Charts</option>
<option value="8">G&auml;stebuch</option>
<option value="9">Infozentrum</option>
<option value="10">Playlist</option>
<option value="11">Gru&szlig;box</option>
<option value="12">Statistiken</option>
<option value="13">Forum</option>
<option value="14">Homepage</option>
<option value="15">Bands</option>
<option value="16">Podcast</option>
<option value="17">Foto</option>
<option value="18">Bewerbung</option>
<option value="19">Urlaub</option>
<option value="0">---MOD---</option>
<option value="51">Portal</option>
<option value="52">News</option>
<option value="53">Sendeplan</option>
<option value="54">Chat</option>
<option value="55">Verwaltung</option>
<option value="56">Download</option>
<option value="57">Charts</option>
<option value="58">G&auml;stebuch</option>
<option value="59">Infozentrum</option>
<option value="510">Playlist</option>
<option value="511">Gru&szlig;box</option>
<option value="512">Statistiken</option>
<option value="513">Forum</option>
<option value="514">Homepage</option>
<option value="515">Bands</option>
<option value="516">Podcast</option>
<option value="517">Foto</option>
<option value="518">Bewerbung</option>
<option value="519">Urlaub</option>
<?php 
if (checkstatus("portal_level")==15)
{ echo '
<option value="0">---USER---</option>
<option value="101">Portal</option>
<option value="102">News</option>
<option value="103">Sendeplan</option>
<option value="104">Chat</option>
<option value="105">Verwaltung</option>
<option value="106">Download</option>
<option value="107">Charts</option>
<option value="108">G&auml;stebuch</option>
<option value="109">Infozentrum</option>
<option value="1010">Playlist</option>
<option value="1011">Gru&szlig;box</option>
<option value="1012">Statistiken</option>
<option value="1013">Forum</option>
<option value="1014">Homepage</option>
<option value="1015">Bands</option>
<option value="1016">Podcast</option>
<option value="1017">Foto</option>
<option value="1018">Bewerbung</option>
<option value="1019">Urlaub</option></select>';}?>
</td></tr>

<tr><td>Gruppe5 aussuchen:
<select name="group1">
<option value="0">Ausw&auml;hlen:</option>
<option value="0">---ADMIN---</option>
<option value="1">Portal</option>
<option value="2">News</option>
<option value="3">Sendeplan</option>
<option value="4">Chat</option>
<option value="5">Verwaltung</option>
<option value="6">Download</option>
<option value="7">Charts</option>
<option value="8">G&auml;stebuch</option>
<option value="9">Infozentrum</option>
<option value="10">Playlist</option>
<option value="11">Gru&szlig;box</option>
<option value="12">Statistiken</option>
<option value="13">Forum</option>
<option value="14">Homepage</option>
<option value="15">Bands</option>
<option value="16">Podcast</option>
<option value="17">Foto</option>
<option value="18">Bewerbung</option>
<option value="19">Urlaub</option>
<option value="0">---MOD---</option>
<option value="51">Portal</option>
<option value="52">News</option>
<option value="53">Sendeplan</option>
<option value="54">Chat</option>
<option value="55">Verwaltung</option>
<option value="56">Download</option>
<option value="57">Charts</option>
<option value="58">G&auml;stebuch</option>
<option value="59">Infozentrum</option>
<option value="510">Playlist</option>
<option value="511">Gru&szlig;box</option>
<option value="512">Statistiken</option>
<option value="513">Forum</option>
<option value="514">Homepage</option>
<option value="515">Bands</option>
<option value="516">Podcast</option>
<option value="517">Foto</option>
<option value="518">Bewerbung</option>
<option value="519">Urlaub</option>
<?php 
if (checkstatus("portal_level")==15)
{ echo '
<option value="0">---USER---</option>
<option value="101">Portal</option>
<option value="102">News</option>
<option value="103">Sendeplan</option>
<option value="104">Chat</option>
<option value="105">Verwaltung</option>
<option value="106">Download</option>
<option value="107">Charts</option>
<option value="108">G&auml;stebuch</option>
<option value="109">Infozentrum</option>
<option value="1010">Playlist</option>
<option value="1011">Gru&szlig;box</option>
<option value="1012">Statistiken</option>
<option value="1013">Forum</option>
<option value="1014">Homepage</option>
<option value="1015">Bands</option>
<option value="1016">Podcast</option>
<option value="1017">Foto</option>
<option value="1018">Bewerbung</option>
<option value="1019">Urlaub</option></select>';}?>
</td></tr>
<tr><td>Senden als:   <select name="send_as"><option value="user">User Einstellung</option><option value="im">Mitteilung</option><option value="email">E-Mail</option><option value="both"> IM + E-Mail</option></select></td></tr>

<?php userandpass(); ?></table>
<button type="submit">Senden</button> 

</form>
