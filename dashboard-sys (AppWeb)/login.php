<?php
session_start();
$message = "";
require_once "config.php";
if (count($_POST) > 0) {
	$result = mysqli_query($link, "SELECT * FROM login_user WHERE user_name='" . $_POST["user_name"] . "' and password = '" . $_POST["password"] . "'");
	$row  = mysqli_fetch_array($result);
	if (is_array($row)) {
		$_SESSION["id"] = $row['id'];
		$_SESSION["name"] = $row['name'];
	} else {
		$message = "Invalid Username or Password!";
	}
}
if (isset($_SESSION["id"])) {
	header("Location:index.php");
}
?>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login </h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="fa fa-user-o"></span>
						</div>
						<h3 class="text-center mb-4">Sign In</h3>
						<form action="" class="login-form" name="frmUser" method="post">
							<div class="form-group">
								<input type="text" class="form-control rounded-left" placeholder="Username" name="user_name" required>
							</div>
							<div class="form-group d-flex">
								<input type="password" class="form-control rounded-left" placeholder="Password" name="password" required>
							</div>
							<div class="form-group">
								<button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
							</div>
							<div class="form-group d-md-flex">
								<div class="w-50">
									<label class="checkbox-wrap checkbox-primary">Remember Me
										<input type="checkbox" checked>
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#">Forgot Password</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>