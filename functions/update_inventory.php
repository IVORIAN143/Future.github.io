<?php
	require_once 'connect.php';

	$id = $_POST["get_id"];

	if(isset($_POST["get_id"]) && !empty($_POST["get_id"])) {

		$id = $_POST["get_id"];
	}

	$subj_enrolled = array();

	$sql = "SELECT * FROM tbl_med_inventory WHERE id = ?";

	if($stmt = mysqli_prepare($con, $sql)){
		mysqli_stmt_bind_param($stmt, "i", $param_id);

		$param_id = trim($_REQUEST["get_id"]);
		if(mysqli_stmt_execute($stmt)){
			$result = mysqli_stmt_get_result($stmt);
			if(mysqli_num_rows($result) == 1){

				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

				
				$medicine_item = $_REQUEST['medicine_item'];
				$curr_total = $_REQUEST['curr_total'];
				$add_med_item = $_REQUEST['add_med_item'];
				$total = $_REQUEST['total'];


				$sql = "UPDATE `tbl_med_inventory` SET medicine_item='$medicine_item',curr_total='$curr_total',add_med_item='$add_med_item',total=$total WHERE id = $id";
		
				if(mysqli_query($con, $sql)){
					header('location: ../inventory.php');
				}
				else{
					echo "ERROR: Hush! Sorry $sql. "
						. mysqli_error($conn);
				}
			}
			else{
				header("location: pages-error-404.php");
				exit();
				}
		}else{
			echo "Oops! Something went wrong. Please try again later.";
		}
		mysqli_stmt_close($stmt);
	}
	else{
		header("location: pages-error-404.php");
		exit();
	   }
	
		
	
		
	mysqli_close($con);
?>