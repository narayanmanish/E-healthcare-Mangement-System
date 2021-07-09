<?php
error_reporting(0);
include("dbconnection.php");

if(isset($_POST[submit]))
{
		if(isset($_GET[editid]))
		{
				$sql ="UPDATE patient SET status='Active' WHERE patientid='$_GET[patientid]'";
				$qsql=mysqli_query($con,$sql);
			$roomid=0;
			$sql ="UPDATE appointment SET appointmenttype='$_POST[apptype]',roomid='$_POST[select3]',departmentid='$_POST[select5]',doctorid='$_POST[select6]',status='Approved',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]' WHERE appointmentid='$_GET[editid]'";
			if($qsql = mysqli_query($con,$sql))
			{
				$roomid= $_POST[select3];
				$billtype = "Room Rent";
				include("insertbillingrecord.php");				
				echo "<script>alert('appointment record updated successfully...');</script>";				
				echo "<script>window.location='patientreport.php?patientid=$_GET[patientid]&appointmentid=$_GET[editid]';</script>";
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
				
			$sql ="INSERT INTO appointment(appointmenttype,patientid,roomid,departmentid,appointmentdate,appointmenttime,doctorid,status) values('$_POST[select2]','$_POST[select4]','$_POST[select3]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]')";
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
							<h3><strong>Doctor Account</strong> Appointment</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Appointment</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">Appointment record Approval Process</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h2 class="card-title text-center">Appointment record Approval Process</h2>
									<hr>
								</div>
								<div class="card-body">
									
									<form method="post" action="" name="frmappnt" onSubmit="return validateform()">
										<div class="row">

											<div class="mb-3 col-md-6">
												<?php
			if(isset($_GET[patientid]))
			{
				$sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patientid]'";
				$qsqlpatient = mysqli_query($con,$sqlpatient);
				$rspatient=mysqli_fetch_array($qsqlpatient);
				
				?>

												<label class="form-label" for="patiente">Patient</label>
												<input type="text" class="form-control" name="patiente" id="patiente" value="<?php echo $rspatient[patientname] . " (Patient ID - $rspatient[patientid])" ?>"  <?php echo $readonly; ?>>
												<?php
												}
			
			else
			{
				$sqlpatient= "SELECT * FROM patient WHERE status='Active'";
				$qsqlpatient = mysqli_query($con,$sqlpatient);
				while($rspatient=mysqli_fetch_array($qsqlpatient))
				{
					if($rspatient[patientid] == $rsedit[patientid])
					{
					echo "<option value='$rspatient[patientid]' selected> $rspatient[patientname](Patient ID - $rspatient[patientid])</option>";
					}
				}
			}
		  ?>
											</div>
                                           
											<div class="mb-3 col-md-6">
								
												<label class="form-label" name="select5" id="select6">Department</label>
			                                    <select name="select5" id="select5" class="form-control">
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

											<div class="mb-3 col-md-6">
							
											
												<label class="form-label" for="department">Doctor</label>
												<select  class="form-control"  name="select6" id="select6">
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
											</div>

                                          
        
											
										
										
										
											  
											
											 
         

											<div class="mb-3 col-md-6">
												<label class="form-label" for="appointmentdate">Appointment Date</label>
												<input type="date" class="form-control" value="<?php echo $rsedit[appointmentdate]; ?>"  name="appointmentdate" id="appointmentdate" >
											</div>
										
										 
										<div class="mb-3 col-md-6">
											<label class="form-label" for="appointmenttime">Appointment Time</label>
											<input type="time" class="form-control"  name="time" id="time" value="<?php echo $rsedit[appointmenttime]; ?>">
										</div>
										
											
											<div class="mb-3 col-md-6">

												<label class="form-label" for="app_reason">Appointment reason</label>
												<textarea name="appreason" id="appreason" class="form-control" ><?php echo $rsedit[app_reason]; ?></textarea>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

$('.out_patient').hide();
$('#apptype').change(function()
{
	apptype=$('#apptype').val();
	if(apptype=='InPatient')
	{
		$('.out_patient').show();
	}
	else
	{
		$('.out_patient').hide();
	}
});
</script>
	

</body>

</html>