<?php
function get_pod_escape($text)
{

	
	
	
$suchmuster[0] = '.&.';
$suchmuster[1] = '.<.';
$suchmuster[2] = '.>.';
$suchmuster[3] = '.\'.';
$suchmuster[4] = '.".';


$ersetzungen[0] = '&amp;';
$ersetzungen[1] = '&lt;';
$ersetzungen[2] = '&gt;';
$ersetzungen[3] = '&apos;';
$ersetzungen[4] = '&quot;';


return preg_replace($suchmuster, $ersetzungen, $text);
		
}


function get_my_id()
{
	$sql1="SELECT id FROM user WHERE nick='".filter($_POST["userinput"])."' AND pw='".filter($_POST["passinput"])."'";
    $db=mysql_connect("localhost","portal","psacln");   
	$result1=mysql_db_query("portal",$sql1);	
    $zeile1=mysql_fetch_array($result1);
    return $zeile1["id"];
}




function do_added_podcast()
{
 set_time_limit(0);
 $tmp_file_size = $_FILES["mp3"]["size"];
 if ($tmp_file_size!=0)
 {
 $tmp_file_type = $_FILES["mp3"]["type"];
     if ($tmp_file_type=="audio/mpeg")
     {
      if (empty($_POST["titel"]) || empty($_POST["author"]) || empty($_POST["keywords"]) || empty($_POST["beschreibung"]))
       {echo 'Mindestens Ein Datensatz war leer oder 0. Der Vorgang wurde abgebrochen';  }
       else
       {
	       $filename=date("Y_m_d")."_".str_replace(" ","_",$_POST["titel"]);
	       $sql1="INSERT INTO podcast (edit_time,edit_by,titel,beschreibung,author,keywords,size,file) VALUES (
	       '".time()."',
	       '".get_my_id()."',
	       '".get_pod_escape($_POST["titel"])."',
	       '".get_pod_escape($_POST["beschreibung"])."',
	       '".get_pod_escape($_POST["author"])."',
	       '".get_pod_escape($_POST["keywords"])."',
	       '".$tmp_file_size."',
	       '".$filename."')";
	       copy($_FILES["mp3"]["tmp_name"],"../../podcast/".$filename.".mp3");
	       $db=mysql_connect("localhost","portal","psacln");
	       $result1=mysql_db_query("portal",$sql1);
	       echo '<b><u>Datei hochgeladen und verschoben</u></b>';
	       
	       }
 
   
     }
     else { echo 'Falscher, oder falsch &uuml;bermittelter Dateityp. Erlaub ist sind nur MP3 Datein mit dem Mimetyp "audio/mpeg". Dein Dateityo ist: '.$tmp_file_type;}
 }
	
}



function show_edit()
{
	$sql1="SELECT * FROM podcast ORDER BY 'edit_time'";
	$db=mysql_connect("localhost","portal","psacln");
	$result1=mysql_db_query("portal",$sql1);
	echo '<table width="655" cellspacing="5" border="1"><tr><td>ID</td><td>Public</td><td>Edit</td><td width="50">Edit von</td><td width="50">Titel</td><td width="50">Autor</td><td>Keywords</td><td>Gr&ouml;&szlig;e</td><td>Pfad</td><td width="100">Beschreibung</td></td></td></tr>';
	while($zeile1=mysql_fetch_array($result1))
	{
		$sql2="SELECT nick FROM user WHERE id='".$zeile1["edit_by"]."'";
		$result2=mysql_db_query("portal",$sql2);
		$zeile2=mysql_fetch_array($result2);
		

		echo '<tr><form method="post" action="index.php?x=edit"><td>'.$zeile1["id"].'</td>';
		if ($zeile1["pub_time"]!="")
		{echo '<td>'.date("Y-m-d H:i:s",$zeile1["pub_time"]).'</td>';}
		else {echo '<td>N E U</td>'; }
		echo '<td>'.date("Y-m-d H:i:s",$zeile1["edit_time"]).'</td>
		<td>'.$zeile2["nick"].'</td>
		<td><input type="text" name="titel" value="'.$zeile1["titel"].'" /></td>
		<td><input type="text" name="author" value="'.$zeile1["author"].'" /></td>
		<td><input type="text" name="keywords" value="'.$zeile1["keywords"].'" /></td>
		<td>'.(round($zeile1["size"]/1024)).'kb</td>
		<td><a href="../../podcast/'.$zeile1["file"].'.mp3">'.$zeile1["file"].'</td>
		<td><textarea name="beschreibung" rows="5" cols="25">'.$zeile1["beschreibung"].'</textarea></td><td><button type="submit">Speichern</button>
		<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
		<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
		<input type="hidden" name="editid" value="'.$zeile1["id"].'" /></form>
		<br /><br />
		<form method="post" action="index.php?x=edit">
		<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
		<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
		<input type="hidden" name="del" value="'.$zeile1["id"].'" />
		<button type="submit">L&ouml;schen</button></form></td></tr>';
	}
	echo '</table>';
	
	
	
}




