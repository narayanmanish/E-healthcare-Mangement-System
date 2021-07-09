
<?php
error_reporting(0);
session_start();

include("dbconnection.php");
if(isset($_POST[submit]))
{
	$filename = rand(). $_FILES[uploads][name];
	move_uploaded_file($_FILES["uploads"]["tmp_name"],"treatmentfiles/".$filename);
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE treatment_records SET appointmentid='$_POST[select2]',treatmentid='$_POST[select4]',patientid='$_POST[patientid]',doctorid='$_POST[select5]',treatment_description='$_POST[textarea]',uploads='$filename',treatment_date='$_POST[treatmentdate]',treatment_time='$_POST[treatmenttime]',status='Active' WHERE appointmentid='$_GET[editid]'";
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
		$sql ="INSERT INTO treatment_records(appointmentid,treatmentid,patientid,doctorid,treatment_description,uploads,treatment_date,treatment_time,status) values('$_POST[select2]','$_POST[select4]','$_POST[patientid]','$_POST[select5]','$_POST[textarea]','$filename','$_POST[treatmentdate]','$_POST[treatmenttime]','Active')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con)>=1)
		{
			echo "<script>alert('Treatment record inserted successfully...');</script>";
		}
	$doctorid= $_POST[select5];
	$billtype = "Doctor Charge";
	
	$treatmentid= $_POST[select4];
	$billtype1="Treatment Cost";
	include("insertbillingrecord.php");	
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM treatment_records WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
if(isset($_GET[delid]))
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
		<?php include("menu.php");?>

		<div class="main">
			<?php include("header.php");?>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row mb-2 mb-xl-3">
											<div class="col-auto d-none d-sm-block">
							<h3><strong>Doctor Account</strong> Add New treatment records</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Add New treatment records</a></li>
									
								</ol>
							</nav>
						</div>
					</div>
                 







					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h2 class="card-title text-center">Add New treatment records</h2>
									<hr>
								</div>
								<div class="card-body">
									
									<form method="post" action="" name="frmtreatrec" onSubmit="return validateform()" enctype="multipart/form-data">
										 <input type="hidden" name="prescriptionid" value="<?php echo $_GET[prescriptionid]; ?>"  />
										<div class="row">
											<div class="mb-3 col-md-6">

												
												<label class="form-label" for="select2">Appointment</label>
												<input type="text" class="form-control" readonly name="select2" value="<?php echo $_GET[appid]; ?>">
											</div>
											<div class="mb-3 col-md-6"><tr>
          
												<label class="form-label" for="patiente">Patient</label>
												 <input type="hidden" name="patientid" value="<?php echo $_GET[patientid]; ?>" />
												 <?php
                                               $sqlpatient= "SELECT * FROM patient WHERE status='Active' AND patientid='$_GET[patientid]'";
                                              $qsqlpatient = mysqli_query($con,$sqlpatient);
                                              $rspatient=mysqli_fetch_array($qsqlpatient);
                                               ?>	
												<input type="text" class="form-control" readonly name="select3" value="<?php echo $rspatient[patientname]; ?>">
											</div>
											<div class="mb-3 col-md-6">
												
				
												<label class="form-label" id="">Select Treatment type</label>
												
												<select class="form-control" name="select4" id="select4">
													<option value="">Select</option>
                                                   <?php
		  	$sqltreatment= "SELECT * FROM treatment WHERE status='Active'";
			$qsqltreatment = mysqli_query($con,$sqltreatment);
			while($rstreatment=mysqli_fetch_array($qsqltreatment))
			{
				if($rstreatment[treatmentid] == $rsedit[treatmentid])
				{
				echo "<option value='$rstreatment[treatmentid]' selected>$rstreatment[treatmenttype]  - (Rs. $rstreatment[treatment_cost])</option>";
				}
				else
				{
					echo "<option value='$rstreatment[treatmentid]'>$rstreatment[treatmenttype]  - (Rs. $rstreatment[treatment_cost])</option>";
				}
				
			}
		  ?>
                                                 </select>
                                                 
											</div>

											<div class="mb-3 col-md-6">
												<?php
		if(isset($_SESSION[doctorid]))
		{
		?>
												
												<label class="form-label" for="patiente">Doctor</label><tr>
          
    		<?php
				$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active' AND doctor.doctorid='$_SESSION[doctorid]'";
				$qsqldoctor = mysqli_query($con,$sqldoctor);
				while($rsdoctor = mysqli_fetch_array($qsqldoctor))
				{
				 ?>
					<input type="text" class="form-control" readonly value="<?php echo($rsdoctor[doctorname]."(". $rsdoctor[departmentname] .")") ?>" readonly >
					<?php
				}
				?>
                <input type="hidden" name="select5" value="<?php echo $_SESSION[doctorid]; ?>"  />
                  <?php
		}
		else
		{
		?>
        <tr>
          <td>Doctor</td>
          <td>
          <select name="select5" id="select5">
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
          </td>
        <?php
		}
		?>
												
											</div>
											
      
       
											<div class="mb-3 col-md-6">
												
												<label class="form-label" for="unit">Treatment Description</label>
												<textarea  name="textarea" class="form-control" id="textarea"><?php echo $rsedit[treatment_description] ; ?></textarea>
											</div>
										
										<div class="mb-3 col-md-6">
											
											<label class="form-label" for="totcost">Treatment files</label>
											<input type="file" class="form-control" name="uploads" id="uploads" value="<?php echo $rsedit[uploads]; ?>" />
										</div>
										<div class="mb-3 col-md-6">
											
											<label class="form-label" for="totcost">Treatment date</label>
											<input type="date" class="form-control" max="<?php echo date("Y-m-d"); ?>" name="treatmentdate" id="treatmentdate" value="<?php echo $rsedit[treatment_date]; ?>" />
										</div>
										<div class="mb-3 col-md-6">
											
											<label class="form-label" for="totcost">Treatment time</label>
											<input type="time" class="form-control" name="treatmenttime" id="treatmenttime" value="<?php echo $rsedit[treatment_time]; ?>" />
										</div>
							
        
										
											
											
										<div>
										<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
										<a href='patientreport.php?patientid=<?php echo $_GET[patientid]; ?>&appointmentid=<?php echo $_GET[appid]; ?>'><strong>View Patient Report>></strong></a>
										</div>
									</form>
									
								</div>
							</div>
						
						</div>

						
					</div>



					<div class="row">
                 	<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title text-center">View Prescription record</h5>
									
								</div>
								<table class="table table-bordered">




									<thead>
										<tr>
											<th width="71">Treatment type</th>
            <th width="78">Doctor</th>
            <th width="82">Treatment Description</th>
            <th width="103">Uploads</th>
            <th width="43">Treatment date</th>
            <th width="43">Treatment time</th>
            <th width="54">Status</th>
            <th width="58">Action</th>
										</tr>
									</thead>
									<tbody>
										 <?php
		$sql ="SELECT * FROM treatment_records WHERE patientid='$_GET[patientid]' AND appointmentid='$_GET[appid]' ";
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
		    <td>&nbsp;$rsdoc[doctorname]</td>
			<td>&nbsp;$rs[treatment_description]</td>
			<td>&nbsp;<a href='treatmentfiles/$rs[uploads]'>Download</a></td>
			 <td>&nbsp;$rs[treatment_date]</td>
			  <td>&nbsp;$rs[treatment_time]</td>
			    <td>&nbsp;$rs[status]</td>
          <td>&nbsp;
		  <a href='treatmentrecord.php?editid=$rs[appointmentid]&patientid=$_GET[patientid]&appid=$_GET[appid]'>Edit</a>| <a href='treatmentrecord.php?delid=$rs[appointmentid]&patientid=$_GET[patientid]&appointmentid=$_GET[appid]'>Delete</a> </td>
        </tr>";
		}
		?>
									
									</tbody>
								</table>
								<table>
	
							</div>
						</div>

                 	
                 </div>
					

				</div>
			</main>

			<?php include("footer.php");?>
		</div>
	</div>

	<script src="js/app.js"></script>
   
	
</script>
</body>

</html>