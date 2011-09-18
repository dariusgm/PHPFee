<!--Main-->

<?php if (allcheck(60,"",false,""))
{
include_text("/o/startseite/1.htm");


require("./lib/main.php");
show_next_event();
echo '<br />
<hr /><b>Die News:</b><br />
<hr />';

show_news_short();
echo '<br /><hr /><b>Bands Bei DCR:</b><br />';
show_last_4();

}?>

<!-- Main Ende-->