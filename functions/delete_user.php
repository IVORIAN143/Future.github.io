<?php
    $host = "localhost";  
    $user = "root";  
    $password = '';  
    $db_name = "db_emedrec_final"; 

    // Create connection
    $conn = new mysqli($host, $user, $password, $db_name);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET["id"];

    if(isset($_POST["id"]) && !empty($_POST["id"])) {

        $id = $_GET["id"];
    }

    $subj_enrolled = array();

    $sql = "SELECT * FROM tbl_user WHERE id = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 1){
                // sql to delete a record
                $sql = "DELETE FROM tbl_user WHERE id = $id";

                if ($conn->query($sql) === TRUE) {
                    header("Refresh: 2; url=../Users.php");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }
            else{
                //header("location: ../pages-error-404.php");
                echo "Error 1";
                exit();
                }
        }else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);

        
    }
    else{
        header("location: ../pages-error-404.php");
        exit();
    }
?>