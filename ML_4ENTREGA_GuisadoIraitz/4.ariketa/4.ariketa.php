<!DOCTYPE html>
<html>
<head>
    <title>4.ariketa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
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

$bilatu = isset($_POST["bilatu"]) ? $_POST["bilatu"] : '';
$motaFiltratu = isset($_POST["mota"]) ? $_POST["mota"] : '';

$sql = "SELECT izena, mota, prezioa FROM entrega WHERE 1 = 1";
if (!empty($bilatu)) {
    $sql .= " AND (izena LIKE '%$bilatu%')";
}
if (!empty($motaFiltratu) && in_array($motaFiltratu, ['Elikagaia', 'Edaria', 'Fruta', 'Gozoa', 'Espeziak', 'Barazkia', 'Haragia', 'Itsaskia'])) {
    $sql .= " AND mota = '$motaFiltratu'";
}

$result = $conn->query($sql);
?>

<form action="4.ariketa.php" method="post">
    <label for="bilatu">Sartu bialtu nahi duzun produktuaren izena:</label>
    <input type="text" id="bilatu" name="bilatu" value="<?php echo ($bilatu); ?>"/> <br><br>
    <label for="mota">Aukeratu produktu mota:</label>
    <select id="mota" name="mota">
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
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . ($row["izena"]) . "</td>";
        echo "<td>" . ($row["mota"]) . "</td>";
        echo "<td>" . ($row["prezioa"]) . " €</td>";
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i>&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Ez dago produkturik.</p>";
}

$conn->close();
?>
</body>
</html>
