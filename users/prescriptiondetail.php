<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									
								</div>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th style="width:40%;">Doctor</th>
											<th style="width:25%">Patient</th>
											<th class="d-none d-md-table-cell" style="width:25%">Prescription Date</th>
											<th class="d-none d-md-table-cell" style="width:25%">View</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<?php
$sql ="SELECT * FROM prescription WHERE patientid='$_GET[patientid]' AND appointmentid='$_GET[appointmentid]'";
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
					<td><a href='patviewprescription.php?prescriptionid=$rs[0]&patientid=$rs[patientid]' >View</td>
            </tr>";
}
?>    
										</tr>
										
										
									</tbody>
								</table>
							</div>
							<div class="col-12">
								<?php
if(isset($_SESSION['doctorid']))
{
?>  
<hr>
	<table class="table table-bordered">
		<tr>
			<td>
			<div align="center"><strong><a href="prescription.php?patientid=<?php echo $_GET[patientid]; ?>&appid=<?php echo $rsappointment[appointmentid]; ?>">Add Prescription records</a></strong></div>
			</td>
		</tr>
	</table>
<?php
}
?>
							</div>
						</div>
