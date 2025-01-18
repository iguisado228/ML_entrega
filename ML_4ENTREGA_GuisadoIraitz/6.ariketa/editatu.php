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
echo "Konexioa ongi egin da!<br><br>";

$izena = '';
$mota = '';
$prezioa = '';

if (isset($_GET['izena'])) {
    $izena = ($_GET['izena']);
    $sql = "SELECT izena, mota, prezioa FROM entrega WHERE izena = '$izena'";
    $result = $conn->query($sql);
    // klik egindako produktuaren balioak emango zaizkio aldagaiei
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $izena = $row['izena'];
        $mota = $row['mota'];
        $prezioa = $row['prezioa'];
    } 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $izenaBerria = ($_POST['izena']);
    $motaBerria = ($_POST['mota']);
    $prezioaBerria = ($_POST['prezioa']);
// datuak eguneratu update kontsultaren bidez
    $sql = "UPDATE entrega SET izena = '$izenaBerria', mota = '$motaBerria', prezioa = '$prezioaBerria' WHERE izena = '$izena'";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Errore bat egon da: " . $conn->error;
    }
}
// eguneraketaren ondoren aurreko orrira bueltatuko da redirect bidez
if ($conn->query($sql) === TRUE) {
    header("Location: 6.ariketa.php"); 
    die(); 
} 

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Erregistrorako datu berriak sartu</title>
</head>
<body>
    <h3>Editatu Erregistroa</h3>
    <form method="post" action="">
        <!-- datu berriak jasotzeko formularioa -->
        <label for="izena">Sartu produktuaren izen berria:</label>
        <input type="text" name="izena" value="<?php echo $izena; ?>"><br><br>
        <label for="mota">Sartu produktuaren mota berria:</label>
        <input type="text" name="mota" value="<?php echo $mota; ?>"><br><br>
        <label for="prezioa">Sartu produktuaren prezio berria:</label>
        <input type="text" name="prezioa" value="<?php echo $prezioa; ?>"><br><br>
        <input type="submit" value="Sartu">
    </form>
</body>
</html>
