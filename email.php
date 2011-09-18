<!--Email-->
<?php if (allcheck(74,"",false,""))
{
echo  '<h2>E-mail verfassen</h2>
<br /><br />HTML wird zum Schutz des Empf&auml;ngers rausgefiltert. Es k&ouml;nnen nur alle 10 Minuten E-Mails an den gleichen Empf&auml;nger versendet werden.';

include("./lib/email.php");
if (isset($_POST["nick"]))
{send_email();}
else
{show_email();}

 
}?>


<!-- Email Ende -->