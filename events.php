<!-- Events -->
<?php if (allcheck(29,"",false,""))
{
	echo '<h2>Events</h2>';
include_text("/o/events/1.htm");
	
	
 require_once("./lib/events.php");
 show_events();}?>
<!-- Events Ende -->