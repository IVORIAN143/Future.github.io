<?php
	require_once 'connect.php';

	$id = $_POST["get_id"];

	if(isset($_POST["get_id"]) && !empty($_POST["get_id"])) {

		$id = $_POST["get_id"];
	}

	$subj_enrolled = array();

	$sql = "SELECT * FROM tbl_students WHERE id = ?";

	if($stmt = mysqli_prepare($con, $sql)){
		mysqli_stmt_bind_param($stmt, "i", $param_id);

		$param_id = trim($_REQUEST["get_id"]);
		if(mysqli_stmt_execute($stmt)){
			$result = mysqli_stmt_get_result($stmt);
			if(mysqli_num_rows($result) == 1){

				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

				$userType = '';
				$FK_v1 = '';
				$FK_v2 = '';
				$FK_d1 = '';
				$FK_d2 = '';
				$first_name = $_REQUEST['first_name'];
				$last_name = $_REQUEST['last_name'];
				$middle_initial = $_REQUEST['middle_name'];
				$student_number = $_REQUEST['student_number'];
				$course = $_REQUEST['course'];
				$year = $_REQUEST['year'];
				$gender = $_REQUEST['gender'];
				$bdate = $_REQUEST['birthdate'];
				$address = $_REQUEST['address'];
				$contact = $_REQUEST['contact'];
				$height = $_REQUEST['height'];
				$weight = $_REQUEST['weight'];

				$sql = "UPDATE `tbl_students` SET l_name='$last_name',f_name='$first_name',m_name='$middle_initial',student_number='$student_number', year='$year',course='$course',dob='$bdate',gender='$gender',address='$address',contact='$contact',height='$height',weight='$weight' WHERE id = $id";
		
				if(mysqli_query($con, $sql)){
					header('location: ../Record.php');
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