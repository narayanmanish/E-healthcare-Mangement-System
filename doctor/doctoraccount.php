
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
  <?php
session_start();
include("dbconnection.php");
if(!isset($_SESSION['doctorid']))
{
  echo "<script>window.location='doctorlogin.php';</script>";
}
?>
 <div class="wrapper">
  <?php
     include("menu.php");

  $sql = "SELECT doctorname FROM doctor  WHERE doctorid='$_SESSION[doctorid]'";
  $qsql = mysqli_query($con,$sql);
  $rsdoctorprofile=  mysqli_fetch_array($qsql);
  ?>
?>
 

    <div class="main">
      <?php include("header.php");?>

      <main class="content">
        <div class="container-fluid p-0">

          <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
              <h3><strong>Doctor Account</strong> Dashboard</h3>
            </div>

            <div class="col-auto ml-auto text-right mt-n1">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a href="#">Doctor Account</a></li>
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
                        <h5 class="card-title mb-4"> Welcome</h5>
                        <h1 class="mt-1 mb-3"> <?php echo $rsdoctorprofile[doctorname]; ?> </h1>
                        
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title mb-4">Number of Appointment Records : </h5>
    
                        <h1 class="mt-1 mb-3"><?php
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
                        <h5 class="card-title mb-4">Number of Patient Records : 
    </h5>
                        <h1 class="mt-1 mb-3"><?php
  $sql = "SELECT * FROM patient WHERE status='Active'";
  $qsql = mysqli_query($con,$sql);
  echo mysqli_num_rows($qsql);
  ?> </h1>
                        
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