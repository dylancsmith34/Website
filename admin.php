<?php
session_start();

if (!isset($_SESSION['uid'])) {
    header('location: adminLogin.php');
}
require('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Portal</title>
</head>
    <body>
        <div><?php require('header.php');?></div>
        <center>
        <h1>Image Upload</h1>
        <form action="img_upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="imageToUpload" id"imageToUpload">
            <br>
            <br>
            <input type="submit" name="submit" value="Upload">
        </form>
        
        
        <h1>Create Event</h1>
        <form action="event_creation.php" method="post">
            <input type="date" name="eventDate">
            <input type="text" placeholder='Artist' name="eventArtist">
            <input type="text" placeholder='Name of Event' name="eventName">
            <select name="imagePath">
                <?php 
                    $dir = "images/paintings/";
                    if (is_dir($dir)) {
                        if ($dh = opendir($dir)) {
                            while (($file = readdir($dh)) !== false) {
                                if ($file == '.' or $file == '..') continue;
                                echo "<option value = " . $file . " selected>" . $file . "</option>";       
                            }
                            closedir($dh);
                        }
                    }
                ?>
            </select>
            <br>
            <br>
            <input type="submit" name="submit" value="Create">
        </form>
        
        <h1>Event Deletion</h1>
        <form action="event_deletion.php" method="post">
            <select name='eventToDelete'>
                <?php  
                    $dsn = "mysql:host=$host;dbname=$db"; 
                    $pdo = new PDO($dsn, $username, $password);
                    if($stmt = $pdo->prepare("SELECT * FROM events")){
                        $stmt->execute();
                        $row = $stmt->fetchAll();
                    
                        foreach ($row as $event){
                            echo "<option value = ". $event['eid'] . " selected> Event: " . $event['event'] . "  Date: " . $event['date'] . "</option>";
                        }
                    }
            ?>
            </select>
            <br>
            <br>
            <input type="submit" name="delete" value="Delete">
        </form>
        </center>
        <div><?php require('footer.php');?></div>
    </body>
</html>

