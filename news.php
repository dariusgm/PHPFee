<!--News-->
<?php if (allcheck(47,"",false,""))
{
echo  '<h2>Neuigkeiten</h2>';

include_text("/o/neuigkeiten/1.htm");

include("./lib/news.php");
if (isset($_GET["a"]))
{
show_artikel();
}
else
{show_news();}

 
}?>


<!-- News Ende -->