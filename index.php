<?php

require_once("login.php");
$conn = login();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazev = $_POST["nazev"];
    $obrazek = $_FILES["obrazek"]["tmp_name"];
    $dataObrazku = file_get_contents($obrazek);

    // Ochrana proti SQL injection pomocí prepared statements
    $stmt = $conn->prepare("INSERT INTO obrazky (nazev, obrazek) VALUES (?, ?)");
    $stmt->bind_param("ss", $nazev, $dataObrazku);

    if ($stmt->execute()) {
        echo "Obrázek byl úspěšně uložen.<br>";
    } else {
        echo "Chyba při ukládání obrázku: " . $stmt->error;
    }

    $stmt->close();
}

$result = $conn->query("SELECT id FROM obrazky");
if( $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        echo "Obrázek #$id <a href='detail.php?id=$id'> Detail </a><br>";
    }
}
else echo "Žádné obrázky";
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nahrání obrázku</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <label for="nazev">Název obrázku:</label>
        <input type="text" name="nazev" id="nazev" required><br><br>

        <label for="obrazek">Vyberte obrázek:</label>
        <input type="file" name="obrazek" id="obrazek" required><br><br>

        <input type="submit" value="Uložit obrázek">
    </form>
</body>
</html>