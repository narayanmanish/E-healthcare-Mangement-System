

<?php
session_start();
if(!isset($_SESSION['patientid']))
{
  echo "<script>window.location='http://localhost/e-health/login_page.php';</script>";
}
else
{

include("dbconnection.php");
$dt = date("Y-m-d");
		$tim = date("H:i:s");
if(isset($_POST['submit']))
{
	if(isset($_SESSION['patientid']))
	{
		$lastinsid =$_SESSION['patientid'];
	}
	else
	{
		
		$sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,city,mobileno,loginid,password,gender,dob,status) values('$_POST[patiente]','$dt','$tim','$_POST[textarea]','$_POST[city]','$_POST[mobileno]','$_POST[loginid]','$_POST[password]','$_POST[select6]','$_POST[dob]','Pending')";
		if($qsql = mysqli_query($con,$sql))
		{
			/* echo "<script>alert('patient record inserted successfully...');</script>"; */
		}
		else
		{
			echo mysqli_error($con);
		}
		$lastinsid = mysqli_insert_id($con);
	}
	
	$sqlappointment="SELECT * FROM appointment WHERE appointmentdate='$_POST[appointmentdate]' AND appointmenttime='$_POST[appointmenttime]' AND doctorid='$_POST[doct]' AND status='Approved'";
	$qsqlappointment = mysqli_query($con,$sqlappointment);
	if(mysqli_num_rows($qsqlappointment) >= 1)
	{
		echo "<script>alert('Appointment already scheduled for this time..');</script>";
	}
	else
	{
		$sql ="INSERT INTO appointment(appointmenttype,patientid,appointmentdate,appointmenttime,app_reason,status,departmentid,doctorid) values('ONLINE','$lastinsid','$_POST[appointmentdate]','$_POST[appointmenttime]','$_POST[app_reason]','Pending','$_POST[department]','$_POST[doct]')";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Appointment record inserted successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
if(isset($_SESSION['patientid']))
{
$sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
$qsqlpatient = mysqli_query($con,$sqlpatient);
$rspatient = mysqli_fetch_array($qsqlpatient);
$readonly = " readonly";
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
							<h3><strong>Patient Account</strong> Appointment</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Appointment</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">Add Appointment</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h2 class="card-title text-center">Add New Appointment</h2>
									<hr>
								</div>
								<div class="card-body">
									 <?php
if(isset($_POST[submit]))
{
	if(mysqli_num_rows($qsqlappointment) >= 1)
	{		
			echo "<h2>Appointment already scheduled for ". date("d-M-Y", strtotime($_POST[appointmentdate])) . " " . date("H:i A", strtotime($_POST[appointmenttime])) . " .. </h2>";
	}
	else
	{
		if(isset($_SESSION[patientid]))
		{
			echo "<h2>Appointment taken successfully.. </h2>";
			echo "<p>Appointment record is in pending process. Kinldy check the appointment status. </p>";
			echo "<p> <a href='viewappointment.php'>View Appointment record</a>. </p>";			
		}
		else
		{
			echo "<h2>Appointment taken successfully.. </h2>";
			echo "<p>Appointment record is in pending process. Please wait for confirmation message.. </p>";
			echo "<p> <a href='http://localhost/e-health/login_page.php'>Click here to Login</a>. </p>";	
		}
	}
}
else
{
 ?>
									<form method="post" action="" name="frmpatapp" onSubmit="return validateform()">
										<div class="row">

											<div class="mb-3 col-md-4">
												<label class="form-label" for="patiente">Patient Name</label>
												<input type="text" class="form-control" name="patiente" id="patiente" value="<?php echo $rspatient[patientname];  ?>"  <?php echo $readonly; ?>>
											</div>
											<div class="mb-3 col-md-4">
												
												<label class="form-label" for="textarea">Address</label>
												<input type="text" class="form-control" name="textarea" id="textarea" value="<?php echo $rspatient[address];  ?>" <?php echo $readonly; ?>>
											</div>
										
										<div class="mb-3 col-md-4">
											
											<label class="form-label" for="city">City</label>
											<input type="text" class="form-control" name="city" id="city" value="<?php echo $rspatient[city];  ?>" <?php echo $readonly; ?>>
										</div>
										<div class="mb-3 col-md-4" >
											
											<label class="form-label" for="mobileno">Mobile no</label>
											<input type="text" class="form-control" name="mobileno" id="mobileno" value="<?php echo $rspatient[mobileno];  ?>" <?php echo $readonly; ?>  >
										</div>
										
											  
											<div class="mb-3 col-md-4">
												<label class="form-label" for="dob">DOB</label>
												<input type="date" name="dob" id="dob" class="form-control" value="<?php echo $rspatient[dob]; ?>" <?php echo $readonly; ?>>
											</div>
											 
         
											<div class="mb-3 col-md-4">
												<label class="form-label" name="select6" id="select6">Gender</label>
												<?php 
		  if(isset($_SESSION[patientid]))
		  {
			  echo $rspatient[gender];
		 ?>
             
												<select id="select6" class="form-control">
                                                   <?php
             
                    echo "<option selected value='$rspatient[gender];'>$rspatient[gender]</option>";
                }
                ?>
                                                 </select>
                                                 
											</div>

											<div class="mb-3 col-md-4">
												<label class="form-label" for="appointmentdate">Enter Appointment Date</label>
												<input type="date" class="form-control" name="appointmentdate" id="appointmentdate" min="<?php echo date("Y-m-d"); ?>"  required>
											</div>
										
										 
										<div class="mb-3 col-md-4">
											<label class="form-label" for="appointmenttime">Enter Appointment Time</label>
											<input type="time" class="form-control" name="appointmenttime" id="appointmenttime" required>
										</div>
										<div class="mb-3 col-md-4">
											
												<label class="form-label" for="department">Department</label>
												<select  class="form-control"  name="department" id="department" onchange="loaddoctor(this.value)" required>
                <option value="">Select department</option>
                 <?php
		  	$sqldept = "SELECT * FROM department WHERE status='Active'";
			$qsqldept = mysqli_query($con,$sqldept);
			while($rsdept = mysqli_fetch_array($qsqldept))
			{
			echo "<option value='$rsdept[departmentid]'>$rsdept[departmentname]</option>";
			}
		  ?>
              </select>
											</div>
											<div class="mb-3 col-md-4">
												
			
         
												<label class="form-label" for="doct">Doctors</label>
												<div  id="divdoc" >
												<select name="doct" id="doct" class="form-control" required>
                <option value="">Select doctor</option>
                 
              </select>                      </div>
											</div>
											<div class="mb-3 col-md-8">

												<label class="form-label" for="app_reason">Appointment reason</label>
												<input type="text" class="form-control" name="app_reason" required>
											</div>
										<div>
										<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
							</div>
							<?php
}
}
?>
						</div>

				</div class="clear">
			</main>

			<?php include("footer.php");?>
		</div>
	</div>

	<script src="js/app.js"></script>
<script type="text/javascript">

function loaddoctor(deptid)
{
	    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divdoc").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","departmentDoctor.php?deptid="+deptid,true);
        xmlhttp.send();
}
</script>
	

</body>

</html>