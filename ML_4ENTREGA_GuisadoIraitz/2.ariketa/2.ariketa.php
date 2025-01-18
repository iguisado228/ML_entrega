<!DOCTYPE html>
<html>

<head>
    <title>2.ariketa</title>
    <!-- ikonoak erabiltzeko estekak -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<?php
// datu basearekin konexioa egiteko datuak: zerbitzariaren izena, erabiltzaile izena, pasahitza eta datu basearen izena
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "markatzelengoaiak";
// konexioa egiteko eskaera
$conn = new mysqli($servername, $username, $password, $dbname);
// konexioa ondo egin den egiaztatu:
if ($conn->connect_error) {
    die("Konexioan errore hau gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";
// datu baseari SELECT kontsulta
$sql = "SELECT izena, mota, prezioa FROM entrega";
$result = $conn->query($sql);
// produktu array bat sortu
$guztiak = [];
if ($result->num_rows > 0) {
    // lerroz lerro taulako datuak array-ean sartu
    while ($row = $result->fetch_assoc()) {
        $guztiak[] = $row;
    }
}
?>

<form action="2.ariketa.php" method="post">
    <!-- Produktuak bilatzeko erabiliko den formularioa -->
    <label for="bilatu">Sartu bilatu nahi duzun produktuaren izena:</label>
    <!-- Produktuaren izena bilatzeko kanpoa -->
    <input type="text" id="bilatu" name="bilatu" />
    <button>BILATU</button>
</form>

<?php
// formularioan bilatzeko testua badago egiaztatu
if (isset($_POST["bilatu"])) {
    $bilatu = $_POST["bilatu"];
} else {
    $bilatu = "";
}
// bilaketaren arabera lortuko diren emaitzak gordetzeko array-a
$filtratuak = [];
// bilaketa kanpoa hutsik badago:
if (!empty($bilatu)) {
    // taulako elementu guztiak erakutsi
    foreach ($guztiak as $row) {
        if (str_contains($row["izena"], $bilatu)) {
            $filtratuak[] = $row;
        }
    }
} else {
    $filtratuak = $guztiak;
}

echo "<h3>Produktuen zerrenda:</h3>";
// filtratutako erantzunak erakutsi:
if (!empty($filtratuak)) {
    echo "<table border='1'>";
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th><th></th></tr>";
    foreach ($filtratuak as $row) {
        echo "<tr>";
        echo "<td>" . ($row["izena"]) . "</td>";
        echo "<td>" . ($row["mota"]) . "</td>";
        echo "<td>" . ($row["prezioa"]) . " €</td>";
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i>&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></td>";
        echo "</tr>";
    }
    echo "</table>";
    // ez badira datuak filtratu:
} else {
    echo "Ez da emaitzarik aurkitu.";
}

$conn->close();
?>

</html>