<?php
include("globals.php");

if (!array_key_exists("pw", $_COOKIE) || $_COOKIE["pw"] !== $PASSWORT) {
	die($ERROR_LOGIN);
}

if (array_key_exists("pos", $_POST)) {
    $pos = $_POST["pos"];

    $stmt = $db->prepare("DELETE FROM KARAOKE WHERE POS = ?");
    $stmt->bind_param("i", $pos);
    $stmt->execute();

    if ($stmt->affected_rows !== 1) {
        die($ERROR_DB);
    }

    $stmt->close();

    $stmt = $db->prepare("UPDATE KARAOKE SET POS = POS - 1 WHERE POS > ?");
    $stmt->bind_param("i", $pos);
    $stmt->execute();
    $stmt->close();
}

header("Location: index.php");

