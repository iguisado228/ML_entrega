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



if (isset($_POST["sartu"])) {
    $izena = $_POST["izena"];
    $mota = $_POST["mota"];
    $prezioa = $_POST["prezioa"];
  
    if (!empty($izena) && !empty($mota) && !empty($prezioa)) {
        $sql = "INSERT INTO entrega (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: 5.ariketa.php"); 
            die(); 
        } else {
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
        <form method="post" action="insert.php">
            <label for="izena">Sartu produktu berriaren izena:</label>
            <input type="text" name="izena" id="izena" placeholder="Sartu izena"><br><br>
            
            <label for="mota">Sartu produktu berriaren mota:</label>
            <input type="text" name="mota" id="mota" placeholder="Sartu mota"><br><br>
            
            <label for="prezioa">Sartu produktu berriaren prezioa:</label>
            <input type="text" name="prezioa" id="prezioa" placeholder="Sartu prezioa"><br><br>
            
            <button type="submit" name="sartu">Sartu</button>
        </form>
    </body>
</html>

<?php
$conn->close();
?>
