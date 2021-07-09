
<?php
error_reporting(0);
session_start();

include("dbconnection.php");
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
              <h3><strong>Doctor Account</strong> View Doctor consultancy charges</h3>
            </div>

            <div class="col-auto ml-auto text-right mt-n1">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a href="#">View Doctor consultancy charges</a></li>
                  
                </ol>
              </nav>
            </div>
          </div>
                 <div class="row">
                  <div class="col-12 col-xl-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title text-center">View consultancy charges</h5>
                  
                </div>
                <table class="table table-bordered">




                  <thead>
                    <tr>
                      <th width="97" scope="col">Date</th>
          <th width="245" scope="col">Decription</th>
          <th width="86" scope="col">Bill Amount</th>
                    </tr>
                  </thead>
                  <tbody>
            <?php
		$sql ="SELECT * FROM billing_records where bill_type='Consultancy Charge' AND bill_type_id='$_SESSION[doctorid]'";
		$qsql = mysqli_query($con,$sql);
		$billamt= 0;
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          	<td>&nbsp;$rs[bill_date]</td>
		 	<td>&nbsp; $rs[bill_type]";

if($rs[bill_type] == "Service Charge")
{
 	 $sqlservice_type1 = "SELECT * FROM service_type WHERE service_type_id='$rs[bill_type_id]'";
	$qsqlservice_type1 = mysqli_query($con,$sqlservice_type1);
	$rsservice_type1 = mysqli_fetch_array($qsqlservice_type1);
	echo " - " . $rsservice_type1[service_type];
}
			

if($rs[bill_type]== "Room Rent")
{
		$sqlroomtariff = "SELECT * FROM room WHERE roomid='$rs[bill_type_id]'";
		$qsqlroomtariff = mysqli_query($con,$sqlroomtariff);
		$rsroomtariff = mysqli_fetch_array($qsqlroomtariff);
		echo " : ". $rsroomtariff[roomtype] .  "- Room No." . $rsroomtariff[roomno];
}

if($rs[bill_type] == "Consultancy Charge")
{
	//Consultancy Charge
	$sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[bill_type_id]'";
	$qsqldoctor = mysqli_query($con,$sqldoctor);
	$rsdoctor = mysqli_fetch_array($qsqldoctor);
		echo " - Mr.".$rsdoctor[doctorname];
}

if($rs[bill_type] =="Treatment Cost")
{	
	//Treatment Cost
	$sqltreatment = "SELECT * FROM treatment WHERE treatmentid='$rs[bill_type_id]'";
	$qsqltreatment = mysqli_query($con,$sqltreatment);
	$rstreatment = mysqli_fetch_array($qsqltreatment);
	echo " - ".$rstreatment[treatmenttype];
}

if($rs[bill_type]  == "Prescription charge")
{
	$sqltreatment = "SELECT * FROM prescription WHERE treatmentid='$rs[bill_type_id]'";
	$qsqltreatment = mysqli_query($con,$sqltreatment);
	$rstreatment = mysqli_fetch_array($qsqltreatment);
		
	$sqltreatment1 = "SELECT * FROM treatment_records WHERE treatmentid='$rstreatment[treatment_records_id]'";
	$qsqltreatment1 = mysqli_query($con,$sqltreatment1);
	$rstreatment1 = mysqli_fetch_array($qsqltreatment1);

	$sqltreatment2 = "SELECT * FROM treatment WHERE treatmentid='$rstreatment1[treatmentid]'";
	$qsqltreatment2 = mysqli_query($con,$sqltreatment2);
	$rstreatment2 = mysqli_fetch_array($qsqltreatment2);
	echo 	" - " . $rstreatment2[treatmenttype];
} 

	echo " </td><td>&nbsp;Rs. $rs[bill_amount]</td></tr>";
		$billamt = $billamt +  $rs[bill_amount];
		}
		?>
                  </tbody>
                </table>
                <table class="table table-bordered">
      <tbody>

		<tr>
		  <th ><div class="text-right">Total Earnings &nbsp; </div></th>
		  <td >&nbsp;Rs. <?php echo ($billamt + $taxamt)  - $rsbilling_records[discount] ; ?></td>
	    </tr>
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