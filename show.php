<?php if (allcheck(55,"",false,""))
{


include("./lib/show.php");
echo '<br /><br />';
 show_nick(); 
echo '<hr />';

   if (isset($_SESSION["nick"]) && isset($_SESSION["id"]) && isset($_SESSION["pw"]))
   {
	
   added_gbook();
	
   echo '
   M&ouml;chtest du auch in das G&auml;stebuch von '.get_nick().' etwas reinschreiben?';


   show_gbook_added();} 


}?>