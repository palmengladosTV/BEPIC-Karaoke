<?php
if (array_key_exists("from", $_POST) && array_key_exists("to", $_POST)) {

    if ($_POST["from"] == $_POST["to"] || $_POST["to"] < 1) {
        header("Location: index.php");
        die();
    }

    include("globals.php");
    /** @var string $ERROR_DB */
    /** @var string $ERROR_PARAM */
    /** @var mysqli $db */

    $stmt = $db->prepare("SELECT MAX(POS) FROM KARAOKE");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($_POST["to"] > $result->fetch_array()[0]) {
        header("Location: index.php");
        die();
    }


    $from = $_POST["from"];
    $to = $_POST["to"];

    $stmt = $db->prepare("UPDATE KARAOKE SET POS = -1 WHERE POS = ?");
    $stmt->bind_param("i", $from);
    $stmt->execute();
    $stmt->close();

    $stmt = $db->prepare("UPDATE KARAOKE SET POS = POS - 1 WHERE POS > ? ORDER BY POS ASC");
    $stmt->bind_param("i", $from);
    $stmt->execute();
    $stmt->close();

    $stmt = $db->prepare("UPDATE KARAOKE SET POS = POS + 1 WHERE POS >= ? ORDER BY POS DESC");
    $stmt->bind_param("i", $to);
    $stmt->execute();
    $stmt->close();

    $stmt = $db->prepare("UPDATE KARAOKE SET POS = ? WHERE POS = -1;");
    $stmt->bind_param("i", $to);
    $stmt->execute();
    $stmt->close();
}

header("Location: index.php");
die();
