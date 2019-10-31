<?php 
    $result = $_GET['query'];
    include("connect.php");
    echo json($result);
?>