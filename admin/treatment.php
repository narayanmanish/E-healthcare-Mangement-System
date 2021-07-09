








<?php
error_reporting(0);
session_start();

include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE treatment SET treatmenttype='$_POST[treatmenttype]',treatment_cost='$_POST[treatmentcost]',note='$_POST[textarea]',status='$_POST[select]' WHERE treatmentid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('treatment record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO treatment(treatmenttype,treatment_cost,note,status) values('$_POST[treatmenttype]','$_POST[treatmentcost]', '$_POST[textarea]','$_POST[select]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('treatment record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM treatment WHERE treatmentid='$_GET[editid]' ";
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
							<h3><strong>Admin Account</strong> Add New treatment</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Doctor</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">Add New treatmentt</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h2 class="card-title text-center">Add New treatment</h2>
									<hr>
								</div>
								<div class="card-body">
									
									<form method="post" action="" name="frmtreat" onSubmit="return validateform()">
										<div class="row">

											<div class="mb-3 col-md-12">
												<label class="form-label" for="patiente">Treatment type</label>
												<input type="text" class="form-control" name="treatmenttype" id="treatmenttype"  value="<?php echo $rsedit[treatmenttype]; ?>" required/> 
											</div>
											<div class="mb-3 col-md-12">
												<label class="form-label" for="patiente">Treatment cost</label>
												<input type="text" class="form-control"name="treatmentcost" id="treatmentcost"  value="<?php echo $rsedit[treatment_cost]; ?>" required/> 
											</div>
											<div class="mb-3 col-md-12">
												
												<label class="form-label" for="textarea">Note</label>
												<textarea name="textarea" class="form-control" id="textarea" required><?php echo $rsedit[note] ; ?></textarea>
											</div>
										
										
											<div class="mb-3 col-md-12">

												<label class="form-label" for="app_reason">Status</label>
												<select class="form-control" name="select" id="select" required>
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