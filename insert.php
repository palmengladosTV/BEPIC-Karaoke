<?php
if (array_key_exists("song", $_POST)
    && array_key_exists("person", $_POST)
    && array_key_exists("pw", $_COOKIE)) {

	if ($_COOKIE["pw"] != $PASSWORT) {
		die($ERROR_LOGIN);
	}

    include("globals.php");
    /** @var string $ERROR_DB */
    /** @var string $ERROR_PARAM */
    /** @var mysqli $db */

    $stmt = $db->prepare("SELECT MAX(POS) FROM KARAOKE");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        die($ERROR_DB);
    }
    $stmt->close();

    $pos = $result->fetch_array()[0];

    if ($pos === null) {
        $pos = 0;
    }

    $pos += 1;

    $song = array_keys($songs)[$_POST["song"]];
    $interpret = array_values($songs)[$_POST["song"]];
    $person = htmlspecialchars($_POST["person"]);

    $stmt = $db->prepare("INSERT INTO KARAOKE VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $pos, $song, $interpret, $person);
    $stmt->execute();

    if ($stmt->affected_rows !== 1) {
        die($ERROR_DB);
    }
    $stmt->close();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>BEPIC - Karaoke</title>
    <link rel="stylesheet" href="style.css"/>
</head>

<body>
<h1>Neuen Eintrag hinzufügen</h1>

<table>
    <form method="POST">
        <tr>
            <th scope="col">Song</th>
            <th scope="col">Gewünscht von</th>
        </tr>

        <tr>
            <td>
            	<select name="song" placeholder="Never gonna give you up" required>

				<?php
					include("globals.php");
					
					for($i = 0; $i < count($songs); $i++) {
						echo "<option value=" . $i . ">";
						echo array_keys($songs)[$i] . " - " . array_values($songs)[$i] . "</option>";
					}

				?>
            	
            	</select>
           	</td>

            <td><input name="person" placeholder="mir" required></input></td>

        </tr>

        <tr>
            <td colspan="3">
                <button type="submit">Hinzufügen</button>
            </td>
        </tr>

    </form>

</table>
</body>
</html>
