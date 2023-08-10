<?php
session_start();
unset($_SESSION['rid']);
session_destroy();
header("location:index.php")

?>