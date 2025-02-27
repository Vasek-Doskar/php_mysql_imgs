<?php

require_once("login.php");

$conn = login();

$id = $_GET["id"]; // Získání ID obrázku z URL

$stmt = $conn->prepare("SELECT id, nazev, obrazek FROM obrazky WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($idObrazku, $nazevObrazku, $obrazek);
    $stmt->fetch();

    echo "<h1>ID: " . $idObrazku . "</h1>";
    echo "<h2>Název: " . $nazevObrazku . "</h2>";
    echo '<img src="data:image/jpeg;base64,' . base64_encode($obrazek) . '" alt="' . $nazevObrazku . '">';
} else {
    echo "Obrázek nenalezen.";
}

$stmt->close();
$conn->close();
?>