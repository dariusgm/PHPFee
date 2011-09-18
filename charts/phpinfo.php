<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Untitled</title>
</head>
<body>
<?php
//*** Passwort Generieren //
$len = "99"; // l&auml;nge des passworts zb 6,7,8,99 *g*
function randpw($length) {
$possible = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Welche Zeichen alle beim generieren dabei sein dr&uuml;fen z.B.: noch 1-9 oder A-Z oder sonderzeichen
mt_srand((double)microtime() * 1000000);
$str = "";
while(strlen($str) < $length) {
$str .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
}
return $str;
}
$user_password = randpw($len);
// Passwort Generieren ***//
echo $user_password;
echo "<br>";
phpinfo();
?>
</body>
</html>
