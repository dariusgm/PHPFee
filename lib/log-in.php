<?php
function logout(){
if ($_GET["x"] == "log-out")
{      $_SESSION=array();
  session_destroy();
  echo '<h2>Ausgang</h2>
  Du hast Dich soeben erfolgreich von unserem System abgemeldet. Wir freuen uns schon jetzt auf Deinen n&auml;chsten Besuch.<br />
Weiterhin w&uuml;nschen wir Dir viel Spa&szlig; bei Deinen Streifz&uuml;gen durch das Internet. Falls Du nicht wei&szlig;t, wo Du als n&auml;chstes st&ouml;bern kannst, empfehlen wir Dir unsere Partner.
';
}
}

function do_log_in()
{
if (isset($_POST["userinput"]) && (isset($_POST["passinput"])))
{
   $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
   $pw = md5($_POST["pw"]);
   $query = "SELECT id,nick,pw FROM user WHERE nick='".filter($_POST['userinput'])."'";
   $send_query = mysql_db_query("portal", $query);
   if (mysql_num_rows($send_query)!=1)
   {
	  echo "<h3>Der Nickname wurde nicht gefunden.</h3>"; 
	 }
   else
   {
   $row = mysql_fetch_array($send_query);
   $pwinput = md5($_POST["passinput"]);
      if ($row["pw"]!=$pwinput)
      {
	    echo '<h3>Falsches Passwort</h3> Das von dir eingegebene Passwort stimmt nicht mit dem von dir eingegebenen Benutzernamen &uuml;berein.';
      }
      else
      {
	  
	  // Aktualisiere Profil
      $sql="UPDATE user SET logins=logins+1, last_login_date='".date("Y-m-d")."', last_login_time='".date("H:i:s")."' WHERE id='".$row["id"]."'";
      
      // Fuege zur Liste der Letzten Verbindungen hinzu
      $sql0="INSERT INTO connection_log (zeit,userid,ip,host,proxy) VALUES (
      '".time()."',
      '".$row["id"]."',
      '".$_SERVER["REMOTE_ADDR"]."',
      '".gethostbyaddr($_SERVER["REMOTE_ADDR"])."',
      '".$_SERVER["HTTP_X_FORWARDED_FOR"]."')";
      
      $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
      $result = mysql_db_query("portal", $sql);
      $result0= mysql_db_query("portal",$sql0);     	      
      $_SESSION["id"] =$row["id"];
      $_SESSION["nick"] =$row["nick"];
      $_SESSION["pw"] =$row["pw"];
      $_SESSION["chatpw"] = $_POST["passinput"];
      show_my_stats();
      }
 }
}
}


function show_my_stats()
{
	$db=mysql_connect("localhost","portal","psacln");
	echo '<h3>Hallo '. $_SESSION["nick"] . '</h3><br />du hast ';
	
	  
	
	$sql1="SELECT count(*) AS anzahl FROM im WHERE anid='".$_SESSION["id"]."' AND status<'6'";
    $result1=mysql_db_query("portal",$sql1);
    $zeile1=mysql_fetch_array($result1);
    if ($zeile1["anzahl"]>'0')
    { echo '<a href="mitteilungen.htm"><b>'.$zeile1["anzahl"].'</b>'; }
    else
    {
    echo '<a href="mitteilungen.htm">keine ';  
    }

echo 'ungelesene Nachrichten</a> und warst zuletzt ';



$sql2="SELECT * FROM `connection_log` WHERE userid=".filter($_SESSION["id"])." ORDER BY `zeit` DESC  LIMIT 1";

$result2=mysql_db_query("portal",$sql2);

   if (mysql_num_rows($result2))
    {   $zeile2=mysql_fetch_array($result2);
	echo 'am '.date("m.d.Y",$zeile2["zeit"]).' um '.date("H:i:s",$zeile2["zeit"]).' mit der IP: '.$zeile2["ip"].' ('.$zeile2["host"].' ) online ,sollten dich die angaben sehr verwundern, werde dich bitte an unsere Administratoren.'; }
    else
    {
    echo '<a href="mitteilungen.htm">keine ';  
    }
echo 'Auf der Rechten Seite stehen dir nun weitere M&ouml;glichkeiten zur verf&uuml;gung.';
echo '<ul><li><h4>Profil &auml;ndern</h4> Hier kannst du dein Profil individuell einstellen.</li><li><h4>Mein Profil</h4>Ein klick auf diesen Link und du siehst dein Profil, wie es auch von allen anderen Besuchern von Discollection-Radio angezeigt wird.</li><li><h4>Mitteilungen</h4>Hier kommen Mitteillungen an und au&szlig;erdem kannst du hier auch welche an dere Benutzer verschicken.</li><li><h4>Foto Men&uuml;</h4> lade hier von dir Bilder hoch, damit die anderen auch sehen k&ouml;nnen, mit wem sie schreiben.</li><li><h4>Eigenes G&auml;stebuch</h4> Hier stehen dir Einstellungsm&ouml;glichkeiten f&uuml;r dein G&auml;stebuch zur Verf&uuml;gung.</li><li><h4>Benutzer suchen</h4> Erlaubt dir das Suchen von anderen Mitgliedern</li><li><h4>Notizblock</h4>Hier kannst du dir beliebigen Text notieren. Er wird nicht &ouml;ffentlich angezeigt.</li><li><h4>Blockliste</h4>St&ouml;rende Benutzer kannst du hier auf eine Blockliste setzen. Du bekommst dann keine weiteren Mitteilungen und G&auml;stebuch eintr&auml;ge von ihnen.</li><li><h4>Ausgang</h4>Hier kannst du den registrieren Bereich verlassen.</li></ul>';
}

?>
