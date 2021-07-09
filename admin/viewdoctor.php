


<?php
error_reporting(0);
session_start();

include("dbconnection.php");
if(isset($_GET[delid]))
{
  $sql ="DELETE FROM doctor WHERE doctorid='$_GET[delid]'";
  $qsql=mysqli_query($con,$sql);
  if(mysqli_affected_rows($con) == 1)
  {
    echo "<script>alert('doctor record deleted successfully..');</script>";
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
              <h3><strong>Admin Account</strong> View Doctor</h3>
            </div>

            <div class="col-auto ml-auto text-right mt-n1">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a href="#">View Doctor</a></li>
                  
                </ol>
              </nav>
            </div>
          </div>
                 <div class="row">
                  <div class="col-12 col-xl-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title text-center">View Doctor</h5>
                  
                </div>
                <table class="table table-bordered">




                  <thead>
                    <tr>
                       <td>Doctor Name</td>
          <td>Mobile Number</td>
          <td>Department</td>
          <td>Login ID</td>
          <td>Consultancy Charge</td>
          <td>Education</td>
          <td>Experience</td>
          <td>Status</td>
          <td width="30">Action</td>
          
                    </tr>
                  </thead>
                  <tbody>
             <?php
    $sql ="SELECT * FROM doctor";
    $qsql = mysqli_query($con,$sql);
    while($rs = mysqli_fetch_array($qsql))
    {
      
      $sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]'";
      $qsqldept = mysqli_query($con,$sqldept);
      $rsdept = mysqli_fetch_array($qsqldept);
        echo "<tr>
          <td>&nbsp;$rs[doctorname]</td>
          <td>&nbsp;$rs[mobileno]</td>
       <td>&nbsp;$rsdept[departmentname]</td>
      <td>&nbsp;$rs[loginid]</td>
      <td>&nbsp;$rs[consultancy_charge]</td>
       <td>&nbsp;$rs[education]</td>
      <td>&nbsp;$rs[experience]</td>
          <td>$rs[status]</td>
           <td>&nbsp;
       <a href='doctor.php?editid=$rs[doctorid]'>Edit</a> | <a href='viewdoctor.php?delid=$rs[doctorid]'>Delete</a> </td>
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