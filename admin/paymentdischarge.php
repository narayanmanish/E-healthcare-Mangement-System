






<?php
error_reporting(0);
include("dbconnection.php");
if(isset($_POST["submitfullamount"]))
{
  $dt = date("Y-m-d");
  date_default_timezone_set("Asia/Calcutta");
$tim = date("H:i:s");

    $sql ="INSERT INTO payment(patientid,appointmentid,paiddate,paidtime,paidamount,status) values('$_GET[patientid]','$_GET[appointmentid]','$dt','$tim','$_POST[paidamount]','Active')";
    if($qsql = mysqli_query($con,$sql))
    {
      echo "<script>alert('payment record inserted successfully...');</script>";
    }
    else
    {
      echo mysqli_error($con);
    }
    
    $sql ="UPDATE billing SET discount=$_POST[discountamount]+ discount, discountreason=CONCAT('$_POST[discountreason] , ', discountreason),discharge_time='$_POST[dischargetime]',discharge_date='$_POST[dischargedate]' WHERE appointmentid='$_GET[appointmentid]'";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
    
    echo "<script>window.location='patientreport.php?patientid=$_GET[patientid]&appointmentid=$_GET[appointmentid]'</script>";
}
if(isset($_SESSION[patientid]))
{
  $sql="SELECT * FROM payment WHERE paymentid='$_GET[editid]' ";
  $qsql = mysqli_query($con,$sql);
  $rsedit = mysqli_fetch_array($qsql);
  
}
$billappointmentid = $_GET[appointmentid];
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
              <h3><strong>Admin Account</strong> Payment Discharge</h3>
            </div>

            <div class="col-auto ml-auto text-right mt-n1">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a href="#">Admi</a></li>
                  
                  <li class="breadcrumb-item active" aria-current="page">Payment Discharge</li>
                </ol>
              </nav>
            </div>
          </div>
           <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h2 class="card-title text-center">Payment Report</h2>
                  <hr>
                </div>
                <div class="card-body">

          <?php
include("viewpaymentreport.php");
?>
 </div>
              </div>


          <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h2 class="card-title text-center">Discharge</h2>
                  <hr>
                </div>
                <div class="card-body">
                  
                  <form method="post" action="">
                    <div class="row">

                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="patiente">Discharge date</label>
                        <input type="date" class="form-control" name="dischargedate" id="dischargedate" value="<?php echo date("Y-m-d"); ?>"  required/> 
                        
                      </div>
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="patiente">Discharge Time</label>
                        <input type="time" class="form-control" name="dischargetime" id="dischargetime" value="<?php echo date("h:i:s"); ?>"  required/> 
                        
                      </div>
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="patiente">Balance amount</label>
                        <input type="text" class="form-control" name="balamt" id="balamt" value="<?php echo $balanceamt; ?>" readonly onkeyup="calculatepayable()" required/> 
                      </div>
                       <div class="mb-3 col-md-12">
                        <label class="form-label" for="patiente">Discount</label>
                        <input input type="text" class="form-control" name="discountamount" id="discountamount" value="0" onkeyup="calculatepayable()" required/> 
                      </div>
                       <div class="mb-3 col-md-12">
                        <label class="form-label" for="patiente">Payable Ammount</label>
                        <input type="text" class="form-control" name="paidamoun" id="paidamount" value="<?php echo $balanceamt; ?>" required/> 
                      </div>
                      
                      <div class="mb-3 col-md-12">
                        
                        <label class="form-label" for="textarea">Discount Reason</label>
                        <textarea  class="form-control" name="discountreason" id="discountreason" required><?php echo $rsedit[note] ; ?></textarea>
                      </div>
                    
                    
                     
                    <div>
                    <button type="submit" name="submitfullamount" id="submitfullamount" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
              
              <div class="col-md-12">
              <div class="card">
                
                <div class="card-body">

          <table class="table table-boardered">
<thead>
  <tr>
          <td colspan="2" align="center"><a href='patientreport.php?patientid=<?php echo $_GET[patientid]; ?>&appointmentid=<?php echo $_GET[appointmentid]; ?>'><strong>View Patient Report>></strong></a></td>
        </tr>
      </thead>
    </table>
 </div>
              </div>
            </div>

        </div class="clear">
      </main>

      <?php include("footer.php");?>
    </div>
  </div>

  <script src="js/app.js"></script>


</body>

</html>