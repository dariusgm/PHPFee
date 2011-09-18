<?php


function kalenderwoche($datum)
{
return date("W",$datum);	
}


function wochentag($datum)
{
$tag = date("w",mktime(0,0,0,date(m),(date(d)+$datum),date(Y)));
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
return;
}
function datumsql($datum)
{
return date("Y-m-d",mktime(0,0,0,date(m),(date(d)+$datum),date(Y)));	
}

function datum($datum)
{
return date("Ymd",mktime(0,0,0,date(m),(date(d)+$datum),date(Y)));	
}

function show($datum)
{
 $sql="SELECT * FROM sendeplan WHERE datum='".datumsql(filter($datum))."' ORDER BY bis ASC";
 $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
 $result =mysql_db_query("portal",$sql);

 if (mysql_affected_rows()=="0")
  {echo ("Im Sendeplan wurde kein Eintrag gefunden,.<br />"); 
  }
  echo '<form method="post" action="index.php?x=edit"><input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />';
  echo '<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
  echo '<input type="hidden" name="datum" value="'.datumsql($datum).'" />';
  
  while ($zeile=mysql_fetch_array($result))
  { 

  echo '<table summary="" frame="void" cellspacing="0" cellpadding="0"><tr><td class="justwhite">';
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
echo '</td><td class="justwhite">&nbsp;-&nbsp;</td><td class="justwhite">'.$zeile["titel"].'&nbsp;-> mit ';

 	  $sql2="SELECT nick FROM user WHERE id='".$zeile["userid"]."'";
	  $result2=mysql_db_query("portal",$sql2);
	  $zeile2=mysql_fetch_array($result2);
 echo $zeile2["nick"];
 
 echo '</td></tr></table>';

}
echo '<button type="submit">Editieren</button></form>';
}

function do_update()
{
	if (isset($_POST["datum"]) && isset($_POST["von"]) && isset($_POST["bis"]) && isset($_POST["titel"]) && $_POST["do"] == "edit" && isset($_POST["userid"]))
{
	echo filter($_POST["datum"]);
$sql = "UPDATE sendeplan SET datum='".filter($_POST["datum"])."',
von=".filter($_POST["von"]).",
bis=".filter($_POST["bis"]).",
titel='".filter($_POST["titel"])."',
userid='".filter($_POST["userid"])."', 
stream='".filter($_POST["stream"])."' 
WHERE id=".filter($_POST["id"])."";
echo $sql;

$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$query_heute = mysql_db_query("portal", $sql);
write_admin_log($sql,"sendeplan","edit");
if ($query_heute=="1") 
{echo "<b>Eintrag aktualisiert.</b><br />"; }}
}

