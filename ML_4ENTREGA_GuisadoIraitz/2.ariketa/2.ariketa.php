<!DOCTYPE html>
<html>

<head>
    <title>2.ariketa</title>
    <!-- Font Awesome estiloko ikonoak erabiltzeko esteka -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
    die("Konexioan errore hau gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";

/* SQL kontsulta, entrega taulatik izena, mota eta prezioa eskuratzeko */
$sql = "SELECT izena, mota, prezioa FROM entrega";
$result = $conn->query($sql);

$guztiak = []; /* Produktuak gordetzeko array bat sortu */

/* Emaitzak badaude, guztiak array-ra gehitu */
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $guztiak[] = $row;
    }
}
?>

<!-- Produktu baten izena bilatzeko formularioa -->
<form action="2.ariketa.php" method="post">
    <label for="bilatu">Sartu bilatu nahi duzun produktuaren izena:</label>
    <input type="text" id="bilatu" name="bilatu" />
    <button>BILATU</button>
</form>

<?php
/* Formularioaren datua hartu, baldin badago */
if (isset($_POST["bilatu"])) {
    $bilatu = $_POST["bilatu"];
} else {
    $bilatu = ""; /* Ezer ez bada sartu, hutsik egon dadila */
}

$filtratuak = []; /* Bilaketa emaitzak gordetzeko array bat sortu */

/* Bilaketa egitea */
if (!empty($bilatu)) {
    /* Guztien artean izena bilatu */
    foreach ($guztiak as $row) {
        if (str_contains($row["izena"], $bilatu)) {
            $filtratuak[] = $row; /* Aurkitutako emaitza array-an gehitu */
        }
    }
} else {
    /* Bilaketa hutsa bada, datu guztiak erakutsi */
    $filtratuak = $guztiak; 
}

/* Produktuen zerrenda erakutsi */
echo "<h3>Produktuen zerrenda:</h3>";

if (!empty($filtratuak)) {
    echo "<table border='1'>"; /* Taula bat sortu */
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th><th></th></tr>";
    foreach ($filtratuak as $row) {
        echo "<tr>";
        echo "<td>" . ($row["izena"]) . "</td>"; /* Produktuaren izena erakutsi */
        echo "<td>" . ($row["mota"]) . "</td>"; /* Produktuaren mota erakutsi */
        echo "<td>" . ($row["prezioa"]) . " €</td>"; /* Produktuaren prezioa erakutsi */
        /* Trash eta edit ikonoak gehitu */
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i>&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    /* Emaitzarik ez bada, mezua erakutsi */
    echo "Ez da emaitzarik aurkitu.";
}

/* MySQL konexioa itxi */
$conn->close();
?>

</html>