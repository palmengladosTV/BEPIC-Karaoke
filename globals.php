<?php
$ERROR_DB = "Dicker error mit datenbank oder so";
$ERROR_PARAM = "Dicker error wegen query parametern oder so";
$ERROR_LOGIN = "Falsches Passwort oder nicht eingeloggt!";

$PASSWORT = "passwort";

$db_user = "root";
$db_pw = "glucose12";
$db_name = "KARAOKE";

$songs = json_decode(file_get_contents("songs.json"), true);

$db = new mysqli("localhost", $db_user, $db_pw, $db_name);

if ($db->connect_errno) {
    die($ERROR_DB);
}
