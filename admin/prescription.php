

<?php
session_start();
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE prescription SET treatment_records_id='$_POST[treatmentid]',doctorid='$_POST[select2]',patientid='$_POST[patientid]',prescriptiondate='$_POST[date]',status='$_POST[select]' WHERE prescription_id='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('prescription record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO prescription(treatment_records_id,doctorid,patientid,prescriptiondate,status,appointmentid) values('$_POST[treatmentid]','$_POST[select2]','$_POST[patientid]','$_POST[date]','Active','$_GET[appid]')";
		if($qsql = mysqli_query($con,$sql))
		{
			$insid= mysqli_insert_id($con);
			$prescriptionid= $insid;
			$prescriptiondate= $_POST['date'];
			$billtype="Prescription charge";
			$billamt=0;
			include("insertbillingrecord.php");	
			echo "<script>alert('prescription record inserted successfully...');</script>";
			echo "<script>window.location='prescriptionrecord.php?prescriptionid=" . $insid . "&patientid=$_GET[patientid]&appid=$_GET[appid]';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM prescription WHERE prescriptionid='$_GET[editid]' ";
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
							<h3><strong>Doctor Account</strong> Add New Prescription</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Doctor Account</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">Add New Prescription</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="row mb-2 mb-xl-3">
						<div class="col-12 col-xl-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title text-center">Add New Prescription </h5>
							         <hr>
								</div>
								<div class="card-body">
									<form method="post" action="" name="frmpres" onSubmit="return validateform()">
     <input type="hidden" name="patientid" value="<?php echo $_GET[patientid]; ?>"  />
     <input type="hidden" name="treatmentid" value="<?php echo $_GET[treatmentid]; ?>"  />
     <input type="hidden" name="appid" value="<?php echo $_GET[appid]; ?>"  />
										
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right">Patient</label>
											<div class="col-sm-10">
												 <?php
		  	$sqlpatient= "SELECT * FROM patient WHERE status='Active' AND patientid='$_GET[patientid]'";
			$qsqlpatient = mysqli_query($con,$sqlpatient);
			while($rspatient=mysqli_fetch_array($qsqlpatient))
			{
			?>
												<input type="text" class="form-control" value="<?php echo( $rspatient[patientid]."-". $rspatient[patientname]) ?>">
												<?php
												}
		                                         ?>
											</div>
										</div>
										<div class="mb-3 row">
											 <?php
		if(isset($_SESSION['doctorid']))
		{
		?><label class="col-form-label col-sm-2 text-sm-right">Doctor</label>
          <div class="col-sm-10">
    		<?php
				$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active' AND doctor.doctorid='$_SESSION[doctorid]'";
				$qsqldoctor = mysqli_query($con,$sqldoctor);
				while($rsdoctor = mysqli_fetch_array($qsqldoctor))
				{
					?>
					
					<input type="text" class="form-control"  value="<?php echo($rsdoctor[doctorname]." (". $rsdoctor[departmentname].")") ?>" >
					<?php
				}
				?>
                <input type="hidden" name="select2" value="<?php echo $_SESSION[doctorid]; ?>"  />
                </div>
        <?php
		}
			?>							
											
												
											
										</div>
										
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right">Date</label>
											<div class="col-sm-10">
												<input type="date" class="form-control" name="date" id="date" value="<?php echo $rsedit[prescriptiondate]; ?>" required>
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
	<script type="text/javascript">

	</script>
</body>

</html>