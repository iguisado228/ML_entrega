<?php
/* Datubasera konektatzeko parametroak definitu */
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "markatzelengoaiak";

/* Datubasera konektatu */
$conn = new mysqli($servername, $username, $password, $dbname);

/* Konexioan erroreak egiaztatu */
if ($conn->connect_error) {
    die("Konexioan hurrengo errorea gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!";

/* Formularioa bidali den egiaztatu */
if (isset($_POST["sartu"])) {
    /* Formularioan sartutako balioak lortu */
    $izena = $_POST["izena"];
    $mota = $_POST["mota"];
    $prezioa = $_POST["prezioa"];
  
    /* Balio guztiak ez badaude hutsik, datuak datubasera gehitu */
    if (!empty($izena) && !empty($mota) && !empty($prezioa)) {
        $sql = "INSERT INTO entrega (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')";
        
        /* Kontsulta exekutatu eta emaitza egiaztatu */
        if ($conn->query($sql) === TRUE) {
            /* Arrakastatsua bada, erabiltzailea berriz itzuli produktuen orrialdera */
            header("Location: 5.ariketa.php"); 
            die(); 
        } else {
            /* Errorea gertatuz gero, mezua erakutsi */
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Insertar Producto</title>
    </head>
    <body>
        <!-- Produktu berria gehitzeko formularioa -->
        <form method="post" action="insert.php">
            <!-- Produktuaren izena sartu -->
            <label for="izena">Sartu produktu berriaren izena:</label>
            <input type="text" name="izena" id="izena" placeholder="Sartu izena"><br><br>
            
            <!-- Produktuaren mota sartu -->
            <label for="mota">Sartu produktu berriaren mota:</label>
            <input type="text" name="mota" id="mota" placeholder="Sartu mota"><br><br>
            
            <!-- Produktuaren prezioa sartu -->
            <label for="prezioa">Sartu produktu berriaren prezioa:</label>
            <input type="text" name="prezioa" id="prezioa" placeholder="Sartu prezioa"><br><br>
            
            <!-- Formularioa bidaltzeko botoia -->
            <button type="submit" name="sartu">Sartu</button>
        </form>
    </body>
</html>

<?php
/* Konexioa itxi */
$conn->close();
?>
