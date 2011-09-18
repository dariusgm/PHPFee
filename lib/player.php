<?php

function get_stream_file()
{

	
	#  switch($_GET["stream"])
    #  {
	#		case 11: return "1_dsl"; break;
	#		case 12: return "1_isdn"; break;
	#		case 21: return "2_dsl"; break;
	#		case 22: return "2_isdn"; break;
	#		case 31: return "3_dsl"; break;
	#		case 32: return "3_isdn"; break;
	#		default: return "1_dsl"; break;
	#  }
    
}

function get_stream_id()
{
	#   switch($_GET["stream"])
	#  {
	#		case 11: return 1; break;
	#		case 12: return 1; break;
	#		case 21: return 2; break;
	#		case 22: return 2; break;
	#		case 31: return 3; break;
	#		case 32: return 3; break;
	#		default: return 1; break;
	#  }
  
}

function show_player()
{
echo '
<OBJECT ID="MediaPlayer"  classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" 
codebase"http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,5,715" 
width="268" height="111" standby="Loading Microsoft Windows Media Player components..." 
type="application/x-oleobject"> 
<param name="FileName" value="http://discollection-radio.eu/streams/wmp'. get_stream_file().'.m3u"> 
<param name="TransparentAtStart" value="true"> 
<param name="AutoStart" value="true"> 
<param name="AnimationatStart" value="false"> 
<param name="ShowStatusBar" value="true"> 
<param name="ShowControls" value="true"> 
<param name="autoSize" value="false"> 
<param name="displaySize" value="false"> 
<param name="ShowAudioControls" value="true"> 
<param name="ShowPositionControls" value="false"> 
<param name="ShowTracker" value="true">
<param name="ShowGotoBar" value="false">
<param name="ShowDisplay" value="false">
<Embed type="application/x-mplayer2" 
pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" 
src="http://discollection-radio.eu/streams/wmp'.get_stream_file().'.m3u" Name="MediaPlayer" 
width="268" height="111" TransparentAtStart="true" AutoStart="true" 
AnimationatStart="false" ShowControls="true" ShowAudioControls="true" 
ShowPositionControls="false" autoSize="false" ShowStatusBar="true" displaySize="false" ShowTracker="true" ShowGotoBar="false" ShowDisplay="false"> 
</embed></OBJECT>';
}


function show_mod()
{
	include("./onair/onair_text".get_stream_id().".htm");
}

function show_titel()
{
	include("./onair/banner_text".get_stream_id().".htm");
}


?>