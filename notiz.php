<!-- Notizblock -->

<?php if (allcheck(48,"",false,""))
{

include("./lib/notiz.php");


echo 'Kennt ihr das wenn man im Internet unterwegs ist, allerdings nicht bei sich Zuhause und man m&ouml;chtet kurz etwas notieren?
Hier bekommt ihr genau dazu die M&ouml;glichkeit. Diesen Zettel k&ouml;nnt nur ihr sehen, er wird nicht &ouml;ffentlich angezeigt.<br />';
 do_notiz();
 show_notiz();}?>

<!-- Notiz Ende-->