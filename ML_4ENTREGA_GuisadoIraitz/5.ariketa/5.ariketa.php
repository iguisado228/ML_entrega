<!DOCTYPE html>
<html>
    <head>
        <title>5.ariketa</title>
        <!-- Font Awesome ikonoak erabiltzeko esteka -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
<?php
/* Datubasera konektatzeko parametroak */
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "markatzelengoaiak";

/* MySQL konexioa sortu */
$conn = new mysqli($servername, $username, $password, $dbname);

/* Konexioan erroreak egiaztatu */
if ($conn->connect_error) {
    die("Konexioan hurrengo errorea gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";

/* SQL kontsulta prestatu datuak lortzeko */
$sql = "SELECT izena, mota, prezioa FROM entrega";
/* Kontsulta exekutatu */
$result = $conn->query($sql);

?>
<!-- Produktu berria gehitzeko ikonoa -->
<a href="insert.php"><i class="fa fa-plus" aria-hidden="true" style="font-size:24px;"></i></a>
<?php
/* Produktuen zerrenda bistaratu */
echo "<h3>Produktuen zerrenda:</h3>";

/* Emaitzak badaude, taula sortu eta datuak erakutsi */
if ($result->num_rows > 0) {
    echo "<table border='1'>"; /* Taularen hasiera */
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th></tr>"; /* Taularen goiburua */
    while ($row = $result->fetch_assoc()) {
        /* Datu bakoitzaren errenkada sortu */
        echo "<tr>";
        echo "<td>" . $row["izena"] . "</td>"; /* Produktu izena */
        echo "<td>" . $row["mota"] . "</td>"; /* Produktu mota */
        echo "<td>" . $row["prezioa"] . " €</td>"; /* Produktu prezioa */
        /* Ezkutatu eta editatzeko ikonoak gehitu */
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i>&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></td>";
        echo "</tr>";
    }
    echo "</table>"; /* Taularen amaiera */
} else {
    /* Taulan daturik ez badago */
    echo "Ez dago daturik taulan.";
}

/* Konexioa itxi */
$conn->close();
?>

</html>