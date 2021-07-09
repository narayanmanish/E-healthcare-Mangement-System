<?php
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");

session_start();

if(isset($_SESSION[doctorid]))
{
?>


<nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="#">
          <span class="align-middle">Doctor</span>
        </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="doctoraccount.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
                    </li>

                    <li class="sidebar-item">
                        <a data-target="#Profile" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
            </a>
                        <ul id="Profile" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="doctorprofile.php">Profile</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="doctorchangepassword.php">Change Password</a></li>
                           
                        </ul>
                    </li>
                     <li class="sidebar-item">
                        <a data-target="#appointment" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Appointment</span>
            </a>
                        <ul id="appointment" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="viewappointmentpending.php">Pending Appointments</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="viewappointmentapproved.php">Approved Appointments</a></li>
                           
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="viewpatient.php">
              <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">View Patient</span>
            </a>
                    </li>

                <li class="sidebar-item">
                        <a data-target="#Timings" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="clock"></i> <span class="align-middle">Doctor Timings</span>
            </a>
                        <ul id="Timings" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="doctortimings.php">Add Timings</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="viewdoctortimings.php">View Timings</a></li>
                           
                        </ul>
                    </li>
                     <li class="sidebar-item">
                        <a data-target="#treatment" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="thermometer"></i> <span class="align-middle">Treatment</span>
            </a>
                        <ul id="treatment" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="viewtreatmentrecord.php">View Treatment Records</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="viewtreatment.php">View Treatment</a></li>
                           
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="viewdoctorconsultancycharge.php">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Income Report</span>
            </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="logout.php">
              <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Log Out</span>
            </a>
                    </li>

        

                   
                </ul>

                
            </div>
        </nav>










<?php
}
?>
