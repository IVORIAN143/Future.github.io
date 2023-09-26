<?php 
require_once('../Components/db_config.php');
	$data_entry = [];
    $id = $_POST['get_id'];
	$mysql_query = $con->prepare("SELECT * FROM tbl_users WHERE id=$id");
	$mysql_query->execute($data_entry);
	$row = $mysql_query->fetchAll();
	echo json_encode(['status' => true, 'data' => $row]);
 ?>