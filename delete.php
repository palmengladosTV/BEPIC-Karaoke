<?php
if (array_key_exists("pos", $_POST)) {

    include("globals.php");
    /** @var string $ERROR_DB */
    /** @var string $ERROR_PARAM */
    /** @var mysqli $db */

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

