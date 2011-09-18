<!-- Mitwirkende -->

<?php if (allcheck(40,"",false,""))
{
echo '
<h2>Mitwirkende</h2>';

include_text("/o/mitwirkende/1.htm");


include("./lib/mitwirkende.php");
show_mitwirkende();
		

}?>

<!-- Mitwrikende Ende -->