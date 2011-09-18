<?php 
if (function_exists("allcheck"))
{allcheck("admin_sendeplan","sendeplan_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_sendeplan","sendeplan_level",10); }
?>
Bespiel:
<?php include("./lib/lib.php"); ?>
<table border="1"><tr>
    <td><input type="text" name="datum" value="2006-12-24" size="8" maxlengh="8" /></td>
    <td><input type="text" name="von" value="1800" size="4" maxlengh="4" /></td>
    <td><input type="text" name="bis" value="2000" size="4" maxlengh="4" /></td>
    <td><input type="text" name="titel" value="Rockcafe" size="20" maxlengh="20" /></td>
    <td><select name="stream"><option value="1">Stream 1</option><option value="2">Stream 2</option></select></td>
    <td><input type="text" name="name" value="DJ Bla" size="10" maxlengh=10" /></td></tr></table>
    <br /><br />
    Leere Zeilen werden &uuml;bersprungen.    
    <?php show_expand();?>