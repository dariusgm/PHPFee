<!-- Nick Aktivieren -->
<?php if (allcheck(18,"",false,""))
{
echo '
<h2>Benutzer aktivieren</h2>
';
 include("./lib/do_akti.php");
do_akti(); } ?>
<!-- Nick Aktivieren Ende -->