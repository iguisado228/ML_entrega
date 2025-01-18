<!DOCTYPE html>
<html>
    <head>
        <title>6.ariketa</title>
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
    die("Konexioan hurrengo errorea gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";
// datu baseari SELECT kontsulta
$sql = "SELECT izena, mota, prezioa FROM entrega";
$result = $conn->query($sql);


echo "<h3>Produktuen zerrenda:</h3>";
// filtratutako erantzunak erakutsi:
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["izena"] . "</td>";
        echo "<td>" . $row["mota"] . "</td>";
        echo "<td>" . $row["prezioa"] . " €</td>";
        // arkatzaren ikonoan sakatutakoan, editatu.php artxibora bidaliko du erabiltzailea
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i></a>&nbsp<a href='editatu.php?izena=" . $row["izena"] . "'><i class='fa fa-pencil' aria-hidden='true'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
        // ez badira datuak filtratu:
} else {
    echo "Ez dago daturik taulan.";
}



$conn->close();
?>

</html>