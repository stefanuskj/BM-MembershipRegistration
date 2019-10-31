<?php
    $key = $_GET['id'];
    $response = "SELECT * from jemaat where id_jemaat LIKE '%".$key."%' || id_kaj LIKE '%".$key."%' || tanggal_bergabung LIKE '".$key."%' || nama LIKE '%".$key."%' || alamat LIKE '%".$key."%' || no_hp LIKE '%".$key."%' || tanggal_lahir LIKE '".$key."%' || kota LIKE '%".$key."%' || jenis_kelamin LIKE '%".$key."%' ";
    echo $response;
?>