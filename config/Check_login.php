<?php 
    session_start();
    require_once('db_config.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = [];

    try{
        $data_entry = [':username' => $username];
        $mysql_query = $con->prepare("SELECT * FROM tbl_user WHERE username=:username");
        $query_result = $mysql_query->execute($data_entry);
        $fetchCount = $mysql_query->rowCount();

        if ($fetchCount > 0) {
            $hasUser = $mysql_query->fetch();
            $userPassword = $hasUser['password'];
            
            if (password_verify($password, $userPassword)) {
                $_SESSION['auth'] = $hasUser;
                $result = ['status' => true, 'message' => 'Login Successfully!'];
            } else {
                $result = ['status' => false, 'message' => 'Login Unsuccessful'];
            }
        } else {
            $result = ['status' => false, 'message' => 'Invalid username!'];
        }
    }
    catch (PDOException $e) {
        $result = ['status' => false, 'message' => $e->getMessage()];
    }
    echo json_encode($result);
