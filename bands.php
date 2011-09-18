<!-- Bands -->
<?php if (allcheck(19,"",false,""))
{
echo '<h2>Bands</h2>';
include_text("/o/bands/1.htm");

require("./lib/bands.php");
if (isset($_GET["a"]))
{
show_band();
}
else
{show_bands();}

}?>
<!-- Sendeplan Ende-->