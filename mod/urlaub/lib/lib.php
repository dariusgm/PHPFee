<?php
$db=mysql_connect("localhost","portal","psacln");


function show_urlaub()
{
echo '
Solltest du Urlaub brauchen, kannst du hier einen Urlaubsantrag einreichen. Wir würden uns freuen wenn du einen Grund angeben würdest, dis ist jedoch nicht pflicht.
<br /><br />
<form method="post" action="index.php">
<table><tr><td>Anfang:</td><td><select name="tag_anfang" size="1">
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
</select></td><td><select name="monat_anfang" size="01">
                        <option value="01">Januar</option>
                        <option value="02">Februar</option>
                        <option value="03">März</option>
                        <option value="04">April</option>
                        <option value="05">Mai</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Dezember</option>
</select></td><td><select name="jahr_anfang" size="01">
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
</select>
</td></tr>
<tr><td>Bis: </td><td><select name="tag_ende" size="01">
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
</select></td><td><select name="monat_ende" size="01">
                        <option value="01">Januar</option>
                        <option value="02">Februar</option>
                        <option value="03">März</option>
                        <option value="04">April</option>
                        <option value="05">Mai</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Dezember</option>
</select></td><td><select name="jahr_ende" size="01">
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
</select></td></tr>
<tr><td>Grund:</td><td colspan="3"><input type="text" name="grund" /></td></tr>
<tr><td colspan="2"><button type="submit">Absenden</button><input type="hidden" name="do" value="send"></td></tr></form>';



}


function send_urlaub()
{
	
	
		   if (isset($_SESSION["nick"]))
  { $nickname = $_SESSION["nick"]; }
  
  elseif (isset($_POST["userinput"]))
  { $nickname = $_POST["userinput"]; }
  
    // Sende IM an alle urlaubsleute
	$sql1="SELECT id FROM user WHERE urlaub_level>9";
	$result1=mysql_db_query("portal",$sql1);
	while($zeile1=mysql_fetch_array($result1))
	{
		send_im($_SESSION["id"],$zeile1["id"]);
		
    }
    // Sende IM an verfasser
    $sql2="SELECT id FROM user WHERE nick='".$nickname."'";
    $result2=mysql_db_query("portal",$sql2);
    $zeile2=mysql_fetch_array($result2);
    send_im(0,$nickname);
    
    
	echo '<u><b>Deine Urlaubsantrag wurde &Uuml;bermittelt und wird binnen 48h von uns bearbeitet.</b></u><br /><br />';
   
	
}



function send_im($von,$an)
{
	   if (isset($_SESSION["nick"]))
  { $nickname = $_SESSION["nick"]; }
  
  elseif (isset($_POST["userinput"]))
  { $nickname = $_POST["userinput"]; }
	
	
	 $text="Du hast soeben einen Urlaubsantrag von ".$nickname." erhalten.
	 Urlaubsbeginn: ".filter($_POST["tag_anfang"]).".".filter($_POST["monat_anfang"]).".".filter($_POST["jahr_anfang"])."
	 Urlaubsende:	".filter($_POST["tag_ende"]).".".filter($_POST["monat_ende"]).".".filter($_POST["jahr_ende"])."
	 Grund:  	    ".filter($_POST["grund"])."";
	 
	 $sql2="INSERT INTO im (vonid,anid,datum,uhrzeit,betreff,text) VALUES (
	 '".$von."',
	 '".$an."',
	 '".date("Y-m-d")."',
	 '".date("H:i")."',
	 'Urlaubsantrag',
	 '".$text."')";
  	 
	 $result=mysql_db_query("portal",$sql2);	
	
	
}
