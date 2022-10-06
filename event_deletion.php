<?php 

require_once"config.php";
error_reporting(E_ALL); 
ini_set('display_errors', 1);
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])){

    $eid = $_POST['eventToDelete'];
    if (empty($error)) {

        $dsn = "mysql:host=$host;dbname=$db"; 
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            if($stmt = $pdo->prepare("DELETE FROM events WHERE eid = :eid")){
                $stmt->bindParam(':eid', $eid);
                $stmt->execute();
                header('location: admin.php');
            }
    }
}
?>
