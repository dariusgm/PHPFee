<?php if (allcheck(28,"","id",0))
{
echo '
<br /><br />
<br /><br />';
 include("./lib/edit.php");

if ($_POST["do"]=="edit")
{
do_edit(); 
}

 show_edit();}?>