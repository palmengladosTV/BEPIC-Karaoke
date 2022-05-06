<?php
include("globals.php");

if (!array_key_exists("pw", $_COOKIE) || $_COOKIE["pw"] !== $PASSWORT) {
	die($ERROR_LOGIN);
}

$stmt = $db->prepare("DELETE FROM KARAOKE");
$stmt->execute();

header("Location: index.php");
die();
