


<?php
error_reporting(0);
include("dbconnection.php");
if(isset($_GET[delid]))
{
  $sql ="DELETE FROM treatment WHERE treatmentid='$_GET[delid]'";
  $qsql=mysqli_query($con,$sql);
  if(mysqli_affected_rows($con) == 1)
  {
    echo "<script>alert('treatment deleted successfully..');</script>";
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
              <h3><strong>Admin Account</strong> View Department</h3>
            </div>

            <div class="col-auto ml-auto text-right mt-n1">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a href="#">View Department</a></li>
                  
                </ol>
              </nav>
            </div>
          </div>
                 <div class="row">
                  <div class="col-12 col-xl-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title text-center">View Department</h5>
                  
                </div>
                <table class="table table-bordered">




                  <thead>
                    <tr>
                        <td><strong>Treatment Type</strong></td>
          <td><strong>Treatment cost</strong></td>
          <td><strong>Note</strong></td>
          <td><strong>Status</strong></td>
          <?php
          if(isset($_SESSION[adminid]))
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
    $sql ="SELECT * FROM treatment";
    $qsql = mysqli_query($con,$sql);
    while($rs = mysqli_fetch_array($qsql))
    {
        echo "<tr>
          <td>&nbsp;$rs[treatmenttype]</td>
      <td>&nbsp;Rs. $rs[treatment_cost]</td>
          <td>&nbsp;$rs[note]</td>
       <td>&nbsp;$rs[status]</td>";
    if(isset($_SESSION[adminid]))
    {
    echo "<td>&nbsp;
        <a href='treatment.php?editid=$rs[treatmentid]'>Edit</a> | <a href='viewtreatment.php?delid=$rs[treatmentid]'>Delete</a> </td>";
      }
        echo "</tr>";
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