<?php
require('db_config.php');

$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$password = $_POST['password'];
$message_result = "";
$result = [];

if (empty($firstName) || empty($middleName) || empty($lastName) || empty($username) || empty($password)) {
    $result = ['status' => false, 'message' => 'All fields are required!'];
} else {
    try {
        $check_query = $con->prepare("SELECT COUNT(*) FROM tbl_user WHERE username = :username");
        $check_query->bindParam(':username', $username);
        $check_query->execute();
        $fetchCount = $check_query->fetchColumn();

        if ($fetchCount > 0) {
            $result = ['status' => false, 'message' => 'Username already taken!'];
        } else {
            $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                ':firstname' => $firstName,
                ':middlename' => $middleName,
                ':lastname' => $lastName,
                ':username' => $username,
                ':password' => $hashed_pwd
            ];
            $user_query = $con->prepare("INSERT INTO tbl_user (firstname, middlename, lastname, username, password) VALUES (:firstname, :middlename, :lastname, :username, :password)");
            $execute = $user_query->execute($data);

            if ($execute) {
                $result = ['status' => true, 'message' => "Profile ".$message_result." Successfully"];
            } else {
                $result = ['status' => false, 'message' => 'Error while inserting data.'];
            }
        }
    } catch (PDOException $e) {
        $result = ['status' => false, 'message' => $e->getMessage()];
    }
}

header('Content-Type: application/json');
echo json_encode($result);
