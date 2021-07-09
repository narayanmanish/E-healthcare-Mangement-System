



<?php
error_reporting(0);
session_start();
$dt = date("Y-m-d");
		$tim = date("H:i:s");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE patient SET patientname='$_POST[patientname]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',city='$_POST[city]',pincode='$_POST[pincode]',loginid='$_POST[loginid]',password='$_POST[password]',bloodgroup='$_POST[select2]',gender='$_POST[select3]',dob='$_POST[dateofbirth]',status='$_POST[select]' WHERE patientid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('patient record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,mobileno,city,pincode,loginid,password,bloodgroup,gender,dob,status) values('$_POST[patientname]','$dt','$tim','$_POST[address]','$_POST[mobilenumber]','$_POST[city]','$_POST[pincode]','$_POST[loginid]','$_POST[password]','$_POST[select2]','$_POST[select3]','$_POST[dateofbirth]','Active')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('patients record inserted successfully...');</script>";
		$insid= mysqli_insert_id($con);
		if(isset($_SESSION[adminid]))
		{
		echo "<script>window.location='appointment.php?patid=$insid';</script>";	
		}
		else
		{
		echo "<script>window.location='patientlogin.php';</script>";	
		}		
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
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
							<h3><strong>Admin Account</strong> Add New Patient</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Patient</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">Add New Patient</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h2 class="card-title text-center">Add New Patient</h2>
									<hr>
								</div>
								<div class="card-body">
									
									<form method="post" action="" name="frmpatient" onSubmit="return validateform()">
										<div class="row">

											<div class="mb-3 col-md-4">
												<label class="form-label" for="patiente">Patient Name</label>
												<input type="text" class="form-control" name="patientname" id="patientname"  value="<?php echo $rsedit[patientname]; ?>" required>
											</div>
											<div class="mb-3 col-md-4">
												
												<label class="form-label" for="textarea">Address</label>
												<input type="text" class="form-control" name="address" id="address" value="<?php echo $rsedit[address]; ?>" required/>
											</div>
										
										<div class="mb-3 col-md-4">
											
											<label class="form-label" for="city">City</label>
											<input type="text" class="form-control" name="city" id="city" value="<?php echo $rsedit[city]; ?>" required>
										</div>
										<div class="mb-3 col-md-4">
												<label class="form-label" for="dob">Pin Code</label>
												<input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>" required/>
											</div>
										<div class="mb-3 col-md-4" >
											
											<label class="form-label" for="mobileno">Mobile no</label>
											<input type="text" class="form-control" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>" required  >
										</div>
										<div class="mb-3 col-md-4">
												<label class="form-label" for="dob">Email</label>
												<input type="email" class="form-control" name="loginid" id="loginid"  value="<?php echo $rsedit[loginid];?>" required/>
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label" for="dob">Password</label>
												<input type="password" class="form-control" name="password" id="password" value="<?php echo $rsedit[password]; ?>" required/>
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label" for="confirmpassword">confirm password</label>
												<input type="password" class="form-control" name="confirmpassword" id="confirmpassword"  value="<?php echo $rsedit[confirmpassword]; ?>" required/>
											</div>
											  
											
											 
         
											

											
										<div class="mb-3 col-md-4">
											
												<label class="form-label" for="department">Blood Group</label>
												<select class="form-control" name="select2" id="select2" required>
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
												
			
         
												<label class="form-label" for="doct">Gender</label>
												<select class="form-control" name="select3" id="select3" required>
           <option value="">Select</option>
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
											<div class="mb-3 col-md-8">

												<label class="form-label" for="app_reason">DOB</label>
												<input type="date" class="form-control" name="dateofbirth" max="<?php echo date("Y-m-d"); ?>" id="dateofbirth"  value="<?php echo $rsedit[dob]; ?>" required/>
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