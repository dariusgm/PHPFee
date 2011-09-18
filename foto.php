<!-- Foto -->
<?php if (allcheck(31,"",false,""))
{
echo '
Hier kannst Du Deine pers&ouml;nlichen ein Foto von dir hochladen. Das "Standard-Foto" wird auf Deiner Profilseite dargestellt.
Die Fotos d&uuml;rfen eine Gr&ouml;&szlig;e von 100 kb und 200x200 Pixel nicht &uuml;berschreiten, sonst werden sie nicht hochgeladen.
Die hochgeladenen Fotos d&uuml;rfen nicht gegen geltendes Recht versto&szlig;en. Die Fotos d&uuml;rfen keine Nacktaufnahmen sein, sexuell provozierende, gewaltt&auml;tige, gewaltanregende oder auf anderem Wege provozierende Inhalte haben oder urheberrechtlich gesch&uuml;tzt sein. Nutze keine Bilder Anderer ohne deren Einwilligung.
Alle Bilder werden vor der Ver&ouml;ffentlichung von einem Administrator gepr&uuml;ft. Deswegen kann es eine Weile dauern, bis sie auf der Seite dargestellt werden.
Erlaubt sind nur JPG, GIF oder PNG Bilder. Hilfe beim umwandeln findest du im Forum. <br />
<b>Wichtig</b> Bitte beachte das dass Bild &ouml;ffentlich angezeigt wird. Ein l&ouml;schen ist immer m&ouml;glich.';

 include("./lib/foto.php");
echo '<br />';
 do_del();
do_foto(1); 

show_foto(1); 




}?>




</td>
</td>
<td class="naviwhite" width="30"></td>
<td></td></tr>
<tr><td colspan="5"></td></tr>
</table>
<!-- Foto Ende -->