function show_update()
{
	//Pr&uuml;ft ob ein Datum &uuml;bergeben wurde, sonst heutiges Datum.
if (isset($_POST["datum"]))
{
$heute = $_POST["datum"];
}
else
{
$heute=date("Y-m-d");
}

$sql_select_heute = "SELECT * FROM sendeplan WHERE datum='". $heute . "' ORDER BY bis ASC";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$query_heute = mysql_db_query("portal", $sql_select_heute);
if (mysql_affected_rows()=="0")
{ echo 'Es wurde kein Sendeplan f&uuml;r diesen Tag gefunden. Zum bearbeiten eines anderen Tages bitte das Datum eingeben nach ISO Norm = YYYY-MM-TT<br />
<form method="post" action="index.php?x=edit"><button type="submit">Bearbeiten</button>
<input type="text" name="datum" value="'.$heute.'" />
<input type="hidden" name="userinput" value="' .$_POST["userinput"].'"  />
<input type="hidden" name="passinput" value="' .$_POST["passinput"].'" /></form>
'; }

// Generiere Mod Drop-Down
    $sql1="SELECT id,nick FROM user WHERE portal_level<10 AND portal_level>4 ORDER BY 'nick'";
    $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
    $result1=mysql_db_query("portal",$sql1);
        
   $drop="";
    while($zeile1=mysql_fetch_array($result1))
    {
	    $drop.='<option value="'.$zeile1["id"].'">'.$zeile1["nick"].'</option>';
    } 
   
    
    $sql1="SELECT id,nick FROM user WHERE portal_level>10 ORDER BY 'nick'";
    $result1=mysql_db_query("portal",$sql1);
    
    // Generiere Admin Drop-Down
    $drop.='<option value="0">----Admins----</option>';
   
    while($zeile1=mysql_fetch_array($result1))
    {
	    $drop.='<option value="'.$zeile1["id"].'">'.$zeile1["nick"].'</option>';
    } 
// Drop Ende


     while($zeile = mysql_fetch_array($query_heute))
   {
	   
	   
	  $sql2="SELECT nick FROM user WHERE id='".$zeile["userid"]."'";
	  $result2=mysql_db_query("portal",$sql2);
	  $zeile2=mysql_fetch_array($result2); 
	   
    echo '
    <table border="1"><tr><td><form method="post" action="index.php?x=edit">
    <input type="hidden" name="userinput" value="' .$_POST["userinput"].'"  />
    <input type="hidden" name="passinput" value="' .$_POST["passinput"].'" />
    <input type="hidden" name="del" value="'.$zeile["id"].'" /><button type="submit">Löschen</button>
    </form>
    </td>
    <td><form method="post" action="index.php?x=edit">';
    //kalenderwoche($heute);
    //echo ": ";
    wochentag($heute);
    echo'</td>
    <td><input type="text" name="datum" value="'.$heute.'" size="8" maxlengh="8" /></td>
    <td><input type="text" name="von" value="'.$zeile["von"].'" size="4" maxlengh="4" /></td>
    <td><input type="text" name="bis" value="'.$zeile["bis"].'" size="4" maxlengh="4" /></td>
    <td><input type="text" name="titel" value="'.$zeile["titel"].'" size="20" maxlengh="20" /></td>
    <td><select name="stream">';
    if ($zeile["stream"]==1)
    { echo '<option value="1">Stream 1</option><option value="2">Stream 2</option><option value="3">Stream 3</option>'; }

    elseif ($zeile["stream"]==2)
    { echo '<option value="2">Stream 2</option><option value="3">Stream 3</option><option value="1">Stream 1</option>'; }
    
    else
    { echo '<option value="3">Stream 3</option><option value="1">Stream 1</option><option value="2">Stream 2</option>'; }

        
    echo '</select><td><select name="userid"><option value="'.$zeile["userid"].'">---'.$zeile2["nick"].'</option>'.$drop.'</select></td>
    <input type="hidden" value="' .$_POST["userinput"].'" name="userinput" size="4" maxlengh="4"  />
    <input type="hidden" value="' .$_POST["passinput"].'" name="passinput" size="4" maxlengh="4" />
    <input type="hidden" value="'.$heute.'" name="datum" />
    <input type="hidden" value="'.$zeile["id"].'" name="id" />
    <input type="hidden" value="edit" name="do" />
    <td><button type="submit">Speichern</button></td></form>
    </tr></table><hr />';

	  }
}

function insert()
{
	$i=0;
     while ($i < 15) 
     {
     //POST Auswerten. Sie m&uuml;ssen umkopiert werden da sonst Parse-Fehler entstehen
     $datum = filter($_POST["datum".$i]);
     $von = filter($_POST["von".$i]);
     $bis = filter($_POST["bis".$i]);
     $titel = filter($_POST["titel".$i]);
     $name = filter($_POST["name".$i]);
     $userid=filter($_POST["userid".$i]);
     $stream=filter($_POST["stream".$i]);

     



          if (!empty($datum) && !empty($titel) && $_POST["do"]=="expand")
          {
          // Pruefe ob Zeit bereits besetzt
          $sql1="SELECT id FROM sendeplan WHERE datum='".$datum."' AND von='".$von."' AND bis='".$bis."' AND stream='".$stream."'";
          $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
          $result1=mysql_db_query("portal",$sql1);
               if (mysql_num_rows($result1)>0)
               { echo '<br /><b>Dieser Eintrag wurde ignoriert, er ist bereits vergeben '.$datum.' von: '.$von.' bis: '.$bis.'</b>'; }	
               else
               {	
	               
	           $sql="INSERT INTO sendeplan (datum,von,bis,titel,userid,stream) VALUES ('".$datum."',
               '".$von."',
               '".$bis."',
               '".$titel."',
               '".$userid."',
               '".$stream."'
               )";
            
               write_admin_log($sql,"sendeplan","insert");
               $query = mysql_db_query("portal", $sql);


                    if ($query=="1") 
                    {$x++; } 
               }
            }
         
     $i++; 
          
     }
if ($x>0)
{
echo $x." Einr&auml;ge gespeichert";}	
}





