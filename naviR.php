<!-- Navi Rechts --><br />
<ul style="list-style-type:disc;">
<?php
if ($_GET["x"]=="stream1")
{
echo '<li class="navi_rechts_aktiv">Stream 1';
}
else
{
echo '<li><a href="stream1.htm" class="stream1">Stream 1</a>'; }
?>

<br /><?php include("./onair/onair1.htm");?>
<br /><?php include("./onair/onair_text1.htm");?><br /><br /></li>



<?php
if ($_GET["x"]=="stream2")
{
echo '<li class="navi_rechts_aktiv">Stream 2';
}
else
{
echo '<li><a href="stream2.htm" class="stream2">Stream 2</a>'; }
?>

<br /><?php include("./onair/onair2.htm");?>
<br /><?php include("./onair/onair_text2.htm");?><br /><br /></li>

<!--
<?php
if ($_GET["x"]=="stream3")
{
echo '<li class="navi_rechts_aktiv">Stream 3';
}
else
{
echo '<li><a href="stream3.htm" class="stream3">Stream 3</a>'; }
?>

<br /><?php include("./onair/onair3.htm");?>
<br /><?php include("./onair/onair_text3.htm");?><br /><br /></li>

-->

<?php
if (isset($_SESSION["nick"]))
{

   if ($_GET["x"]=="edit")
   { echo '<li class="navi_rechts_aktiv">Profil &auml;ndern</li>'; }
   else
   { echo '<li><a href="edit.htm" class="navi_rechts">Profil &auml;ndern</a></li>';}
 


   if ($_GET["x"]=="show")
    { echo	'<li class="navi_rechts_aktiv">Mein Profil</li>'; }
   else
    { echo '<li><a href="show.htm" class="navi_rechts">Mein Profil</a></li>';}?>
 
 

  <?php

   if ($_GET["x"]=="mitteilungen")
    { echo	'<li class="navi_rechts_aktiv">Mitteilungen</li>'; }
   else
{
    $db=mysql_connect("localhost","portal","psacln");
    $sql1="SELECT count(*) AS anzahl FROM im WHERE anid='".$_SESSION["id"]."' AND status<'6'";
    $result1=mysql_db_query("portal",$sql1);
    $zeile1=mysql_fetch_array($result1);
    if ($zeile1["anzahl"]>'0')
    { echo '<li><a href="mitteilungen.htm" class="navi_rechts"><b>'.$zeile1["anzahl"].'</b> Mitteilungen</a></li>'; }
    else
    {
    echo '<li><a href="mitteilungen.htm" class="navi_rechts">Mitteilungen</a></li>';   
    }
}
   if ($_GET["x"]=="email")
    { echo	'<li class="navi_rechts_aktiv">Email verfassen</li>'; }
   else
    { echo '<li><a href="email.htm" class="navi_rechts">Email verfassen</a></li>';}
    
 
    

   if ($_GET["x"]=="foto")
    { echo	'<li class="navi_rechts_aktiv">Foto Men&uuml;</li>'; }
   else
    { echo '<li><a href="foto.htm" class="navi_rechts">Foto Men&uuml;</a></li>';}
 
   if ($_GET["x"]=="gbedit")
    { echo	'<li class="navi_rechts_aktiv">Eigenes G&auml;stebuch</li>'; }
   else
    { echo '<li><a href="gbedit.htm" class="navi_rechts">Eigenes G&auml;stebuch</a></li>';}
    
    
   if ($_GET["x"]=="search")
    { echo	'<li class="navi_rechts_aktiv">Benutzer suchen</li>'; }
   else
    { echo '<li><a href="suchen.htm" class="navi_rechts">Benutzer suchen</a></li>';}
    
   if ($_GET["x"]=="notiz")
    { echo	'<li class="navi_rechts_aktiv">Notizblock</li>'; }
   else
    { echo '<li><a href="notiz.htm" class="navi_rechts">Notizblock</a></li>';}
    
   if ($_GET["x"]=="block")
    { echo	'<li class="navi_rechts_aktiv">Blockliste</li>'; }
   else
    { echo '<li><a href="blockliste.htm" class="navi_rechts">Blockliste</a></li>';}        
    
 
}?>  
<?php if (function_exists("checkstatus"))
{
if (checkstatus("portal_level")>=10)
{
echo '
<li><a href="./admin/index.php" target="_blank" class="navi_rechts">Adminbereich</a></li>'; 
}
}?><?php
if (function_exists("checkstatus"))
{
if (checkstatus("portal_level")==5 || checkstatus("portal_level")>11)
{
echo '
<li><a href="./mod/index.php" target="_blank" class="navi_rechts">Modbereich</a></li>'; 
}
}?>



<?php if (isset($_SESSION["nick"]) && isset($_SESSION["id"]) && isset($_SESSION["pw"])) 
{echo '<li><a href="log-out.htm" class="navi_rechts">Ausgang</a></li>';}
else
{ echo '<li><form method="post" action="log-in.htm"><span>Benutzername </span><br /><input type="text" name="userinput" size="15" style="background-color:#eeeeee;color:Black0;border:1px solid #ff0000;" /><br /><span>Kennwort:</span><br /> <input type="password" name="passinput" size="15" maxsize="15" style="background-color:#eeeeee;color:Black;border:1px solid #ff0000;" /><br /><button type="submit">betreten</button></form></li>';
 if ($_GET["x"]=="register")
 { echo	'<li class="navi_links_aktiv">Registrieren</li>'; }
else
 { echo '<li><a href="registrieren.htm" class="navi_links">Registrieren</a></li>';}
if ($_GET["x"]=="akti")
 { echo	'<li class="navi_links_aktiv">Aktivieren</li>'; }
else
 { echo '<li><a href="aktivieren.htm" class="navi_links">Aktivieren</a></li>';}
if ($_GET["x"]=="password")
 { echo	'<li class="navi_links_aktiv">Passwort weg?</li>';}
else
 { echo '<li><a href="passwort.htm" class="navi_links">Passwort weg?</a></li>';}


}?>
</ul>

<!-- Navi Ende Rechts -->