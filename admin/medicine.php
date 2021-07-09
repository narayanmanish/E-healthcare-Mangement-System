










<?php
error_reporting(0);
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE medicine SET medicinename='$_POST[medicinename]',medicinecost='$_POST[medicinecost]',description='$_POST[description]',status='$_POST[status]' WHERE medicineid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Medicine record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO medicine(medicinename,medicinecost,description,status) values('$_POST[medicinename]','$_POST[medicinecost]','$_POST[description]','$_POST[status]')";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Medicine record inserted successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM medicine WHERE medicineid='$_GET[editid]' ";
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
							<h3><strong>Admin Account</strong> Add New Medicine</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Doctor</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">Add New Medicine</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h2 class="card-title text-center">Add New Medicine</h2>
									<hr>
								</div>
								<div class="card-body">
									
									<form method="post" action="" name="frmmedicine" onSubmit="return validateform()">
										<div class="row">

											<div class="mb-3 col-md-12">
												<label class="form-label" for="patiente">Medicine name</label>
												<input type="text" class="form-control" name="medicinename" id="medicinename" value="<?php echo $rsedit[medicinename]; ?>" required/> 
											</div>
											<div class="mb-3 col-md-12">
												<label class="form-label" for="patiente">Medicine cost</label>
												<input type="text" class="form-control"  name="medicinecost" id="medicinecost" value="<?php echo $rsedit[medicinecost]; ?>" required/> 
											</div>
											<div class="mb-3 col-md-12">
												
												<label class="form-label" for="textarea">Description</label>
												<textarea name="description" class="form-control" id="description" ><?php echo $rsedit[description] ; ?></textarea>
											</div>
										
										
											<div class="mb-3 col-md-12">

												<label class="form-label" for="app_reason">Status</label>
												<select class="form-control" name="status" id="status" required>
            <option value="">Select</option>
            <?php
		  $arr= array("Active","Inactive");
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
										<div>
										<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
							</div>
							
						</div>

				</div class="clear">
			</main>

			<?php include("footer.php");?>
		</div>
	</div>

	<script src="js/app.js"></script>


</body>

</html>