<!DOCTYPE html>
<html>
<head>
    <title>3.ariketa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
<?php
$conn = new mysqli("localhost", "root", "1MG2024", "markatzelengoaiak");

if ($conn->connect_error) {
    die("Errorea konexioan: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!<br><br>";

if (isset($_POST["mota"])) {
    $motaFiltratu = $_POST["mota"];
} else {
    $motaFiltratu = '';
}

$sql = "SELECT izena, mota, prezioa FROM entrega";
if ($motaFiltratu != '' && in_array($motaFiltratu, ['Elikagaia', 'Edaria', 'Fruta', 'Gozoa', 'Espeziak', 'Barazkia', 'Haragia', 'Itsaskia'])) {
    $sql .= " WHERE mota = '" . ($motaFiltratu) . "'";
}

$result = $conn->query($sql);
?>

<form action="3.ariketa.php" method="post">
    <label for="mota">Aukeratu produktu mota:</label>
    <select id="mota" name="mota">
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
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Izena</th><th>Mota</th><th>Prezioa</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["izena"] . "</td>";
        echo "<td>" . $row["mota"] . "</td>";
        echo "<td>" . $row["prezioa"] . " €</td>";
        echo "<td><i class='fa fa-trash' aria-hidden='true'></i>&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Ez dago produkturik.</p>";
}
?>

<?php $conn->close(); ?>
</body>
</html>
