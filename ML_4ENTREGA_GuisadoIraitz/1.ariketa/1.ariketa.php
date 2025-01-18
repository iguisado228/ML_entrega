<!DOCTYPE html>
<html>

<head>
    <title>1.ariketa</title>
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



?>
<form action="1.ariketa.php" method="post">
    <!-- Produktuak bilatzeko erabiliko den formularioa -->
    <label for="bilatu">Sartu bialtu nahi duzun produktuaren izena:</label>
    <!-- Produktuaren izena bilatzeko kanpoa -->
    <input type="text" id="bilatu" name="bilatu" />
    <button>BILATU</button>
</form>
<br>
<form action="1.ariketa.php" method="post">
    <!-- Produktu mota aukeratzeko zerrenda -->
    <label for="mota">Aukeratu produktu mota:</label>
    <select id="mota" name="mota">
        <option>Guztiak</option>
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
// "+" ikonoa txertatu
echo '<i class="fa fa-plus" aria-hidden="true" style="font-size:24px;"></i>';
// produktu zerrendaren titulua
echo "<h3>Produktuen zerrenda:</h3>";
// taulan elementuak dauden egiaztatu
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th><th></th></tr>";
    //taulako informazioa lerroz lerro atera:
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["izena"] . "</td>"; //produktuaren izena
        echo "<td>" . $row["mota"] . "</td>"; // produktu mota
        echo "<td>" . $row["prezioa"] . " €</td>"; // produktuaren prezioa
        // editatu eta ezabatzeko ikonoak
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i>&nbsp<i class='fa fa-pencil' aria-hidden='true'></i></td>";
        echo "</tr>";
    }
    echo "</table>";
    // taula hutsik badago:
} else {
    echo "Ez dago daturik taulan.";
}


// kontsulta amaitu
$conn->close();
?>

</html>