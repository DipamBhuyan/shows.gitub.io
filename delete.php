<?php

    $dbh = new PDO('mysql:host=sql105.infinityfree.com;dbname=if0_39277762_show_record', 'if0_39277762', 'tau0ROCdr3E');
    
    $stmt = $dbh->prepare("Delete from shows where idshows = $_POST[bid]");
	$stmt->execute();
    header("location:record.php")

?>
