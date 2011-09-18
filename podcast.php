<!-- Podcast -->
<?php if (allcheck(67,"",false,""))
{ echo '<h2>Podcast</h2>';

include_text("/o/podcast/1.htm");
include("./lib/podcast.php");
show_podcast(10);} ?>

<!-- Podcast Ende -->