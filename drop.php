<?php
include("globals.php");
/** @var string $ERROR_DB */
/** @var string $ERROR_PARAM */
/** @var mysqli $db */

$stmt = $db->prepare("DELETE FROM KARAOKE");
$stmt->execute();

header("Location: index.php");
die();
