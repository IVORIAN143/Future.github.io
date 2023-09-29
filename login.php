<?php
session_start();
if (isset($_SESSION['auth'])) {
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'template/header.php';
?>

<!-- Login -->

<body class="app app-login p-0">
	<div class="row g-0 app-auth-wrapper">
		<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
			<div class="d-flex flex-column align-content-end">
				<div class="app-auth-body mx-auto">
					<div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="img/isu-logo.ico" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Log in to eHealth Mate</h2>
					<div class="auth-form-container text-start">
						<form class="user" id="loginForm">
							<div class="form-group">
								<input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
								<input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox small">
									<input type="checkbox" class="custom-control-input" id="customCheck">
									<label class="custom-control-label" for="customCheck">Remember Me</label>
								</div>
							</div>
							<center>
								<button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
							</center>
							<hr>
						</form>
						<div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="register.php">here</a>.</div>
					</div><!--//auth-form-container-->

				</div><!--//auth-body-->
			</div><!--//flex-column-->

			<?php
			include 'template/scripts.php';
			include 'partials/footer.php'
			?>
		</div><!--//auth-main-col-->
		<div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
			<div class="auth-background-holder">
			</div>
			<div class="auth-background-mask"></div>
			<div class="auth-background-overlay p-3 p-lg-5">
				<div class="d-flex flex-column align-content-end h-100">
					<div class="h-100"></div>
					<!-- <div class="overlay-content p-3 p-lg-4 rounded">
					    <h5 class="mb-3 overlay-title">Explore Portal Admin Template</h5>
					    <div>Portal is a free Bootstrap 5 admin dashboard template. You can download and view the template license <a href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">here</a>.</div>
				    </div> -->
				</div>
			</div><!--//auth-background-overlay-->
		</div><!--//auth-background-col-->

	</div><!--//row-->

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$('#loginForm').on('submit', function(e) {
			e.preventDefault();
			let formData = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: 'config/Check_Login.php',
				data: formData,
				dataType: 'json',
				success: function(response) {
					console.log(response);
					if (response.status === true) {
						location.reload();
					} else {
						alert(response.message);
					}
				}
			});
		});
	</script>
</body>

</html>