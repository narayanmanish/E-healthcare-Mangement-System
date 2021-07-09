



<?php
error_reporting(0);
session_start();

include("dbconnection.php");
if(isset($_GET[delid]))
{
  $sql ="DELETE FROM doctor_timings WHERE doctor_timings_id='$_GET[delid]'";
  $qsql=mysqli_query($con,$sql);
  if(mysqli_affected_rows($con) == 1)
  {
    echo "<script>alert('doctortimings record deleted successfully..');</script>";
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
              <h3><strong>Doctor Account</strong> View Doctor Timings</h3>
            </div>

            <div class="col-auto ml-auto text-right mt-n1">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a href="#">View Doctor Timings</a></li>
                  
                </ol>
              </nav>
            </div>
          </div>
                 <div class="row">
                  <div class="col-12 col-xl-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title text-center">View Doctor Timings</h5>
                  
                </div>
                <table class="table table-bordered">




                  <thead>
                    <tr>
                       <td>Doctor</td>
          <td>Timings available</td>
          <td>Status</td>
          <td>Action</td>
          
                    </tr>
                  </thead>
                  <tbody>
              <?php
    $sql ="SELECT * FROM doctor_timings where doctorid='$_SESSION[doctorid]'";
    $qsql = mysqli_query($con,$sql);
    while($rs = mysqli_fetch_array($qsql))
    {
      $sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
      $qsqldoctor = mysqli_query($con,$sqldoctor);
      $rsdoctor = mysqli_fetch_array($qsqldoctor);
      
      $sqldoct = "SELECT * FROM doctor_timings WHERE doctor_timings_id='$rs[doctor_timings_id]'";
      $qsqldoct = mysqli_query($con,$sqldoct);
      $rsdoct = mysqli_fetch_array($qsqldoct);
      
        echo "<tr>
          <td>&nbsp;$rsdoctor[doctorname]</td>
          <td>&nbsp;$rsdoct[start_time] - $rsdoct[end_time]</td>
          <td>&nbsp;$rs[status]</td>
          <td>&nbsp;<a href='doctortimings.php?editid=$rs[doctor_timings_id]'>Edit</a> | <a href='viewdoctortimings.php?delid=$rs[doctor_timings_id]'>Delete</a> </td>
        </tr>";
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