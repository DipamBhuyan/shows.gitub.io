<?php

    $dbh = new PDO('mysql:host=localhost;dbname=show_record', 'root', 'password');
    
    $stmt = $dbh->prepare("Delete from shows where idshows = $_POST[bid]");
	$stmt->execute();
    header("location:record.php")

?>