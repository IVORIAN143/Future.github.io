<?php
	$conn = mysqli_connect("localhost", "root", "", "db_emedrec_final");
		
	if($conn === false){
		die("ERROR: Could not connect. "
			. mysqli_connect_error());
	}
	
    $id = '';
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
		
	$sql = "INSERT INTO tbl_students VALUES ('$id', '$first_name',
		'$middle_initial','$last_name','$student_number', '$year', '$course', '$bdate', '$gender', '$address', '$contact', '$height', '$weight', '$userType', '$FK_v1', '$FK_v2', '$FK_d1', '$FK_d2')";
		
	if(mysqli_query($conn, $sql)){
        header("Refresh: 2; url=../student.php");
	}
    else{
		echo "ERROR: Hush! Sorry $sql. "
			. mysqli_error($conn);
	}
		
	mysqli_close($conn);
?>