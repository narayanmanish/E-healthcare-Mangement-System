



<?php
session_start();
if(!isset($_SESSION['adminid']))
{
	echo "<script>window.location='adminlogin.php';</script>";
}
else
{
include("dbconnection.php");

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
              <h3><strong>Admin Account</strong> Dashboard</h3>
            </div>

            <div class="col-auto ml-auto text-right mt-n1">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a href="#">Admin Account</a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
              <div class="w-100">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-body">
                        <h1>Number of Appointment Records :     
    <?php
	$sql = "SELECT * FROM appointment WHERE status='Active'";
	if(isset($_GET[date]))
	{
		$sql = $sql . " AND appointmentdate ='$_GET[date]'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_num_rows($qsql);
	?>
    </h1>	
    <h1>Number of Billing Reports : 
    <?php
	$sql = "SELECT * FROM billing WHERE billingid !='0'";
	if(isset($_GET[date]))
	{
		$sql = $sql . " AND billingdate ='$_GET[date]'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_num_rows($qsql);
	?>
    </h1>
   
                        
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body">
                      <h1 class="mt-1 mb-3">  Number of Appointment Records :
    
                        <?php
  $sql = "SELECT * FROM appointment WHERE status='Active'";
  $qsql = mysqli_query($con,$sql);
  echo mysqli_num_rows($qsql);
  ?> </h1>  
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                   
  

                    <div class="card">
                      <div class="card-body">
                         <h1>Number of Patient Records : 
    <?php
	$sql = "SELECT * FROM patient WHERE status='Active'";
	if(isset($_GET[date]))
	{
		$sql = $sql . " AND admissiondate ='$_GET[date]'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_num_rows($qsql);
	?>
    </h1>    
    <h1>Number of Treatment Records : 
    <?php
	$sql = "SELECT * FROM treatment_records WHERE status='Active'";
	if(isset($_GET[date]))
	{
		$sql = $sql . " AND treatment_date  ='$_GET[date]'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_num_rows($qsql);
	?>
    </h1>
    <h1>Number of Billing Records :
    <?php
	$sql = "SELECT * FROM billing_records WHERE status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_num_rows($qsql);
}
	?>
    </h1>
                        
                      </div>
                    </div>

                    
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

 
</body>

</html>