<?php

//Akti = Aktivierungscode

//To-Do: Umlaute und B&ouml;se zeichen Escapen

function generate_key()
{
    $pool = "qwertzupasdfghkyxcvbnm";
    $pool .= "23456789";
    $pool .= "WERTZUPLKJHGFDSAYXCVBNM";
    srand ((double)microtime()*1000000);
    for($index = 0; $index < 10; $index++)
    {
    $akti .= substr($pool,(rand()%(strlen ($pool))), 1);
    }
    return $akti;
}
    


function do_register()
{

//Pr&uuml;fe ob das Formular verschickt wurde oder ob es das erste betreten wurde.
if ($_POST["do"]=="register")
{ $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");

  //Am Anfang keine Fehler ;-)
	$error="";
	
		//Pr&uuml;fe ob AGB akzeptiert wurden [AGB]
	if($_POST["acc_agb"]=="0")
	{ $error.="Sie m&uuml;ssen mit unseren Nutzungsbedingungen einverstanden sein, um alle Funktionen dieser Webpr&auml;senz nutzen zu k&ouml;nnen.<br />"; }
	
	//Pr&uuml;fe leeres Felder [NICK]
	if(empty($_POST["nick"]))
	{ $error.=" Bitte geben Sie einen Nicknamen ein.<br />"; }
	
	//Pr&uuml;fe leeres Felder [PW]
	if(empty($_POST["pw"]))
	{ $error.="Bitte geben Sie ein Passwort ein.<br />"; }
	
	//Pr&uuml;fe leeres Felder [PW2]
	if(empty($_POST["pw2"]))
	{ $error.="Bitte geben Sie Ihr Password doppelt ein, um Fehleingaben zu verhindern.<br />"; }
	
	//Pr&uuml;fe leeres Felder [E-Mail]
	if(empty($_POST["email"]))
	{ $error.=" Bitte geben Sie eine g&uuml;tige E-Mail-Adresse ein.<br />"; }		

	//Pr&uuml;fe gleichheit der Felder PW und PW2
	if($_POST["pw"]!=$_POST["pw2"])
	{ $error.="Die eingegebenen Passw&ouml;rter m&uuml;ssen &uuml;bereinstimmen.<br />"; }		
		
	

  //Pr&uuml;fe, ob Nickname schon vergeben ist (Global)
  $sql="SELECT COUNT(*) AS result FROM user WHERE nick='".filter($_POST["nick"])."'";
  $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
  $result = mysql_db_query("portal", $sql);
  $zeile = mysql_fetch_array($result);
  if ($zeile["result"] > "0")
	{ $error.=" Dieser Nickname ist bereits registriert.<br />"; }
	
  //Pr&uuml;fe, ob Nickname schon vergeben (zum aktivieren)
  $sql="SELECT COUNT(*) AS result FROM akti WHERE nick='".filter($_POST["nick"])."'";
  $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
  $result = mysql_db_query("portal", $sql);
  $zeile = mysql_fetch_array($result);
  if ($zeile["result"] > "0")
	{ $error.="Dieser Nickname muss noch aktiviert werden. Den Aktivierungscode haben Sie per E-Mail bekommen.<br />"; }		  
	
	//Pr&uuml;fe, ob E-Mail Adresse schon vergeben ist (Global)
  $sql="SELECT COUNT(*) AS result FROM user WHERE email='".filter($_POST["email"])."'";
  $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
  $result = mysql_db_query("portal", $sql);
  $zeile = mysql_fetch_array($result);
  if ($zeile["result"] > "0")
	{ $error.="Diese E-Mail-Adresse ist bereits registriert.<br />"; }		
	
	//Pr&uuml;fe, ob E-Mail Adresse schon vergeben ist (zum Aktivieren)
  $sql="SELECT COUNT(*) AS result FROM akti WHERE email='".filter($_POST["email"])."'";
  $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
  $result = mysql_db_query("portal", $sql);
  $zeile = mysql_fetch_array($result);
  if ($zeile["result"] > "0")
	{ $error.="An diese E-Mail-Adresse wurde bereits ein Aktivierungscode geschickt.<br />"; }		
	    

    $ok=0;
      $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
   // while($ok=0)
      //   { 
	         $akti="";   
	       $akti=generate_key();
	       //Pr&uuml;fe, ob Schl&uuml;ssel schon in der Datenbank vorhanden ist (Unwahrscheinlich, aber wir wollen ja viele User haben *g*)
         $sql="SELECT COUNT(*) AS result FROM akti WHERE akti='".$akti."'";
         $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
         $result = mysql_db_query("portal", $sql);
         $zeile = mysql_fetch_array($result);
         if ($zeile["result"] >= "1")
  	          { $akti=generate_key(); }	
      // }
        
   	//Pr&uuml;fe, ob PW im Woerterbuch vorhanden ist.
  $sql="SELECT lang FROM book WHERE word LIKE '%".filter($_POST["pw"])."%'";
  $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
  $result = mysql_db_query("portal", $sql);
  
  if (mysql_num_rows($result)!=0)
	{   $zeile = mysql_fetch_array($result);
		$error.= "Dieses PW wurde von uns als unsicher gewertet. Es ist bei uns in dem W&ouml;rterbuch:<b>".$zeile["lang"]."</b> vorhanden. Bitte &auml;ndern die es nach dem vollst&auml;ndigen registrieren."; }	
   

      
      
      
  //Pr&uuml;fe ob es Fehler gab, falls ja gebe die Meldungen aus und &uuml;berspringe den SQL Teil.
  	
    $nick = filter($_POST["nick"]);
    $pw = md5($_POST["pw"]);
    
    //Datum wird ben&ouml;tigt um Veraltete Eintr&auml;ge Aktivierungen zu l&ouml;schen
    $datum = date("y-m-d");
    $sql = "INSERT INTO akti (datum, nick, pw, email, akti, sex)
    VALUES ('".$datum."', 
    '".filter($_POST["nick"])."',
    '".$pw."',
    '".filter($_POST["email"])."',
    '".$akti."' ,";
    //Pruefe Geschlecht
   
   if (filter($_POST["sex"])=="m")
   { $sql.="'m')"; }
   elseif (filter($_POST["sex"])=="w")
   { $sql.="'w')"; }
   else
   { $error.="Dein Geschlecht konnte nicht &Uuml;bertragen werden.<br />"; }      
    
    
   if ($error=="")
   {   
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");   
    $result = mysql_db_query("portal", $sql);
        if ($result=="1")
        {
	    echo 'Ihnen wurde soeben eine Aktiverungs E-mail geschickt. Pr&uuml;fen Sie bitte ihre SPAM verzeichnisse, falls sie innerhalb von 60 Minuten keine Mail bekommen solten.';
        
        $betreff = "Registrierung bei discollection-radio";
        $text = "Hallo!
        Sie haben sich  soeben bei Discollection-radio Registriert. Um ihre Registrierung abzuschlie&szlig;en, klicken Sie im Men&uuml;punkt LOG-IN auf AKTIVIEREN
        und Kopiere Folgenden Aktivierungscode in das dort vorhandene Feld:
        
        ".$akti."
        
        Alternativ kannst du einfach foldenen Link in deinen Browser kopieren:
        www.discollection-radio.eu/aktivieren.htm?code=".$akti." 
        
        Nicht aktivierte Nicks werden innerhalb einer Woche gel&ouml;scht.";
        
        
  @mail(filter($_POST["email"]), $betreff, $text,
       "From: Ein \"Hallo\" aus dem Netz <system@discollection-radio.eu>");
        
        }
        else
        { echo "Fehler.";
         }
        
        
        
        
    }
    else
    { echo '<b>' . $error . '</b>'; }
}
}
 ?>



