<?php
include("globals.php");
/** @var string $ERROR_DB */
/** @var string $ERROR_PARAM */
/** @var mysqli $db */

$stmt = $db->prepare("
		SELECT SHA1(	CONCAT(W, X, Y, Z)		)
			FROM (SELECT
				GROUP_CONCAT(	SHA1(POS)		) 		AS W,
				GROUP_CONCAT(	SHA1(SONG)		) 		AS X,
				GROUP_CONCAT(	SHA1(INTERPRET)	) 		AS Y,
				GROUP_CONCAT(	SHA1(PERSON)	) 		AS Z
					FROM KARAOKE
				) AS T;
	");

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die($ERROR_DB);
}
$stmt->close();

echo(json_encode(
    array("hash" => $result->fetch_array()[0])
));

