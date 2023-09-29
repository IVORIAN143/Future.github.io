<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header('location: login.php');
}
include 'config/db_config.php';
include 'template/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['Firstname'];
    $middlename = $_POST['Middlename'];
    $lastname = $_POST['Lastname'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // INSERT query using PDO
    try {
        $insertQuery = "INSERT INTO tbl_user (firstname, middlename, lastname, role, username, password) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($insertQuery);
        $stmt->execute([$firstname, $middlename, $lastname, $role, $username, $password]);

        session_start();
        $_SESSION['message'] = "Account added successfully!";
        header('Location: user.php'); // Redirect to the inventory page
        exit();
    } catch (PDOException $e) {
        session_start();
        $_SESSION['message'] = "Error: " . $e->getMessage();
        header('Location: user.php'); // Redirect to the inventory page with an error message
        exit();
    }
}
?>

<body class="app">
    <header class="app-header fixed-top">
        <?php
        include 'partials/header.php';
        include 'partials/sidebar.php';
        ?>
    </header><!--//app-header-->

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">

                    <!-- KEEP THIS TO MAKE IT CLEAN -->
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0"></h1>
                    </div>
                    <!-- KEEP THIS TO MAKE IT CLEAN -->

                </div><!--//row-->

                <h1 class="app-page-title">User</h1>
                <?php
                include 'card-monitoring\card-user.php';
                ?>
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0"></h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>

                                </div><!--//col-->
                                <div class="col-auto">

                                    <select class="form-select w-auto">
                                        <option selected value="option-1">All</option>
                                        <option value="option-2">This week</option>
                                        <option value="option-3">This month</option>
                                        <option value="option-4">Last 3 months</option>

                                    </select>
                                </div>


                                <div class="col-auto">
                                    <button type="button" class="btn app-btn-secondary" id="showAddStudentModal" data-toggle="modal" data-target="#add_user">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                            <path fill-rule="evenodd" d="M8 1a1 1 0 0 1 1 1v6h6a1 1 0 0 1 0 2H9v6a1 1 0 0 1-2 0V9H1a1 1 0 0 1 0-2h6V2a1 1 0 0 1 1-1z" />
                                        </svg>
                                        Add User
                                    </button>
                                </div>

                            </div><!--//row-->
                        </div><!--//table-utilities-->
                    </div><!--//col-auto-->
                </div><!--//row-->
              <?php
              include 'search_area/search_for_user.php';
              ?>
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->


    <?php
    include 'modal/logout.php';
    include 'template/scripts.php';
    ?>


</body>

<div class="row">
    <!-- Import Modal -->
    <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="add_studentModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                include 'register.php';
                ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