function do_edit()
{	
	if (isset($_POST["editid"]))
	{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="UPDATE podcast SET titel='".get_pod_escape($_POST["titel"])."',
	author='".get_pod_escape($_POST["author"])."',
	keywords='".get_pod_escape($_POST["keywords"])."',
	beschreibung='".get_pod_escape($_POST["beschreibung"])."'
	   WHERE id='".filter($_POST["editid"])."'";
	$result1=mysql_db_query("portal",$sql1);
	echo 'Datensatz ge&auml;ndert';
    }
}


function do_del()
{
	if (isset($_POST["delid"]))
	{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="DELETE FROM podcast WHERE id='".filter($_POST["delid"])."'";
	$result1=mysql_db_query("portal",$sql1);
	echo 'Datensatz gel&ouml;scht';
    }
}

function write_podcast_file()
{
	
// Leeren RSS 2.0 Definieren        
$rss="";
// Factor = Qualit&auml;t der MP3's. CD Qualit&auml;t = 128 kb/s, N&ouml;tig um die L&auml;nge des St&uuml;cks zu berechnen
$factor=12800;  	
//Lokales Pfad
$pfad_lokal="../../podcast/";	
// Public Pfad
$pfad_public="http://www.discollection-radio.eu";
	
	$opening='<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
<channel>
    <title>popfox.de, dein kostenloses Webradio</title>
    <link>'.$pfad_public.'/podcast.htm</link>
    <description>popfox.de, dein kostenloses webradio - podcast</description>
    <itunes:summary>popfox.de, dein kostenloses webradio - podcast</itunes:summary>
    <itunes:subtitle>popfox.de podcast</itunes:subtitle>
    <language>de-de</language>
    <copyright>Copyright '.date("Y").' Popfox.de</copyright>
    <itunes:author>Popfox.de Team</itunes:author>
    <itunes:owner>
        <itunes:name>Darius Murawski</itunes:name>
        <itunes:email>programmierung@popfox.de</itunes:email>
    </itunes:owner>
    <ttl>120</ttl>
    <category>News&amp;Politics</category>
    <itunes:category text="News &amp; Politics" />
    <itunes:explicit>no</itunes:explicit>
    <image>
        <url>'.$pfad_public.'/podcast.png</url>
        <title>POPFOX.DE</title>
        <link>'.$pfad_public.'/podcast.htm</link>
    </image>
    <itunes:image href="'.$pfad_public.'/podcast.htm" />    
    <pubDate>'.date("r").'</pubDate>
    <lastBuildDate>'.date("r").'</lastBuildDate>
';

  


$db=mysql_connect("localhost","portal","psacln");
$sql1="SELECT pub_time,titel,beschreibung,author,keywords,size,file FROM podcast ORDER BY 'edit_time' DESC";
$result1=mysql_db_query("portal",$sql1);

$sql2="UPDATE podcast SET pub_time='".time()."'";
$result2=mysql_db_query("portal",$sql2);

while($zeile1=mysql_fetch_array($result1))
{
$xml.='    <item>
        <title>'.$zeile1["titel"].'</title>
        <pubDate>'.date("r",$zeile1["pub_time"]).'</pubDate>
        <description>'.$zeile1["beschreibung"].'</description>
        <link>'.$pfad_public.'/podcast/'.$zeile1["file"].'.mp3</link>
        <enclosure url="'.$pfad_public.'/podcast/'.$zeile1["file"].'.mp3" length="'.$zeile1["size"].'" type="audio/mpeg" />
        <guid>'.$pfad_public.'/podcast/'.$zeile1["file"].'.mp3</guid>
            <itunes:author>'.$zeile1["author"].'</itunes:author>
            <itunes:summary>'.$zeile1["beschreibung"].'</itunes:summary>
            <itunes:keywords>'.$zeile1["keywords"].'</itunes:keywords>
            <itunes:duration>'.date("i:s",round((($zeile1["size"]*0.9)/$factor))).'</itunes:duration>
    </item>';	
}

    
    
    
    
$closing='</channel>
</rss>
<!-- Generated by PHP-FEE, Podcast Modul - Copyright Darius Murawski, Hamburg, Germany -->';


// Schreibe XML 


	       $file = fopen($pfad_lokal."feed.xml", "w");
	       fwrite($file, $opening.$xml.$closing);	
           fclose($file);
           echo '<span style="font-size:18px;color:red;">XML Datei aktualisiert.</span><br ><br />';
           echo '<a href="'.$pfad_lokal.'/podcast/feed.xml"><span style="font-size:14px;color:black;">Podcast runterladen</span></a>';
           echo '<br /><br /><textarea name="" rows="50" cols="100">'.$opening.
           $xml
           .$closing.'</textarea>';
           

    
}


?>