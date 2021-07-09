

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
if(!isset($_SESSION['patientid']))
{
  echo "<script>window.location='http://localhost/e-health/login_page.php';</script>";
}
?>
 <div class="wrapper">
  <?php
     include("header1.php");
$sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
$qsqlpatient = mysqli_query($con,$sqlpatient);
$rspatient = mysqli_fetch_array($qsqlpatient);

$sqlpatientappointment = "SELECT * FROM appointment WHERE patientid='$_SESSION[patientid]' ";
$qsqlpatientappointment = mysqli_query($con,$sqlpatientappointment);
$rspatientappointment = mysqli_fetch_array($qsqlpatientappointment);
?>
 

    <div class="main">
      <?php include("header.php");?>

      <main class="content">
        <div class="container-fluid p-0">

          <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
              <h3><strong>Patient Account</strong> Dashboard</h3>
            </div>

            <div class="col-auto ml-auto text-right mt-n1">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a href="#">Patient Account</a></li>
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
                        <h5 class="card-title mb-4">This account is registered under</h5>
                        <h1 class="mt-1 mb-3"> <?php echo $rspatient[patientname]; ?> </h1>
                        
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title mb-4">You have Registered on </h5>
                        <h1 class="mt-1 mb-3"><?php echo $rspatient[admissiondate]; ?> <?php echo $rspatient[admissiontime]; ?></h1>  
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <?php
if(mysqli_num_rows($qsqlpatientappointment) == 0)
{
?>
  
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title mb-4"></h5>
                        <h1 class="mt-1 mb-3">Appointment records not found..</h1>
                        
                      </div>
                    </div>
<?php
}
else
{
?>    
  

                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title mb-4">Last Appointment taken on -</h5>
                        <h1 class="mt-1 mb-3"> <?php echo $rspatientappointment[appointmentdate]; ?> <?php echo $rspatientappointment[appointmenttime]; ?></h1>
                        
                      </div>
                    </div>
<?php
}
?>
                    
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

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
      var gradient = ctx.createLinearGradient(0, 0, 0, 225);
      gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
      gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
      // Line chart
      new Chart(document.getElementById("chartjs-dashboard-line"), {
        type: "line",
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Sales ($)",
            fill: true,
            backgroundColor: gradient,
            borderColor: window.theme.primary,
            data: [
              2115,
              1562,
              1584,
              1892,
              1587,
              1923,
              2566,
              2448,
              2805,
              3438,
              2917,
              3327
            ]
          }]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          tooltips: {
            intersect: false
          },
          hover: {
            intersect: true
          },
          plugins: {
            filler: {
              propagate: false
            }
          },
          scales: {
            xAxes: [{
              reverse: true,
              gridLines: {
                color: "rgba(0,0,0,0.0)"
              }
            }],
            yAxes: [{
              ticks: {
                stepSize: 1000
              },
              display: true,
              borderDash: [3, 3],
              gridLines: {
                color: "rgba(0,0,0,0.0)"
              }
            }]
          }
        }
      });
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Pie chart
      new Chart(document.getElementById("chartjs-dashboard-pie"), {
        type: "pie",
        data: {
          labels: ["Chrome", "Firefox", "IE"],
          datasets: [{
            data: [4306, 3801, 1689],
            backgroundColor: [
              window.theme.primary,
              window.theme.warning,
              window.theme.danger
            ],
            borderWidth: 5
          }]
        },
        options: {
          responsive: !window.MSInputMethodContext,
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          cutoutPercentage: 75
        }
      });
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Bar chart
      new Chart(document.getElementById("chartjs-dashboard-bar"), {
        type: "bar",
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "This year",
            backgroundColor: window.theme.primary,
            borderColor: window.theme.primary,
            hoverBackgroundColor: window.theme.primary,
            hoverBorderColor: window.theme.primary,
            data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
            barPercentage: .75,
            categoryPercentage: .5
          }]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              gridLines: {
                display: false
              },
              stacked: false,
              ticks: {
                stepSize: 20
              }
            }],
            xAxes: [{
              stacked: false,
              gridLines: {
                color: "transparent"
              }
            }]
          }
        }
      });
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var markers = [{
          coords: [31.230391, 121.473701],
          name: "Shanghai"
        },
        {
          coords: [28.704060, 77.102493],
          name: "Delhi"
        },
        {
          coords: [6.524379, 3.379206],
          name: "Lagos"
        },
        {
          coords: [35.689487, 139.691711],
          name: "Tokyo"
        },
        {
          coords: [23.129110, 113.264381],
          name: "Guangzhou"
        },
        {
          coords: [40.7127837, -74.0059413],
          name: "New York"
        },
        {
          coords: [34.052235, -118.243683],
          name: "Los Angeles"
        },
        {
          coords: [41.878113, -87.629799],
          name: "Chicago"
        },
        {
          coords: [51.507351, -0.127758],
          name: "London"
        },
        {
          coords: [40.416775, -3.703790],
          name: "Madrid "
        }
      ];
      var map = new JsVectorMap({
        map: "world",
        selector: "#world_map",
        zoomButtons: true,
        markers: markers,
        markerStyle: {
          initial: {
            r: 9,
            strokeWidth: 7,
            stokeOpacity: .4,
            fill: window.theme.primary
          },
          hover: {
            fill: window.theme.primary,
            stroke: window.theme.primary
          }
        }
      });
      window.addEventListener("resize", () => {
        map.updateSize();
      });
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById("datetimepicker-dashboard").flatpickr({
        inline: true,
        prevArrow: "<span class=\"fas fa-chevron-left\" title=\"Previous month\"></span>",
        nextArrow: "<span class=\"fas fa-chevron-right\" title=\"Next month\"></span>",
      });
    });
  </script>

</body>

</html>