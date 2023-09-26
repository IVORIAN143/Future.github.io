<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'db_emedrec_final');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $f_name = mysqli_real_escape_string($db, $_POST['f_name']);
  $m_name = mysqli_real_escape_string($db, $_POST['m_name']);
  $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($f_name)) { array_push($errors, "First Name is required"); }
  if (empty($m_name)) { array_push($errors, "Middle Name is required"); }
  if (empty($last_name)) { array_push($errors, "Last Name is required"); }
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM tbl_user WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  // register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password);// encrypt the password before saving in the database

  	$query = "INSERT INTO tbl_user (f_name, m_name, last_name, username, password) 
  			  VALUES('$f_name', '$m_name', '$last_name', '$username', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "You are now registered";
  	header('location: ../login.php');
  }
}
?>