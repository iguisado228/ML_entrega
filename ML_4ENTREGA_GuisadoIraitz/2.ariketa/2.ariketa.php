<!DOCTYPE html>
<html>

<head>
    <title>2.ariketa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<?php
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "markatzelengoaiak";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Konexioan errore hau gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";

$sql = "SELECT izena, mota, prezioa FROM entrega";
$result = $conn->query($sql);

$guztiak = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $guztiak[] = $row;
    }
}
?>

<form action="2.ariketa.php" method="post">
    <label for="bilatu">Sartu bilatu nahi duzun produktuaren izena:</label>
    <input type="text" id="bilatu" name="bilatu" />
    <button>BILATU</button>
</form>

<?php
if (isset($_POST["bilatu"])) {
    $bilatu = $_POST["bilatu"];
} else {
    $bilatu = "";
}

$filtratuak = [];

if (!empty($bilatu)) {
    foreach ($guztiak as $row) {
        if (str_contains($row["izena"], $bilatu)) {
            $filtratuak[] = $row;
        }
    }
} else {
    $filtratuak = $guztiak; 
}

echo "<h3>Produktuen zerrenda:</h3>";
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
} else {
    echo "Ez da emaitzarik aurkitu.";
}

$conn->close();
?>

</html>
