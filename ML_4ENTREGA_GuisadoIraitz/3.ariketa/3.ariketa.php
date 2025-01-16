<!DOCTYPE html>
<html>
<head>
    <title>3.ariketa</title>
    <!-- Font Awesome estiloko ikonoak erabiltzeko esteka -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php
/* MySQL konexioa sortzeko konfigurazioa */
$conn = new mysqli("localhost", "root", "1MG2024", "markatzelengoaiak");

/* Konexioan erroreak egiaztatu */
if ($conn->connect_error) {
    die("Errorea konexioan: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";

/* Formularioaren 'mota' balioa lortu, baldin badago */
if (isset($_POST["mota"])) {
    $motaFiltratu = $_POST["mota"];
} else {
    $motaFiltratu = ''; /* Ezer ez bada sartu, hutsik mantendu */
}

/* SQL kontsulta sortu, mota irizpidea gehituz baldin eta aukeratua badago */
$sql = "SELECT izena, mota, prezioa FROM entrega";
if ($motaFiltratu != '' && in_array($motaFiltratu, ['Elikagaia', 'Edaria', 'Fruta', 'Gozoa', 'Espeziak', 'Barazkia', 'Haragia', 'Itsaskia'])) {
    $sql .= " WHERE mota = '" . ($motaFiltratu) . "'";
}

/* SQL kontsulta exekutatu */
$result = $conn->query($sql);
?>

<!-- Produktuen motaren arabera bilaketa egiteko formularioa -->
<form action="3.ariketa.php" method="post">
    <label for="mota">Aukeratu produktu mota:</label>
    <select id="mota" name="mota">
        <!-- Motak aukeratzeko aukerak -->
        <option <?php if ($motaFiltratu == '') echo 'selected'; ?>>Guztiak</option>
        <option <?php if ($motaFiltratu == 'Elikagaia') echo 'selected'; ?>>Elikagaia</option>
        <option <?php if ($motaFiltratu == 'Edaria') echo 'selected'; ?>>Edaria</option>
        <option <?php if ($motaFiltratu == 'Fruta') echo 'selected'; ?>>Fruta</option>
        <option <?php if ($motaFiltratu == 'Gozoa') echo 'selected'; ?>>Gozoa</option>
        <option <?php if ($motaFiltratu == 'Espeziak') echo 'selected'; ?>>Espeziak</option>
        <option <?php if ($motaFiltratu == 'Barazkia') echo 'selected'; ?>>Barazkia</option>
        <option <?php if ($motaFiltratu == 'Haragia') echo 'selected'; ?>>Haragia</option>
        <option <?php if ($motaFiltratu == 'Itsaskia') echo 'selected'; ?>>Itsaskia</option>
    </select>
    <button type="submit">Bilatu</button>
</form>

<h3>Produktuen Zerrenda:</h3>
<?php
/* Bilaketa emaitzak erakutsi */
if ($result->num_rows > 0) {
    echo "<table border='1'>"; /* Taula bat sortu */
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th></tr>";

    /* Taulan datuak gehitu, emaitza guztiak iteratuz */
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["izena"] . "</td>"; /* Produktuaren izena erakutsi */
        echo "<td>" . $row["mota"] . "</td>"; /* Produktuaren mota erakutsi */
        echo "<td>" . $row["prezioa"] . " €</td>"; /* Produktuaren prezioa erakutsi */
        /* Trash eta edit ikonoak gehitu */
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i>&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    /* Emaitzarik ez badago, mezua erakutsi */
    echo "<p>Ez dago produkturik.</p>";
}

/* MySQL konexioa itxi */
$conn->close();
?>
</body>
</html>
