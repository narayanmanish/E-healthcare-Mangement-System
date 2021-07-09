



<?php
session_start();
if(!isset($_SESSION['patientid']))
{
  echo "<script>window.location='http://localhost/e-health/login_page.php';</script>";
}
else {
	
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM treatment_records WHERE appointmentid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('appointment record deleted successfully..');</script>";
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
		<?php include("header1.php");?>

		<div class="main">
			<?php include("header.php");?>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row mb-2 mb-xl-3">
											<div class="col-auto d-none d-sm-block">
							<h3><strong>Patient Account</strong> Treatment records</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Treatment records</a></li>
									
								</ol>
							</nav>
						</div>
					</div>
                 <div class="row">
                 	<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title text-center">View New treatment records</h5>
									
								</div>
								<table class="table table-bordered">




									<thead>
										<tr>
											<th style="width:40%;">Treatment type</th>
											<th style="width:25%">Patient</th>
											<th class="d-none d-md-table-cell" style="width:25%">Doctor</th>
											<th class="d-none d-md-table-cell" style="width:25%">Treatment Description</th>
											<th class="d-none d-md-table-cell" style="width:25%">Treatmentdate
</th>
											<th class="d-none d-md-table-cell" style="width:25%">Treatmenttime</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
		$sql ="SELECT * FROM treatment_records where status='Active'";
		if(isset($_SESSION[patientid]))
		{
			$sql = $sql . " AND patientid='$_SESSION[patientid]'"; 
		}
		if(isset($_SESSION[doctorid]))
		{
			$sql = $sql . " AND doctorid='$_SESSION[doctorid]'";
		}
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
			$qsqlpat = mysqli_query($con,$sqlpat);
			$rspat = mysqli_fetch_array($qsqlpat);
			
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
			$qsqldoc = mysqli_query($con,$sqldoc);
			$rsdoc = mysqli_fetch_array($qsqldoc);
			
			$sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$rs[treatmentid]'";
			$qsqltreatment = mysqli_query($con,$sqltreatment);
			$rstreatment = mysqli_fetch_array($qsqltreatment);
			
        echo "<tr>
          <td>&nbsp;$rstreatment[treatmenttype]</td>
		   <td>&nbsp;$rspat[patientname]</td>
		    <td>&nbsp;$rsdoc[doctorname]</td>
			<td>&nbsp;$rs[treatment_description]</td>
			 <td>&nbsp;$rs[treatment_date]</td>
			  <td>&nbsp;$rs[treatment_time]</td>";  
	
       echo " </tr>";
		}
	}
		?>
									
									</tbody>
								</table>
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