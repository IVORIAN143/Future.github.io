<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['import'])) {
	$allowed_ext = ['xls', 'csv', 'xlsx'];
	$inputFileNamePath = $_FILES['import_file']['tmp_name'];
	$spreadsheet = IOFactory::load($inputFileNamePath);
	$data = $spreadsheet->getActiveSheet()->toArray();
	$successCount = 0;

	try {
		$studentQuery = "INSERT INTO tbl_student (STUDENT_ID, FIRSTNAME, MIDDLENAME, LASTNAME, COURSE, YEAR, GENDER, ADDRESS, CONTACT_NO, CITIZENSHIP)
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $con->prepare($studentQuery);

		foreach ($data as $row) {
			list($STUDENT_ID, $FIRSTNAME, $MIDDLENAME, $LASTNAME, $COURSE, $YEAR, $GENDER, $ADDRESS, $CONTACT_NO, $CITIZENSHIP) = $row;
			if ($stmt->execute([$STUDENT_ID, $FIRSTNAME, $MIDDLENAME, $LASTNAME, $COURSE, $YEAR, $GENDER, $ADDRESS, $CONTACT_NO, $CITIZENSHIP])) {
				$successCount++;
			}
		}

		$_SESSION['message'] = ($successCount > 0) ? "Successfully Imported $successCount records" : "No records imported";
		header('Location: bsit-student.php'); // Redirect to the same page
		exit();
	} catch (PDOException $e) {
		$_SESSION['message'] = "Error: " . $e->getMessage();
		header('Location: bsit-student.php'); // Redirect to the same page
		exit();
	}
}

// Fetch data from the database
$query = "SELECT * FROM tbl_student";
$result = $con->query($query);

$data = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	$data[] = $row;
}
