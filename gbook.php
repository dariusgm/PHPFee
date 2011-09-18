<!--G&auml;stebuch-->
<?php if (allcheck(34,"",false,""))
{
echo '<h2>G&auml;stebuch</h2>';
include_text("/o/gaestebuch/1.htm");

 include("./lib/gbook.php"); 
 do_added_gbook();
 show_gbook();
 show_added_gbook();
}?>
<!-- G&auml;stebuch Ende -->