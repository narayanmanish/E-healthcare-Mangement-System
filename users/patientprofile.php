
<?php
session_start();
if(!isset($_SESSION['patientid']))
{
  echo "<script>window.location='http://localhost/e-health/login_page.php';</script>";
}
else
{
include("dbconnection.php");
if(isset($_POST['submit']))
{
		$sql ="UPDATE patient SET patientname='$_POST[patientname]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',city='$_POST[city]',pincode='$_POST[pincode]',loginid='$_POST[loginid]',bloodgroup='$_POST[select2]',gender='$_POST[select3]',dob='$_POST[dateofbirth]' WHERE patientid='$_SESSION[patientid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('patient record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
}
if(isset($_SESSION['patientid']))
{
	$sql="SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
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
		<?php include("header1.php");?>

		<div class="main">
			<?php include("header.php");?>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row mb-2 mb-xl-3">
											<div class="col-auto d-none d-sm-block">
							<h3><strong>Patient Account</strong> Profile</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Profile</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">View Profile</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title text-center">Patient Profile</h4>
									<h6 class="card-subtitle text-muted text-center">View Or Edit Patient Profile</h6>
									<hr>
								</div>
								<div class="card-body">
									
									<form method="post" action="" name="frmpatprfl" onSubmit="return validateform()">
										<div class="row">

											<div class="mb-3 col-md-4">
												<label class="form-label" for="patiente">Patient Name</label>
												<input type="text" class="form-control" name="patientname" id="patientname"  value="<?php echo $rsedit[patientname]; ?>">
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label" for="admissiondate">Admission Date</label>
												<input type="date" class="form-control" name="admissiondate" id="admissiondate" value="<?php echo $rsedit[admissiondate]; ?> ">
											</div>
										
										 
										<div class="mb-3 col-md-4">
											<label class="form-label" for="admissiontme">Admission Time</label>
											<input type="time" class="form-control" name="admissiontme" id="admissiontme" value="<?php echo $rsedit[admissiontime]; ?>">
										</div>
											<div class="mb-3 col-md-4">
												
												<label class="form-label" for="address">Address</label>
			
												<text name="address" id="address" class="form-control"> <?php echo $rsedit[address]; ?></text>
											</div>
										
										<div class="mb-3 col-md-4">
											
											<label class="form-label" for="city">City</label>
											<input type="text" class="form-control" name="city" id="city" value="<?php echo $rsedit[city]; ?>" >
										</div>
										<div class="mb-3 col-md-4" >
											
											<label class="form-label" for="pincode">PIN No</label>
											<input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>"  >
										</div>
										<div class="mb-3 col-md-4" >
											
											<label class="form-label" for="loginid">Login ID</label>
											<input type="text" class="form-control" name="loginid" id="loginid"  value="<?php echo $rsedit[loginid]; ?>"  >
										</div>
										<div class="mb-3 col-md-4" >
											
											<label class="form-label" for="mobileno">Mobile no</label>
											<input type="text" class="form-control" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>"  >
										</div>
										
											  
											<div class="mb-3 col-md-4">
												<label class="form-label" for="dateofbirth">DOB</label>
												<input type="date" class="form-control" name="dateofbirth" id="dateofbirth"  value="<?php echo $rsedit[dob]; ?>" >
											</div>
											<div class="mb-3 col-md-4">
											
												<label class="form-label" for="select2">Blood Group</label>
												<select name="select2" id="select2" class="form-control">
                                                       <option selected>Choose...</option>
                                                        <option value="">Select</option>
          <?php
		  $arr = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[bloodgroup])
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
											<div class="mb-3 col-md-4">

												<label class="form-label" for="inputState">Gender</label>
												<select name="select3" id="select3" class="form-control">
                <option selected>Select</option>
                <?php
		  $arr = array("MALE","FEMALE");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[gender])
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
							<?php
}

?>
						</div>

				</div class="clear">
			</main>

			<?php include("footer.php");?>
		</div>
	</div>

	<script src="js/app.js"></script>

	

</body>

</html>