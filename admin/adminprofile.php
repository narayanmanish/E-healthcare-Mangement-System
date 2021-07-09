




<?php
error_reporting(0);
session_start();


include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_SESSION[adminid]))
	{
			$sql ="UPDATE admin SET adminname='$_POST[adminname]',loginid='$_POST[loginid]',status='$_POST[select]' WHERE adminid='$_SESSION[adminid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('admin record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO admin(adminname,loginid,status) values('$_POST[adminname]','$_POST[loginid]','$_POST[select]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Administrator record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_SESSION[adminid]))
{
	$sql="SELECT * FROM admin WHERE adminid='$_SESSION[adminid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
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
							<h3><strong>Admin Account</strong> View and Update Administrator Profile</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Profile</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">View and Update Administrator Profile</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="row mb-2 mb-xl-3">
						<div class="col-12 col-xl-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title text-center">View and Update Administrator Profile</h5>
							         <hr>
								</div>
								<div class="card-body">
									<form method="post" action="" name="frmadminprofile" onSubmit="return validateform()">
										
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right">Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="adminname" id="adminname" value="<?php echo $rsedit[adminname]; ?>" />
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right">Email</label>
											<div class="col-sm-10">
												<input type="email" class="form-control" name="loginid" id="loginid"value="<?php echo $rsedit[loginid]; ?>" />
											</div>
										</div>
										<div class="mb-3 row">
											
											<label class="col-form-label col-sm-2 text-sm-right">Status</label>
											<div class="col-sm-10">
												<select class="form-control" name="select" id="select">
													 <option value="">Select</option>
          <?php
		  $arr = array("Active","Inactive");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[status])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
          </select>
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