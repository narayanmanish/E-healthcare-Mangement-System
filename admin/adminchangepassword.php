



<?php
error_reporting(0);
session_start();

include("dbconnection.php");
if(isset($_POST[submit]))
{
	$sql = "UPDATE admin SET password='$_POST[newpassword]' WHERE password='$_POST[oldpassword]' AND adminid='$_SESSION[adminid]'";
	$qsql= mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password has been updated successfully..');</script>";
	}
	else
	{
		echo "<script>alert('Failed to update password...');</script>";		
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link href="img/fav.png" rel="icon">

	<title>E-healthcare</title>

	<link href="css/app.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<?php include("menu.php");?>

		<div class="main">
			<?php include("header.php");?>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row mb-2 mb-xl-3">
											<div class="col-auto d-none d-sm-block">
							<h3><strong>Admin Account</strong> Change Password</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Profile</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">Change Password</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="row mb-2 mb-xl-3">
						<div class="col-12 col-xl-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title text-center">Change Password </h5>
							         <hr>
								</div>
								<div class="card-body">
									<form method="post" action="" name="frmadminchange" onSubmit="return validateform1()">
										
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right">Old Password</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Old Password" required>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right">new Password</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password" required>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right">Confirm Password</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="password" id="password" placeholder="Confirm Password" required>
											</div>
										</div>
										
										
										
											
										<div class="mb-3 row">
											<div class="col-sm-10 ml-sm-auto">
												<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<?php include("footer.php");?>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>
