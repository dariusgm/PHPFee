<?php
function datumchecken($datum)
{if (checkdate($datum)=="0")
 {
 echo ("Das Datum ist illegal. Es wird abgebrochen");
 exit ();
 }
}

function wochentag($datum)
{
$tag = date("w",mktime(1,1,1,date(m),(date(d)+$datum),date(Y)));
switch($tag)
 {
	 case 0:
	 echo "Sonntag";
	 break;
	 case 1:
	 echo "Montag";
	 break;	 
	 case 2:
	 echo "Dienstag";
	 break;
	 case 3:
	 echo "Mittwoch";
	 break;	 
	 case 4:
	 echo "Donnerstag";
	 break;
	 case 5:
	 echo "Freitag";
	 break;	 
	 case 6:
	 echo "Samstag";
	 break;
}
}
function datumsql($datum)
{
return date("Y-m-d",mktime(1,1,1,date(m),(date(d)+$datum),date(Y)));	
}

function datum($datum)
{
return date("d.m.Y",mktime(1,1,1,date(m),(date(d)+$datum),date(Y)));	
}

function show($datum)
{
 $sql="SELECT * FROM sendeplan WHERE datum='".datumsql($datum)."' ORDER BY bis ASC";
 $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
 $result =mysql_db_query("portal",$sql);
 if (mysql_affected_rows()=="0")
  {echo ('Der Sendeplan wird noch bearbeitet'); 
  }

  while ($zeile=mysql_fetch_array($result))
  { 
  echo '<table summary="" frame="void" cellspacing="0" cellpadding="0"><tr><td>';
  #if ($zeile["stream"]==1) {echo '&nbsp;';}
  if ($zeile["stream"]==2) {echo '&nbsp;&nbsp;&nbsp;';}
  if ($zeile["stream"]==3) {echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}  
  
  echo 'Stream <b>'.$zeile["stream"].'</b>&nbsp&nbsp</td><td>';
  
  
  
  
  /////VON////
  if(strlen($zeile["von"])==3)
  { // Wenn Stunden Weniger 10, dann f&uuml;hrende 0 Anzeigen
	 echo '0'.(substr($zeile["von"],0,1)); 
  }
   elseif(strlen($zeile["von"])=="4")
  {
	 echo (substr($zeile["von"],0,2)); 
	}
   // 0:00 Uhr = 0 In der Datenbank
   else 
  { 
	 echo "00"; 
	}

  //Ausgabe Minuten
  echo ':';
  
  if ((substr($zeile["von"],-2,2))=="0")
  {echo "00";}
  else
  { echo (substr($zeile["von"],-2,2)); }
  /////VON ENDE//////

  echo '&nbsp;-&nbsp;';

  /////BIS////
  if(strlen($zeile["bis"])=="3")
  { // Wenn Stunden Weniger 10, dann f&uuml;hrende 0 Anzeigen
	 echo '0'.(substr($zeile["bis"],0,1)); 
  }
  elseif(strlen($zeile["bis"])=="4")

 {echo (substr($zeile["bis"],0,2)); 
 }
// 0:00 Uhr = 0 In der Datenbank
 else 
 { echo "0"; 
 }

//Ausgabe Minuten
echo ':'.(substr($zeile["bis"],-2,2));
/////BIS ENDE//////

//hole Name
$sql2="SELECT nick FROM user WHERE id='".$zeile["userid"]."'";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result2=mysql_db_query("portal",$sql2);
$zeile2=mysql_fetch_array($result2);
echo '</td><td>&nbsp;-&nbsp;</td><td class="justwhite">'.get_utf($zeile["titel"]).'&nbsp;-> mit '.get_utf($zeile2["nick"]).'</td></tr></table>';

}

}