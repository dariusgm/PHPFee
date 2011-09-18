es sollte eine Länge von mindestens 8 Zeichen besitzen,
es sollte aus einer Mischung von Groß- und Kleinbuchstaben, Ziffern sowie Sonderzeichen bestehen,
Leerzeichen sind nicht zulässig,
man sollte es sich leicht merken können, damit man es nicht aufschreiben muß,
es sollte kein Wort einer bekannten Sprache sein,
es sollte keine Tastaturfolge wie z.B. "qwerty" oder "asdfgh" sein,
das Passwort sollte man schnell eingeben können, damit es niemand beim Eintippen mitlesen kann,
das Passwort sollte für andere Benutzer sinnlos sein.

INSERT INTO `book` (`id`,`word`,`lang`) VALUES (NULL,'qwertzuiop','misc');
INSERT INTO `book` (`id`,`word`,`lang`) VALUES (NULL,'qwertyuiop','misc');
INSERT INTO `book` (`id`,`word`,`lang`) VALUES (NULL,'asdfghjkl','misc');
INSERT INTO `book` (`id`,`word`,`lang`) VALUES (NULL,'yxcvbnm','misc');
INSERT INTO `book` (`id`,`word`,`lang`) VALUES (NULL,'zxcvbnm','misc');
INSERT INTO `book` (`id`,`word`,`lang`) VALUES (NULL,'abcdefghijklmnopqrstuvwxyz','misc');
INSERT INTO `book` (`id`,`word`,`lang`) VALUES (NULL,'zyxwvutsrqponmlkjihgfedcba','misc');
INSERT INTO `book` (`id`,`word`,`lang`) VALUES (NULL,'01234567890','misc');
INSERT INTO `book` (`id`,`word`,`lang`) VALUES (NULL,'09876543210','misc');
update book set word=lower(word);

AdminCP -> 
Styles und Templates -> 
Styles Verwalten -> 
auf den button rechts neben "Los" klicken und anschließend das gewünschte template per doppelklick zum bearbeiten öffnen


meta angaben stehen im template "headinclude"


copyright steht im template "footer"