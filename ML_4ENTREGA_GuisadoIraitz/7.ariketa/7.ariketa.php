<!DOCTYPE html>
<html>
    <head>
        <title>7.ariketa</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
<?php
/* Datu-basearekin konexioa egiteko parametroak definitzea */
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "markatzelengoaiak";

/* Datu-basearekin konexioa sortzea */
$conn = new mysqli($servername, $username, $password, $dbname);

/* Konexio erroreak egon badira egiaztatu */
if ($conn->connect_error) {
    die("Konexioan hurrengo errorea gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";  // Konexioaren arrakasta mezua

/* Produktuak lortzeko SQL kontsulta */
$sql = "SELECT izena, mota, prezioa FROM entrega";
$result = $conn->query($sql);

/* Produktuen zerrenda erakustea */
echo "<h3>Produktuen zerrenda:</h3>";
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th></tr>";
    
    /* Datuak taulan erakusteko, emaitzak iteratzen ditugu */
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["izena"] . "</td>";
        echo "<td>" . $row["mota"] . "</td>";
        echo "<td>" . $row["prezioa"] . " €</td>";
        /* Produktua ezabatzeko esteka (papelontzi ikonoa erabilita) */
        echo "<td><a href='ezabatu.php?izena=" . $row["izena"] . "'><i class='fa fa-trash' aria-hidden='true'></i></a>&nbsp;
              <!-- Produktua editatzeko esteka (atzearen ikonoa erabilita) -->
              <a href='editatu.php?izena=" . $row["izena"] . "'><i class='fa fa-pencil' aria-hidden='true'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Ez dago daturik taulan.";  // Ez dago daturik, mezua bistaratzen da
}

/* Datu-basearekin konexioa itxi */
$conn->close();
?>

</html>