<!DOCTYPE html>
<html>

<head>
    <title>3.ariketa</title>
    <!-- ikonoak erabiltzeko estekak -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>
    <?php
    // konexioa egiteko eskaera
// datu basearekin konexioa egiteko datuak: zerbitzariaren izena, erabiltzaile izena, pasahitza eta datu basearen izena
    $conn = new mysqli("localhost", "root", "1MG2024", "markatzelengoaiak");
    // konexioa ondo egin den egiaztatu:
    if ($conn->connect_error) {
        die("Errorea konexioan: " . $conn->connect_error);
    }
    echo "Konexioa ongi egin da!<br><br>";
    // produktu mota aukeratu den egiaztatzeko:
    if (isset($_POST["mota"])) {
        $motaFiltratu = $_POST["mota"];
        // motarik aukeratu ez bada, filtroa hutsik egongo da
    } else {
        $motaFiltratu = '';
    }
    // datu baseari SELECT kontsulta (datu guztiekin)
    $sql = "SELECT izena, mota, prezioa FROM entrega";
    // filtro bat aplikatzen bada, kontsultan where mota = hautatutako aukera
    if ($motaFiltratu != '' && in_array($motaFiltratu, ['Elikagaia', 'Edaria', 'Fruta', 'Gozoa', 'Espeziak', 'Barazkia', 'Haragia', 'Itsaskia'])) {
        $sql .= " WHERE mota = '" . ($motaFiltratu) . "'";
    }

    $result = $conn->query($sql);
    ?>

    <form action="3.ariketa.php" method="post">
        <!-- select baten bidez, dauden mota ezberdinak erakutsi, ondoren filtro bezala erabili ahal izateko -->
        <label for="mota">Aukeratu produktu mota:</label>
        <select id="mota" name="mota">
            <option <?php if ($motaFiltratu == '')
                echo 'selected'; ?>>Guztiak</option>
            <option <?php if ($motaFiltratu == 'Elikagaia')
                echo 'selected'; ?>>Elikagaia</option>
            <option <?php if ($motaFiltratu == 'Edaria')
                echo 'selected'; ?>>Edaria</option>
            <option <?php if ($motaFiltratu == 'Fruta')
                echo 'selected'; ?>>Fruta</option>
            <option <?php if ($motaFiltratu == 'Gozoa')
                echo 'selected'; ?>>Gozoa</option>
            <option <?php if ($motaFiltratu == 'Espeziak')
                echo 'selected'; ?>>Espeziak</option>
            <option <?php if ($motaFiltratu == 'Barazkia')
                echo 'selected'; ?>>Barazkia</option>
            <option <?php if ($motaFiltratu == 'Haragia')
                echo 'selected'; ?>>Haragia</option>
            <option <?php if ($motaFiltratu == 'Itsaskia')
                echo 'selected'; ?>>Itsaskia</option>
        </select>
        <button type="submit">Bilatu</button>
    </form>

    <h3>Produktuen Zerrenda:</h3>
    <?php
    // filtratutako erantzunak erakutsi:
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
        // ez badira datuak filtratu:
    } else {
        echo "<p>Ez dago produkturik.</p>";
    }
    ?>

    <?php $conn->close(); ?>
</body>

</html>