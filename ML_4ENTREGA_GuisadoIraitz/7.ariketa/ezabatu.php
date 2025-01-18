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
echo "Konexioa ongi egin da!";
echo "<br>";

if (isset($_GET["izena"])) {
    // klikatutako produktuaren izena jasoko da
    $izena = ($_GET["izena"]);
    // izen hori DELETE kontsultan erabiliko da produktua ezabatzeko
    $sql = "DELETE FROM entrega WHERE izena='$izena'";

    // produktua ezabatu ondoren, redirect bidez aurreko orrialdera bueltatuko da
    if ($conn->query($sql) === TRUE) {
        header("Location: 7.ariketa.php");
    } else {
        echo "Errorea bat gertatu da erregistroa ezabatzen: " . $conn->error;
    }
} 

$conn->close();
?>
