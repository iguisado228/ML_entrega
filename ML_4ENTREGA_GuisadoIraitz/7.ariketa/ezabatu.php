<?php
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "markatzelengoaiak";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Konexioan hurrengo errorea gertatu da: " . $conn->connect_error);
}
echo "Konexioa ongi egin da!";
echo "<br>";

if (isset($_GET["izena"])) {

    $izena = ($_GET["izena"]);

    $sql = "DELETE FROM entrega WHERE izena='$izena'";


    if ($conn->query($sql) === TRUE) {
        header("Location: 7.ariketa.php");
    } else {
        echo "Errorea bat gertatu da erregistroa ezabatzen: " . $conn->error;
    }
} 

$conn->close();
?>
