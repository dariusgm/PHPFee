<?php 
if (function_exists("allcheck"))
{allcheck("admin_sendeplan","sendeplan_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_sendeplan","sendeplan_level",10); }
?>
    <form method="post" action="index.php?serie">
    <input type="hidden" value="' .$_POST["username"].'" name="userinput" size="4" maxlengh="4"  />
    <input type="hidden" value="' .$_POST["passinput"].'" name="passinput" size="4" maxlengh="4" />
    <input type="hidden" value="expand" name="do" />
    <table><tr><td>Ausgangsdatum:</td><td><input type="text" name="datum" value="" size="8" maxlengh="8" /></td></tr>
    <tr><td>Von Uhrzeit:</td><td><input type="text" name="von" value="" size="4" maxlengh="4" /></td></tr>
    <tr><td>Bis Uhrzeit:</td><td><input type="text" name="bis" value="" size="4" maxlengh="4" /></td></tr>
    <tr><td>Sendungstitel:</td><td><input type="text" name="titel" value="" size="30" maxlengh="30" /></td></tr>
    <tr><td>DJ Name:</td><td><input type="text" name="name" value="" size="10" maxlengh="10" /></td></tr>
    <tr><td>An welchem Tag:</td><td><input type="text" name="tage" value="" size="2" maxlenght="2" /></td></tr>
    <tr><td>Ausgangsdatum:</td><td><input type="text" name="wochen" value="" size="2" maxlenght="2" /></td></tr>
    </table></form>
