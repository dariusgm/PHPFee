<?php if (allcheck(60,"",false,""))
{

<?php include("./lib/player.php");?>
<?php include("./lib/status.php");?>
echo '
<table>
<tr><td>Du h&ouml;rst aktuell den Stream: <i><?php echo get_stream_id(); ?></i></td></tr>
<tr><td><?php show_player();?></td></tr>
<tr><td>Aktuell sendet: <b><?php show_mod(); ?></b> </td></tr>
<tr><td>Thema der Sendung: <?php get_utf(show_titel()); ?></td></tr>
<tr><td>Stream &auml;ndern: <form method="get" action="webplayer.php"><select name="stream">
<option value="11">Stream 1 DSL</option>
<option value="12">Stream 1 ISDN</option>
<option value="21">Stream 2 DSL</option>
<option value="22">Stream 2 ISDN</option>
<option value="31">Stream 3 DSL</option>
<option value="32">Stream 3 ISDN</option>
</select><button type="submit">Musik hören</button></form></td></tr></table><?php ';}?>

