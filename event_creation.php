<?php
require_once"config.php";
error_reporting(E_ALL); 
ini_set('display_errors', 1);
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){

    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventArtist = $_POST['eventArtist'];
    $imagePath = $_POST['imagePath'];
    if (empty($error)) {

        $dsn = "mysql:host=$host;dbname=$db"; 
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            if($stmt = $pdo->prepare("INSERT INTO events (event, artist, path, date) VALUES(?, ?, ?, ?)")){
                $values = [$eventName, $eventArtist, 'images/paintings/' . $imagePath, $eventDate];
                $stmt->execute($values);
                header('location: admin.php');
            }
    }
}
?>
