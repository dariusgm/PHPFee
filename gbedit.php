<?php if (allcheck(33,"","portal_level",0))
{
echo '<!-- G&auml;stebuch -->
<table summary="G&auml;stebuch" frame="void" cellspacing="0" cellpadding="0">
<tr><td class="main" width="685"><br />';
include("./lib/gbedit.php");
echo 'In diesem Men&uuml;punkt kannst du dein G&auml;stebuch verwalten. Private Eintr&auml;ge werden nicht im &Ouml;ffentlichem G&auml;stebuch angezeigt.';
do_gb();
show_gb_edit();
}?>
</td></tr>

</table>
<!-- G&auml;stebuch Ende -->