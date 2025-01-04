<!DOCTYPE html>
<html>
    <head>
        <title>1.ariketa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
<?php
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "markatzelengoaiak";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Konexioan hurrengo errorea gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";

$sql = "SELECT izena, mota, prezioa FROM entrega";
$result = $conn->query($sql);



?>
<form action="1.ariketa.php" method="post">
<label for="bilatu">Sartu bialtu nahi duzun produktuaren izena:</label>
    <input type="text" id="bilatu" name="bilatu"/>
    <button>BILATU</button>
</form>
<br>
<form action="1.ariketa.php" method="post">
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

echo '<i class="fa fa-plus" aria-hidden="true" style="font-size:24px;"></i>';

echo "<h3>Produktuen zerrenda:</h3>";
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th><th></th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["izena"] . "</td>";
        echo "<td>" . $row["mota"] . "</td>";
        echo "<td>" . $row["prezioa"] . " €</td>";
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i>&nbsp<i class='fa fa-pencil' aria-hidden='true'></i></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Ez dago daturik taulan.";
}



$conn->close();
?>

</html>