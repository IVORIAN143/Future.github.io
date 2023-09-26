<?php 
session_start();
require_once('../Components/db_config.php');

$username = $_POST['username'];
$password = $_POST['password'];
$result = []; 

try {
	$data_entry = [':username' => $username];
	$mysql_query = $con->prepare("SELECT * FROM tbl_users WHERE username=:username");
	$query_result = $mysql_query->execute($data_entry);
	$fetchCount = $mysql_query->rowCount();

	if ($fetchCount > 0) {
		$hasUser = $mysql_query->fetch();
		$userPassword = $hasUser['password'];
		$loginprep =  password_verify($password, $userPassword);

		if ($loginprep === true) {
			$_SESSION['auth'] = $hasUser;
		}else{
			$result = ['status1' => false, 'message' => 'Invalid Password!'];
		}
	}else{
		$result = ['status2' => false, 'message' => 'Invalid username!'];
	}
	$result = ['status' => true, 'message' => 'Login Successfully!'];

    $db = mysqli_connect('localhost', 'root', '', 'db_emedrec_final');
    $query = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: ../index.php');
    }else {
        //array_push($errors, "Wrong username/password combination");
        header('location: ../login.php');
    }

} catch (PDOException $e) {
	$result = ['status' => false, 'message' => $e->getMessage()];
}

echo json_encode($result);

 ?>