function show_expand()
{
    insert();
    
    
    $sql1="SELECT id,nick FROM user WHERE portal_level<10 AND portal_level>4 ORDER BY 'nick'";
    $result1=mysql_db_query("portal",$sql1);
    
    // Generiere Mod Drop-Down
    
   $drop="";
    while($zeile1=mysql_fetch_array($result1))
    {
	    $drop.='<option value="'.$zeile1["id"].'">'.$zeile1["nick"].'</option>';
    } 
   
    
    $sql2="SELECT id,nick FROM user WHERE portal_level>10 ORDER BY 'nick'";
    $result2=mysql_db_query("portal",$sql2);
    
    // Generiere Admin Drop-Down
    $drop.='<option value="0">----Admins----</option>';
   
    while($zeile2=mysql_fetch_array($result2))
    {
	    $drop.='<option value="'.$zeile2["id"].'">'.$zeile2["nick"].'</option>';
    } 
       
   $datumdrop="";
   $i=0;
   while($i<14)
   {
	   $datum=date("Y-m-d",mktime(1,1,1,date(m),(date(d)+$i),date(Y)));
	   
	   $datumdrop.='<option value="'.$datum.'">'.$datum.'</option>';
   $i++;
   }
    
    

    
    
    
    $i=0;
    $durchlauf=10; //Anzahl der Durchl&auml;ufe Festlegen
    //Liste zum Hinzuf&uuml;gen Anzeigen
    echo '<form method="post" action="index.php?x=expand">';
    while ($i < $durchlauf) 
    {
	  echo '
    <table border="1">
    <input type="hidden" value="' .$_POST["userinput"].'" name="userinput" size="4" maxlengh="4"  />
    <input type="hidden" value="' .$_POST["passinput"].'" name="passinput" size="4" maxlengh="4" />
    <tr><td><select name="datum'.$i.'">'.$datumdrop.'</select></td>
    <td><input type="text" name="von'.$i.'" value="" size="4" maxlengh="4" /></td>
    <td><input type="text" name="bis'.$i.'" value="" size="4" maxlengh="4" /></td>
    <td><input type="text" name="titel'.$i.'" value="" size="30" maxlengh="30" /></td>
    <td><select name="stream'.$i.'"><option value="1">Stream 1</option><option value="2">Stream 2</option><option value="3">Stream 3</option></select>
    <td><select name="userid'.$i.'">'.$drop.'</select></td></tr></table>'; 
    $i++;
    }
    echo '<input type="hidden" value="expand" name="do" /><button type="submit">Hinzuf&uuml;gen</button></form>'; 

}
    
function do_del()
{
	if (isset($_POST["del"]))
	{
	$sql1="DELETE FROM sendeplan WHERE id='".filter($_POST["del"])."'";
	$result1=mysql_db_query("portal",$sql1);
	echo 'Eintrag gelöscht.<br />';
    }
}
    
    ?>