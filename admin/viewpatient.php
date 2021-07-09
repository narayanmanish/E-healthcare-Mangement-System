








<?php
error_reporting(0);
session_start();

include("dbconnection.php");
if(isset($_GET[delid]))
{
  $sql ="DELETE FROM patient WHERE patientid='$_GET[delid]'";
  $qsql=mysqli_query($con,$sql);
  if(mysqli_affected_rows($con) == 1)
  {
    echo "<script>alert('patient record deleted successfully..');</script>";
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
              <h3><strong>Admin Account</strong> View Patient records</h3>
            </div>

            <div class="col-auto ml-auto text-right mt-n1">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a href="#">View Patient records</a></li>
                  
                </ol>
              </nav>
            </div>
          </div>
                 <div class="row">

                  <div class="col-12 col-xl-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title text-center">View Patient records</h5>
                  
                </div>
                <table class="table table-bordered">




                  <thead>
                    <tr>
                      <th width="15%" height="36"><div align="center">Patient Name</div></th>
          <th width="20%"><div align="center">Admission details</div></th>
          <th width="28%"><div align="center">Address</div></th>    
          <th width="20%"><div align="center">Patient Profile</div></th>
          <th width="17%"><div align="center">Action</div></th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
    $sql ="SELECT * FROM patient";
    $qsql = mysqli_query($con,$sql);
    while($rs = mysqli_fetch_array($qsql))
    {
        echo "<tr>
          <td>$rs[patientname]<br>
      <strong>Login ID :</strong> $rs[loginid] </td>
          <td>
      <strong>Date</strong>: &nbsp;$rs[admissiondate]<br>
     <strong>Time</strong>: &nbsp;$rs[admissiontime]</td>
       <td>$rs[address]<br>$rs[city] -  &nbsp;$rs[pincode]<br>
Mob No. - $rs[mobileno]</td>
          <td><strong>Blood group</strong> - $rs[bloodgroup]<br>
<strong>Gender</strong> - &nbsp;$rs[gender]<br>
<strong>DOB</strong> - &nbsp;$rs[dob]</td>
          <td align='center'>Status - $rs[status] <br>";
if(isset($_SESSION[adminid]))
{
      echo "<a href='patient.php?editid=$rs[patientid]'>Edit</a> | <a href='viewpatient.php?delid=$rs[patientid]'>Delete</a> <hr>
<a href='patientreport.php?patientid=$rs[patientid]'>View Report</a>";
}
      echo "</td></tr>";
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