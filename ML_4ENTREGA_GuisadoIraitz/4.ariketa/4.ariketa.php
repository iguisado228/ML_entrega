<!DOCTYPE html>
<html>
<head>
    <title>4.ariketa</title>
    <!-- Font Awesome ikonoak erabiltzeko esteka -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
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

/* Formularioan sartutako balioak lortu */
$bilatu = isset($_POST["bilatu"]) ? $_POST["bilatu"] : ''; /* Produktu izenaren bilaketa */
$motaFiltratu = isset($_POST["mota"]) ? $_POST["mota"] : ''; /* Produktu motaren iragazkia */

/* SQL kontsulta sortu irizpideak erabiliz */
$sql = "SELECT izena, mota, prezioa FROM entrega WHERE 1 = 1"; /* WHERE 1 = 1 baldintza dinamikoa eraikitzeko */
if (!empty($bilatu)) {
    $sql .= " AND (izena LIKE '%$bilatu%')"; /* Produktu izenaren bilaketa */
}
if (!empty($motaFiltratu) && in_array($motaFiltratu, ['Elikagaia', 'Edaria', 'Fruta', 'Gozoa', 'Espeziak', 'Barazkia', 'Haragia', 'Itsaskia'])) {
    $sql .= " AND mota = '$motaFiltratu'"; /* Produktu motaren iragazkia */
}

/* SQL kontsulta exekutatu */
$result = $conn->query($sql);
?>

<!-- Formularioa: bilaketa eta iragazkia egiteko -->
<form action="4.ariketa.php" method="post">
    <label for="bilatu">Sartu bilatu nahi duzun produktuaren izena:</label>
    <input type="text" id="bilatu" name="bilatu" value="<?php echo ($bilatu); ?>"/> <br><br> <!-- Aurreko balioa mantentzen du -->

    <label for="mota">Aukeratu produktu mota:</label>
    <select id="mota" name="mota">
        <!-- Moten aukerak -->
        <option value="" <?php if ($motaFiltratu == '') echo 'selected'; ?>>Guztiak</option>
        <option value="Elikagaia" <?php if ($motaFiltratu == 'Elikagaia') echo 'selected'; ?>>Elikagaia</option>
        <option value="Edaria" <?php if ($motaFiltratu == 'Edaria') echo 'selected'; ?>>Edaria</option>
        <option value="Fruta" <?php if ($motaFiltratu == 'Fruta') echo 'selected'; ?>>Fruta</option>
        <option value="Gozoa" <?php if ($motaFiltratu == 'Gozoa') echo 'selected'; ?>>Gozoa</option>
        <option value="Espeziak" <?php if ($motaFiltratu == 'Espeziak') echo 'selected'; ?>>Espeziak</option>
        <option value="Barazkia" <?php if ($motaFiltratu == 'Barazkia') echo 'selected'; ?>>Barazkia</option>
        <option value="Haragia" <?php if ($motaFiltratu == 'Haragia') echo 'selected'; ?>>Haragia</option>
        <option value="Itsaskia" <?php if ($motaFiltratu == 'Itsaskia') echo 'selected'; ?>>Itsaskia</option>
    </select>
    <button type="submit">Bilatu</button>
</form>
<br>

<h3>Produktuen Zerrenda:</h3>
<?php
/* Emaitzak erakutsi */
if ($result->num_rows > 0) {
    echo "<table border='1'>"; /* Taula sortu */
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th></tr>";

    /* Emaitza guztiak iteratu eta taulan gehitu */
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . ($row["izena"]) . "</td>"; /* Produktu izena */
        echo "<td>" . ($row["mota"]) . "</td>"; /* Produktu mota */
        echo "<td>" . ($row["prezioa"]) . " €</td>"; /* Produktu prezioa */
        /* Ikonoak gehitu */
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i>&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    /* Emaitzarik ez badago, mezua erakutsi */
    echo "<p>Ez dago produkturik.</p>";
}

/* Konexioa itxi */
$conn->close();
?>
</body>
</html>
