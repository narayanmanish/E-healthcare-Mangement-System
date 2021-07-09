








<?php
error_reporting(0);
session_start();

include("dbconnection.php");
if(isset($_POST[submit]))
{
		if(isset($_GET[editid]))
		{
			$sql ="UPDATE appointment SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='$_POST[select]' WHERE appointmentid='$_GET[editid]'";
			if($qsql = mysqli_query($con,$sql))
			{
				echo "<script>alert('appointment record updated successfully...');</script>";
			}
			else
			{
				echo mysqli_error($con);
			}	
		}
		else
		{
			$sql ="UPDATE patient SET status='Active' WHERE patientid='$_POST[select4]'";
			$qsql=mysqli_query($con,$sql);
			
			$sql ="INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) values('$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]','$_POST[appreason]')";
			if($qsql = mysqli_query($con,$sql))
			{
				
				include("insertbillingrecord.php");	
				echo "<script>alert('Appointment record inserted successfully...');</script>";
				echo "<script>window.location='patientreport.php?patientid=$_POST[select4]';</script>";
			}
			else
			{
				echo mysqli_error($con);
			}
		}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
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
							<h3><strong>Admin Account</strong> Add New Appointment</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Patient</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">Add New Appointment</li>
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
									
									<form method="post" action="" name="frmappnt" onSubmit="return validateform()">
										<div class="row">

											<div class="mb-3 col-md-4">
												<label class="form-label" for="patiente">Patient Name</label>
												<?php
		  if(isset($_GET[patid]))
			{
				$sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patid]'";
				$qsqlpatient = mysqli_query($con,$sqlpatient);
				$rspatient=mysqli_fetch_array($qsqlpatient);
				echo $rspatient[patientname] . " (Patient ID - $rspatient[patientid])";
				echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
			}
			else
			{
		  ?>
                  <select class="form-control" name="select4" id="select4" required>
                    <option value="">Select</option>
                    <?php
                    $sqlpatient= "SELECT * FROM patient WHERE status='Active'";
                    $qsqlpatient = mysqli_query($con,$sqlpatient);
                    while($rspatient=mysqli_fetch_array($qsqlpatient))
                    {
                        if($rspatient[patientid] == $rsedit[patientid])
                        {
                        echo "<option value='$rspatient[patientid]' selected>$rspatient[patientid] - $rspatient[patientname]</option>";
                        }
                        else
                        {
                            echo "<option value='$rspatient[patientid]'>$rspatient[patientid] - $rspatient[patientname]</option>";
                        }
                        
                    }
                  ?>
                  </select>
          <?php
			}
		?>
											</div>
											<div class="mb-3 col-md-4">
												
												<label class="form-label" for="textarea">Department</label>
												 <select class="form-control" name="select5" id="select5" required>
           <option value="">Select</option>
            <?php
		  	$sqldepartment= "SELECT * FROM department WHERE status='Active'";
			$qsqldepartment = mysqli_query($con,$sqldepartment);
			while($rsdepartment=mysqli_fetch_array($qsqldepartment))
			{
				if($rsdepartment[departmentid] == $rsedit[departmentid])
				{
	echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
				}
				else
				{
  echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
				}
				
			}
		  ?>
          </select>
											</div>
										
										<div class="mb-3 col-md-4">
											
											<label class="form-label" for="city">Appointment Date</label>
											<input type="date" class="form-control" name="appointmentdate" id="appointmentdate" value="<?php echo $rsedit[appointmentdate]; ?>" required/>
										</div>
										<div class="mb-3 col-md-4">
												<label class="form-label" for="dob">Appointment Time</label>
												<input type="time" class="form-control" name="time" id="time" value="<?php echo $rsedit[appointmenttime]; ?>" required/>
											</div>
										<div class="mb-3 col-md-4" >
											
											<label class="form-label" for="mobileno">Doctor</label>
											<?php
		if(isset($_SESSION[doctorid]))
		{
			echo "<input type='hidden' name='select6' value='$_SESSION[doctorid]' >";
		}
		else
		{
		?>
       
          <select class="form-control" name="select6" id="select6" required>
            <option value="">Select</option>
            <?php
          	$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
			$qsqldoctor = mysqli_query($con,$sqldoctor);
			while($rsdoctor = mysqli_fetch_array($qsqldoctor))
			{
				if($rsdoctor[doctorid] == $rsedit[doctorid])
				{
				echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] ) </option>";
				}
				else
				{
				echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";				
				}
			}
		  ?>
          </select>
        <?php
		}
		?>
										</div>
										<div class="mb-3 col-md-4">
												<label class="form-label" for="dob">Appointment Reason</label>
												<input type="email" class="form-control" name="appreason" id="appreason" value="<?php echo $rsedit[app_reason]; ?>" required/>
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label" for="dob">Status</label>
												<select class="form-control" name="select" id="select" required>
         
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