<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { 
       echo '<html>
          <head>
          <title>Discollection -> MOD -> LEITFADEN (Druckversion) </title>
          <link rel="stylesheet" type="text/css" href="format.css" />
          </head><body>
       
       
       
       <form method="post" action="index.php"><input type="hidden" name="' . $_POST["userinput"] . '" />
       <input type="hidden" name="' . $_POST["passinput"] . '" /><button type="submit">Zur&uuml;ck</button></form>';
	   include("main.php");
	   include("technisch.php");
	   include("base.php");
	   include("uebergabe.php");
	   include("onair.php");
	   include("chat.php");
	   include("homepage.php");
	   include("sendeplan.php");
	   include("versammlung.php");
	   include("jingels.php");
	   include("umgang.php");
       echo '<br /><br />Stand: '. date("d.m.Y, H:i:s");
       echo '</body></html>';
	      
   
   }
   else
   {
   echo '<h1>Zugriff verweigert.</h1> ';
   exit();
   }
}
else
{
echo '<h1>Zugriff verweigert.</h1> ';
exit();
}


?>



