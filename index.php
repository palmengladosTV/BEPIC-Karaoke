<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>BEPIC - Karaoke</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="script.js"></script>
</head>

<body>
<marquee scrolldelay="10" scrollamount="3" behavior="alternate" truespeed><h1>BEPIC KARAOKE</h1></marquee>

<table>
    <tr>
        <th scope="col">Position</th>
        <th scope="col">Song</th>
        <th scope="col">Interpret</th>
        <th scope="col">Gewünscht von</th>
    </tr>

    <?php
    include("globals.php");
    /** @var string $ERROR_DB */
    /** @var string $ERROR_PARAM */
    /** @var mysqli $db */

    $stmt = $db->prepare("SELECT * FROM KARAOKE");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $result = $result->fetch_all();

    for ($i = 0; $i < count($result); $i++) {
        echo "<tr>";
	        echo "<td>" . $result[$i][0] . "</td>";
	        echo "<td>" . $result[$i][1] . "</td>";
	        echo "<td>" . $result[$i][2] . "</td>";
	        echo "<td>" . $result[$i][3] . "</td>";

	        echo "<td class=\"move\">";
		        echo "<form action=\"move.php\" onsubmit=\"tryMove()\" method=\"POST\">";
			        echo "<input type=\"hidden\" name=\"from\" value=" . ($i + 1) . "></input>";
			        echo "<input type=\"hidden\" name=\"to\" class=\"to\" value=" . ($i + 1) . "></input>";
			        echo "<button type=\"submit\" class=\"hidden\">V</button>";
		        echo "</form>";
	        echo "</td>";

	        echo "<td class=\"delete\">";
		        echo "<form action=\"delete.php\" method=\"POST\">";
			        echo "<input type=\"hidden\" name=\"pos\" value=" . ($i + 1) . "></input>";
			        echo "<button type=\"submit\" class=\"hidden\">X</button>";
		        echo "</form>";
	        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

<button class="hidden">
	<a href="insert.php">Neuen Eintrag hinzufügen</a>
</button>

<button class="hidden">
	<a href="drop.php">Alle Einträge löschen</a>
</button>

<button class="hidden" onclick="login()">Login</button>

</body>

<button class="hidden">
	<a href="https://github.com/Fabus1184/BEPIC-Karaoke"> GitHub</a>
</button>

</body>


<footer>
    &copy 2022 Fabian Lippold & Tim Palm
</footer>
</html>
