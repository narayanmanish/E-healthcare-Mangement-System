


<?php
error_reporting(0);

include("dbconnection.php");
if(isset($_GET['delid']))
{
	 $sql ="DELETE FROM prescription_records WHERE prescription_record_id='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
			echo "<script>window.location='prescriptionrecord.php?prescriptionid=$_GET[prescriptionid]';</script>";
		echo "<script>alert('prescription deleted successfully..');</script>";
	}
}
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
			$sql ="UPDATE prescription_records SET prescription_id='$_POST[prescriptionid]',medicine_name='$_POST[medicine]',cost='$_POST[cost]',unit='$_POST[unit]',dosage='$_POST[select2]',status=' $_POST[select]' WHERE prescription_record_id='$_GET[editid]'";
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
		$sql ="INSERT INTO prescription_records(prescription_id,medicine_name,cost,unit,dosage,status) values('$_POST[prescriptionid]','$_POST[medicineid]','$_POST[cost]','$_POST[unit]','$_POST[select2]','Active')";
		if($qsql = mysqli_query($con,$sql))
		{	
			$presamt=$_POST[cost]*$_POST[unit];
			$billtype = "Prescription update";
			$prescriptionid= $_POST[prescriptionid];
			include("insertbillingrecord.php");
			echo "<script>alert('prescription record inserted successfully...');</script>";
			echo "<script>window.location='prescriptionrecord.php?prescriptionid=$_GET[prescriptionid]&patientid=$_GET[patientid]&appid=$_GET[appid]';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM prescription_records WHERE prescription_record_id='$_GET[editid]' ";
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
							<h3><strong>Doctor Account</strong> Add New Prescription Record</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Add New Prescription Record</a></li>
									
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
											<th style="width:40%;">Doctor</th>
											<th style="width:25%">Patient</th>
											<th class="d-none d-md-table-cell" style="width:25%">Prescription date</th>
											<th class="d-none d-md-table-cell" style="width:25%">status</th>
											
											
											
										</tr>
									</thead>
									<?php
		$sql ="SELECT * FROM prescription WHERE prescriptionid='$_GET[prescriptionid]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpatient = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
			$qsqlpatient = mysqli_query($con,$sqlpatient);
			$rspatient = mysqli_fetch_array($qsqlpatient);
			
			
		$sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
			$qsqldoctor = mysqli_query($con,$sqldoctor);
			$rsdoctor = mysqli_fetch_array($qsqldoctor);
			
        echo "<tr>
          <td>&nbsp;$rsdoctor[doctorname]</td>
          <td>&nbsp;$rspatient[patientname]</td>
		   <td>&nbsp;$rs[prescriptiondate]</td>
		<td>&nbsp;$rs[status]</td>
		
        </tr>";
		}
		?>
									<tbody>
										
									
									</tbody>
								</table>
							</div>
						</div>

                 	
                 </div>











					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h2 class="card-title text-center">Add New Prescription Record</h2>
									<hr>
								</div>
								<div class="card-body">
									 <?php
			if(!isset($_SESSION['patientid']))
			{
		  ?>  
									<form  method="post" action="" name="frmpresrecord" onSubmit="return validateform()">
										 <input type="hidden" name="prescriptionid" value="<?php echo $_GET[prescriptionid]; ?>"  />
										<div class="row">
											<div class="mb-3 col-md-6">
				
												<label class="form-label" id="medicineid">Medicine</label>
												
												<select class="form-control"name="medicineid" id="medicineid" onchange="loadmedicine(this.value)">
													<option value="">Select Medicine</option>
                                                   <?php
		$sqlmedicine ="SELECT * FROM medicine WHERE status='Active'";
		$qsqlmedicine = mysqli_query($con,$sqlmedicine);
		while($rsmedicine = mysqli_fetch_array($qsqlmedicine))
		{
			echo "<option value='$rsmedicine[medicineid]'>$rsmedicine[medicinename] ( ₹ $rsmedicine[medicinecost] )</option>";
		}
		?>
                                                 </select>
                                                 
											</div>

											<div class="mb-3 col-md-6">
												
												<label class="form-label" for="patiente">Cost</label>
												<input type="text" class="form-control" name="cost" id="cost" value="<?php echo $rsedit[cost]; ?>" readonly style="background-color:pink;">
											</div>

       
											<div class="mb-3 col-md-6">
												
												<label class="form-label" for="unit">Unit</label>
												<input type="number" class="form-control"  min="1" name="unit" id="unit" value="<?php echo $rsedit[unit]; ?>" onkeyup="calctotalcost(cost.value,this.value)" onchange="">
											</div>
										
										<div class="mb-3 col-md-6">
											
											<label class="form-label" for="totcost">Total Cost</label>
											<input type="text" class="form-control" name="totcost" id="totcost" value="<?php echo $rsedit[cost]; ?>" readonly style="background-color:pink;">
										</div>
							
        
										<div class="mb-3 col-md-6">
											
												<label class="form-label" for="department">Dosage</label>
												<select  class="form-control"  name="select2" id="select2" required>
                <option value="">Select</option>
                <?php
		  $arr = array("0-0-1","0-1-1","1-0-1","1-1-1","1-1-0","0-1-0","1-0-0");
		  foreach($arr as $val)
		  {
			 if($val == $rsedit[dosage])
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
									<?php
			}
		?>
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
											<th style="width:40%;">Medicine</th>
											<th style="width:25%">Dosage</th>
											<th class="d-none d-md-table-cell" style="width:25%">Cost</th>
											<th class="d-none d-md-table-cell" style="width:25%">Unit</th>
											<th class="d-none d-md-table-cell" style="width:25%">Totol Cost
</th>
											 <?php
			if(!isset($_SESSION['patientid']))
			{
		  ?>  
          <td><strong>Action</strong></td>
          <?php
			}
			?>
										</tr>
									</thead>
									<tbody>
										 <?php
		 $gtotal=0;
		$sql ="SELECT * FROM prescription_records LEFT JOIN medicine on prescription_records.medicine_name=medicine.medicineid WHERE prescription_id='$_GET[prescriptionid]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>&nbsp;$rs[medicinename]</td>
		    <td>&nbsp;$rs[dosage]</td>
          <td>&nbsp;₹$rs[cost]</td>
		   <td>&nbsp;$rs[unit]</td>
		   <td  align='right'>₹" . $rs[cost] * $rs[unit] . "</td>";
			if(!isset($_SESSION[patientid]))
			{
			 echo " <td>&nbsp; <a href='prescriptionrecord.php?delid=$rs[prescription_record_id]&prescriptionid=$_GET[prescriptionid]'>Delete</a> </td>"; 
			}
		echo "</tr>";
		$gtotal = $gtotal+($rs[cost] * $rs[unit]);
		}
		?>
        <tr>
          <th colspan="4" class="text-right">Grand Total - </th>
		  <th align="right">₹<?php echo $gtotal; ?></th>
		  <td></td>
          </tr>
        <tr>
          <td colspan="6"><div align="center">
            <input type="submit" name="print" id="print" value="Print" onclick="myFunction()"/>
          </div></td>
          </tr>
									
									</tbody>
								</table>
								<table>
	<tr><td>
	 <center><a href='patientreport.php?patientid=<?php echo $_GET[patientid]; ?>&appointmentid=<?php echo $_GET[appid]; ?>'><strong>View Patient Report>></strong></a></center>
	</td></tr>
	</table>
	<script>
function myFunction() {
    window.print();
}</script>
							</div>
						</div>

                 	
                 </div>
					

				</div>
			</main>

			<?php include("footer.php");?>
		</div>
	</div>

	<script src="js/app.js"></script>
    <script type="application/javascript">
function loadmedicine(medicineid)
{
	if (window.XMLHttpRequest) 
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("totcost").value = this.responseText;
			document.getElementById("cost").value = this.responseText;
			document.getElementById("unit").value = 1;
		} 
	};
	xmlhttp.open("GET","ajaxmedicine.php?medicineid="+medicineid,true);
	xmlhttp.send();
}

function calctotalcost(cost,qty)
{
	 document.getElementById("totcost").value = parseFloat(cost) * parseFloat(qty);
} 
	
</script>
</body>

</html>