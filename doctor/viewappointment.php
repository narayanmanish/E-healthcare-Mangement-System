




<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['doctorid']))
{
  echo "<script>window.location='doctorlogin.php';</script>";
}
else
{

include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM appointment WHERE appointmentid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('appointment record deleted successfully..');</script>";
	}
}
if(isset($_GET['approveid']))
{
	$sql ="UPDATE appointment SET status='Approved' WHERE appointmentid='$_GET[approveid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Appointment record Approved successfully..');</script>";
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
		<?php include("menu.php");?>

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
									
									<li class="breadcrumb-item active" aria-current="page">View Appointment</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="row mb-2 mb-xl-3">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title text-center">View Appointment records</h3>
									
									
								</div>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th style="width:30%;">Patient detail</th>
											<th style="width:25%">Appointment Date &  Time</th>
											<th class="d-none d-md-table-cell" style="width:25%">Department</th>
											<th class="d-none d-md-table-cell" style="width:25%">Doctor</th>
											<th class="d-none d-md-table-cell" style="width:25%">Reason</th>
											<th class="d-none d-md-table-cell" style="width:25%">Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										
										<?php
		$sql ="SELECT * FROM appointment WHERE (status !='')";
		if(isset($_SESSION[patientid]))
		{
			$sql  = $sql . " AND patientid='$_SESSION[patientid]'";
		}
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
			$qsqlpat = mysqli_query($con,$sqlpat);
			$rspat = mysqli_fetch_array($qsqlpat);
			
			
			$sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]'";
			$qsqldept = mysqli_query($con,$sqldept);
			$rsdept = mysqli_fetch_array($qsqldept);
		
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
			$qsqldoc = mysqli_query($con,$sqldoc);
			$rsdoc = mysqli_fetch_array($qsqldoc);
        echo "<tr>
          <td>&nbsp;$rspat[patientname]<br>&nbsp;$rspat[mobileno]</td>		 
			 <td>&nbsp;" . date("d-M-Y",strtotime($rs[appointmentdate])) . " &nbsp; " . date("H:i A",strtotime($rs[appointmenttime])) . "</td> 
		    <td>&nbsp;$rsdept[departmentname]</td>
			   <td>&nbsp;$rsdoc[doctorname]</td>
			    <td>&nbsp;$rs[app_reason]</td>
			    <td>&nbsp;$rs[status]</td>
          <td class='table-action'><div align='center'>";
		  if($rs[status] != "Approved")
		  {
				  if(!(isset($_SESSION[patientid])))
				  {
						  echo "<a href='appointmentapproval.php?editid=$rs[appointmentid]'>Approve</a><hr>";
				  }
				 echo "  <a href='viewappointment.php?delid=$rs[appointmentid]'><i class='align-middle' data-feather='trash'></i></a>";
		  }
		  else
		  {
				echo "<a href='patientreport.php?patientid=$rs[patientid]&appointmentid=$rs[appointmentid]'><i class='align-middle' data-feather='eye'></i></a>";
		  }
		 echo "</center></td></tr>";
		}
	}
		?>
										
										
									</tbody>
								</table>
							</div>
						</div>
                          <div class="clear"></div>
					</div>

				</div>
			</main>

			<?php include("footer.php");?>
		</div>
	</div>

	<script src="js/app.js"></script>

	
		
</body>

</html>