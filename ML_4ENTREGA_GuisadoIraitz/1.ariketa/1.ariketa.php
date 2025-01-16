<!DOCTYPE html>
<html>
    <head>
        <title>1.ariketa</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Font Awesome estiloko ikonoak erabiltzeko esteka -->
    </head>
<?php
/* MySQL datu basearekin konektatzeko konfigurazioa */
$servername = "localhost";  /* Zerbitzariaren izena */
$username = "root";         /* Erabiltzaile izena */
$password = "1MG2024";      /* Pasahitza */
$dbname = "markatzelengoaiak"; /* Datu basearen izena */

/* MySQL konexioa sortu */
$conn = new mysqli($servername, $username, $password, $dbname);

/* Konexioan erroreak dauden ala ez egiaztatu */
if ($conn->connect_error) {
    die("Konexioan hurrengo errorea gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";

/* SQL kontsulta, entrega izeneko taulatik izena, mota eta prezioa eskuratzeko */
$sql = "SELECT izena, mota, prezioa FROM entrega";
$result = $conn->query($sql); /* Kontsulta exekutatu eta emaitzak lortu */
?>
<!-- Produktu baten izena bilatzeko formularioa -->
<form action="1.ariketa.php" method="post">
    <label for="bilatu">Sartu bilatu nahi duzun produktuaren izena:</label>
    <input type="text" id="bilatu" name="bilatu"/>
    <button>BILATU</button>
</form>
<br>
<!-- Produktuen motaren arabera bilaketa egiteko formularioa -->
<form action="1.ariketa.php" method="post">
    <label for="mota">Aukeratu produktu mota:</label>
    <select id="mota" name="mota">
        <option>Guztiak</option>
        <!-- Produktu moten aukera desberdinak -->
        <option>Elikagaia</option>
        <option>Edaria</option>
        <option>Fruta</option>
        <option>Gozoa</option>
        <option>Espeziak</option>
        <option>Barazkia</option>
        <option>Haragia</option>
        <option>Itsaskia</option>
    </select>
    <button type="submit">Bilatu</button>
</form>
<br>
<?php 
/* Plus ikono bat erakusten du */
echo '<i class="fa fa-plus" aria-hidden="true" style="font-size:24px;"></i>';

/* Produktuen zerrenda goiburua */
echo "<h3>Produktuen zerrenda:</h3>";

/* Emaitzak dauden ala ez egiaztatu */
if ($result->num_rows > 0) {
    echo "<table border='1'>"; /* Taula bat sortu */
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th><th></th></tr>";
    /* Emaitzak lerroka iteratu */
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        /* Lerro bakoitzean datuak erakutsi */
        echo "<td>" . $row["izena"] . "</td>";
        echo "<td>" . $row["mota"] . "</td>";
        echo "<td>" . $row["prezioa"] . " €</td>";
        /* Trash eta edit ikonoak gehitu produktu bakoitzerako */
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i>&nbsp<i class='fa fa-pencil' aria-hidden='true'></i></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    /* Taula hutsik badago mezua erakutsi */
    echo "Ez dago daturik taulan.";
}

/* MySQL konexioa ixteko komandoa */
$conn->close();
?>
</html>