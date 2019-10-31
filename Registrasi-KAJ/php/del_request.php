<?php
include("connect.php");
$id = $_GET['id'];
mysqli_query($con,"delete from jemaat where id_jemaat ='$id'");
?>