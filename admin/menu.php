<?php
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");

session_start();






if(isset($_SESSION[adminid]))
{
?>


<nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="#">
          <span class="align-middle">Admin</span>
        </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="adminaccount.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
                    </li>

                    <li class="sidebar-item">
                        <a data-target="#Profile" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
                        <ul id="Profile" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="adminprofile.php">Admin Profile</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="adminchangepassword.php">Change Password</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="admin.php">Add Admin</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="viewadmin.php">View Admin</a></li>
                           
                        </ul>
                    </li>
                     <li class="sidebar-item">
                        <a data-target="#Patient" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Patient</span>
            </a>
                        <ul id="Patient" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="addpatient.php">Add Patient</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="viewpatient.php">View Patient Records</a></li>
                           
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a data-target="#appointment" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Appointment</span>
            </a>
                        <ul id="appointment" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="appointment.php" >New Appointment</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="viewappointmentpending.php" >View Pending Appointments</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="viewappointmentapproved.php" >View Approved Appointments</a></li>
                           
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="viewtreatmentrecord.php">
              <i class="align-middle" data-feather="thermometer"></i> <span class="align-middle">Treatment</span>
            </a>
                    </li>

                <li class="sidebar-item">
                        <a data-target="#doctor" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="heart"></i> <span class="align-middle">Doctor</span>
            </a>
                        <ul id="doctor" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="doctor.php">Add Doctor</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="Viewdoctor.php">View Doctor</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="doctortimings.php">Add Doctor Timings</a></li>
                           
                           
                        </ul>
                    </li>
                    
                     <li class="sidebar-item">
                        <a data-target="#Settings" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
            </a>
                        <ul id="Settings" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="department.php" >Add Departments</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="Viewdepartment.php" >View Department</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="treatment.php" >Add Treatment type</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="viewtreatment.php" >View Treatment types</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="medicine.php" >Add Medicine</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="Viewmedicine.php" >View Medicine</a></li>
                           
                        </ul>
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
