<?php
	$con = mysqli_connect("localhost","root","","bethany_mapan");
    session_start();
    if(mysqli_connect_errno()){
        printf("Connect Failed: %s\n",mysqli_connect_error());
        exit();
    }
	function json($query)
	{
		global $con;
		$que = mysqli_query($con,$query);
		$arr = array();
		while($row = mysqli_fetch_assoc($que))
		{
			array_push($arr,$row);
		}
		return json_encode($arr);
	}
?>
