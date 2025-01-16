<?php
/* Datu-basearekin konexioa egiteko parametroak definitzea */
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "markatzelengoaiak";

/* Datu-basearekin konexioa ezartzea */
$conn = new mysqli($servername, $username, $password, $dbname);

/* Konexioa ondo egin den egiaztatzea */
if ($conn->connect_error) {
    die("Konexioan hurrengo errorea gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!";  // Konexioa arrakastatsua dela adierazten duen mezua
echo "<br>";  // Lerro bat saltatzeko

/* 'izena' parametroa URL-n jasotzen den egiaztatzea */
if (isset($_GET["izena"])) {

    /* URL-n jasotako 'izena' balioa eskuratzea */
    $izena = ($_GET["izena"]);

    /* SQL kontsulta prestatzea, izena emanda dagoen erregistroa ezabatzeko */
    $sql = "DELETE FROM entrega WHERE izena='$izena'";

    /* Kontsulta exekutatzea */
    if ($conn->query($sql) === TRUE) {
        /* Kontsulta arrakastatsua bada, '7.ariketa.php' orrialdeko berrabiarazpena egin */
        header("Location: 7.ariketa.php");
    } else {
        /* Kontsulta exekutatzen errore bat gertatu bada, errore mezua bistaratzea */
        echo "Errorea bat gertatu da erregistroa ezabatzen: " . $conn->error;
    }
} 

/* Datu-basearekin konexioa itxi */
$conn->close();
?>