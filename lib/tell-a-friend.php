<?php
include("anti-spam.php");	
function send_mail()
{
   if (!empty($_POST["email"]) && !empty($_POST["name"]) && !empty($_POST["text"]))
  { if(check_aufgabe(1)==true)
  {
    $empfaenger = filter($_POST["email"]) ;
    $betreff = "E-mail von einem Freund";
    $nachricht = filter($_POST["text"]).' versendet von: '. filter($_POST["name"]);
    $header = 'From: system@discollection-radio.eu' . "\n" .
    'Reply-To: system@discollection-radio.eu' . "\n" .
    'X-Mailer: PHP-FEE-1.0' . "\n";

  @mail($empfaenger, $betreff, $nachricht, $header);
  echo 'Dein Freund wurde soeben benachrichtigt.';



  }
  else {echo '<a href="tell-a-friend.htm">Bitte versuche es erneut.</a>'; }
  
  
  }
  else
  {
include_text("/o/tell-a-friend/1.htm");
echo gen_aufgabe();
include_text("/o/tell-a-friend/2.htm");
}
}
?>