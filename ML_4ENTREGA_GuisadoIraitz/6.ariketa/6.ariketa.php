<?php
/* Datubasera konektatzeko parametroak definitu */
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "markatzelengoaiak";

/* Datubasera konektatu */
$conn = new mysqli($servername, $username, $password, $dbname);

/* Konexioan erroreak egiaztatu */
if ($conn->connect_error) {
    die("Konexioan hurrengo errorea gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";

/* Produktuak lortzeko SQL kontsulta */
$sql = "SELECT izena, mota, prezioa FROM entrega";
$result = $conn->query($sql);

echo "<h3>Produktuen zerrenda:</h3>";
/* Produktuak taulan erakutsi */
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        /* Produktuen izena, mota eta prezioa erakutsi */
        echo "<td>" . $row["izena"] . "</td>";
        echo "<td>" . $row["mota"] . "</td>";
        echo "<td>" . $row["prezioa"] . " €</td>";
        
        /* Ezabatu eta editatu ikonoak gehitu, editatzeko esteka bat sortu */
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i></a>&nbsp<a href='editatu.php?izena=" . $row["izena"] . "'><i class='fa fa-pencil' aria-hidden='true'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    /* Datuak ez badira aurkitu, mezu bat erakutsi */
    echo "Ez dago daturik taulan.";
}

/* Konexioa itxi */
$conn->close();
?>

</html>