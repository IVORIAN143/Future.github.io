<?php
	$conn = mysqli_connect("localhost", "root", "", "db_emedrec_final");
		
	if($conn === false){
		die("ERROR: Could not connect. "
			. mysqli_connect_error());
	}
	
    $id = '';
    $medicine_item = $_REQUEST['medicine_item'];
	$qty = $_REQUEST['qty'];
	
	
		
	$sql = "INSERT INTO tbl_med_inventory VALUES ('$id', '$medicine_item', '$qty')";
		
	if(mysqli_query($conn, $sql)){
        header("location:../inventory.php");
	}
    else{
		echo "ERROR: Hush! Sorry $sql. "
			. mysqli_error($conn);
	}
		
	mysqli_close($conn);
?>