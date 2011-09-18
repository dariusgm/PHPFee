<?php
//Zufaellige Zahl generieren, und runden, so das 0 oder 1 zurueckgegeben wird
function i() { return round(mt_rand(0,1)); }

// Rechenaufgabe Generieren
function gen_aufgabe()
{	$z10=i();
	$z11=i();
	$z12=i();	
	$z13=i();
	$z14=i();	
	$z15=i();
	$z16=i();	
	$z17=i();
	$z18=i();	
	$z19=i();

	$z20=i();
	$z21=i();
	$z22=i();	
	$z23=i();
	$z24=i();	
	$z25=i();
	$z26=i();	
	$z27=i();
	$z28=i();	
	$z29=i();	
	
	$sum1=$z10+$z11+$z12+$z13+$z14+$z15+$z16+$z17+$z18+$z19;
	$sum2=$z20+$z21+$z22+$z23+$z24+$z25+$z26+$z27+$z28+$z29;
	
	if ($sum1>=$sum2)
	{
	return '<input type="hidden" name="php_fee" value="'.md5($sum1-$sum2).'" />Was ist '.$sum1.' - '.$sum2. '? <input type="text" size="2" name="php_fee2" value="10" />';
	}
	else
	{
	return '<input type="hidden" name="php_fee" value="'.md5($sum2-$sum1).'" />Was ist '.$sum2.' - '.$sum1. '? <input type="text" size="2" name="php_fee2" value="10" />';
		
	}
	
	
		
	
	}
	
	
// a= PageID
function check_aufgabe($a) {
if (isset($_POST["php_fee"]) && isset($_POST["php_fee2"]))
{


	if($_POST["php_fee"] == md5($_POST["php_fee2"]))
	{ 
		$sql1="SELECT ip,time,info FROM anti_spam WHERE ip='".$_SERVER["REMOTE_ADDR"]."'";
		if($a==1) { $sql1.= " OR info='".filter($_POST["email"])."'"; }
		
		$db=mysql_connect("localhost","portal","psacln");
		$result1=mysql_db_query("portal",$sql1);
		$zeile1=mysql_fetch_array($result1);
		if (mysql_num_rows($result1)==0)
		{
		$sql2="INSERT INTO anti_spam (ip,pageid,time,info) VALUES (
		'".$_SERVER["REMOTE_ADDR"]."',
		'".$a."',
		'".time()."'";
		
		if($a==1) { $sql2.= ",'".filter($_POST["email"])."')"; }
		
		
		
		$db=mysql_connect("localhost","portal","psacln");
		$result2=mysql_db_query("portal",$sql2);
		return true;
		
				
	    }
		else
		{
			if (($a==1) && ($zeile1["info"]==filter($_POST["email"]))) { echo 'An die von dir angegebene E-Mail Adresse wurde bereits eine Empfehlunf geschickt. Bitte sage deinem Freund noch einmal pers&ouml;nlich das bei die Post abgeht.<br />';return false; }	
			
			if ($zeile1["ip"]==$_SERVER["REMOTE_ADDR"] && $zeile1["time"]<(time()-86400)) {echo 'Von dieser IP wurde heute bereits eine Anfrage gesendet. Der Vorgang wurde abgebrochen.<br />'; return false;}
			

			
			} 
		
		
		
		}
	else
	{echo 'Die Aufgabe wurde falsch ausgerechnet.';return false; }
}
	
}
?>