

<?php
session_start();
if(!isset($_SESSION['patientid']))
{
  echo "<script>window.location='http://localhost/e-health/login_page.php';</script>";
}
else
{


include("dbconnection.php");
if(isset($_GET['delid']))
{
  $sql ="DELETE FROM prescription WHERE prescriptionid='$_GET[delid]'";
  $qsql=mysqli_query($con,$sql);
  if(mysqli_affected_rows($con) == 1)
  {
    echo "<script>alert('prescription deleted successfully..');</script>";
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
    <?php include("header1.php");?>

    <div class="main">
      <?php include("header.php");?>

      <main class="content">
        <div class="container-fluid p-0">
          <div class="row mb-2 mb-xl-3">
                      <div class="col-auto d-none d-sm-block">
              <h3><strong>Patient Account</strong> Prescription</h3>
            </div>

            <div class="col-auto ml-auto text-right mt-n1">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
            
                  
                  <li class="breadcrumb-item active" aria-current="page">Prescription</li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="row mb-2 mb-xl-3">
            <div class="col-12 col-xl-12">
              
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title text-center">View Prescription</h5>
                  <h6 class="card-subtitle text-muted"></h6>
                </div>
                <?php
$sql ="SELECT * FROM prescription where patientid='$_SESSION[patientid]'";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
  $sqlpatient = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
  $qsqlpatient = mysqli_query($con,$sqlpatient);
  $rspatient = mysqli_fetch_array($qsqlpatient);
  
  $sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
  $qsqldoctor = mysqli_query($con,$sqldoctor);
  $rsdoctor = mysqli_fetch_array($qsqldoctor);
?>  
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width:40%;">Doctor</th>
                      <th style="width:25%">Patient</th>
                      <th class="d-none d-md-table-cell" style="width:25%">Prescription Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                     <?php
            echo "<tr>
              <td>&nbsp;$rsdoctor[doctorname]</td>
              <td>&nbsp;$rspatient[patientname]</td>
               <td>&nbsp;$rs[prescriptiondate]</td>
            <td>&nbsp;$rs[status]</td>
            
            </tr>";
    
            ?>
                   
                    
                  </tbody>
                </table>
              </div>
            </div>




            <div class="col-12 col-xl-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title text-center">View Prescription</h5>
                  <h6 class="card-subtitle text-muted"></h6>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width:40%;">Medicine</th>
                      <th style="width:25%">Cost</th>
                      <th class="d-none d-md-table-cell" style="width:25%">Unit</th>
                       <th class="d-none d-md-table-cell" style="width:25%">Dosage</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
             $sqlprescription_records ="SELECT * FROM prescription_records LEFT JOIN medicine ON prescription_records.medicine_name=medicine.medicineid WHERE prescription_records.prescription_id='$rs[0]'";
            $qsqlprescription_records = mysqli_query($con,$sqlprescription_records);
            while($rsprescription_records = mysqli_fetch_array($qsqlprescription_records))
            {
            echo "<tr>
              <td>&nbsp;$rsprescription_records[medicinename]</td>
              <td>&nbsp;$rsprescription_records[cost]</td>
               <td>&nbsp;$rsprescription_records[unit]</td>
                <td>&nbsp;$rsprescription_records[dosage]</td>
                  
            </tr>";
            }
            ?>
                  <tr>
              <td colspan="6"><div align="center">
                <input type="submit" name="print" id="print" value="Print" onclick="myFunction()"/>
              </div></td>
              </tr> 
                  </tbody>
                </table>
                <?php
}
}
?>
              </div>
            </div>
          </div>

        </div>
      </main>

      <?php include("footer.php");?>
    </div>
  </div>

  <script src="js/app.js"></script>
  <script>
function myFunction()
{
  window.print();
}
</script>




</body>

</html>