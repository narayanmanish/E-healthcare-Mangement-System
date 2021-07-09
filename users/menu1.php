<?php
session_start();

if(isset($_SESSION[patientid]))
{
?>















<nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="#">
          <span class="align-middle">Patient Account</span>
        </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="patientaccount.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
                    </li>

                    


                     <li class="sidebar-item">
                        <a data-target="#ui" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Appointment</span>
            </a>
                        <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="patientappointment.php">Add Appointment</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="viewappointment.php">View Appointment</a></li>
                            
                        </ul>
                    </li>
                     <li class="sidebar-item">
                        <a data-target="#forms" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
                        <ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="patientprofile.php">View Profile</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="patientchangepassword.php">Change Password</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="patviewprescription.php">
              <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Prescription</span>
            </a>
                    </li>
                     <li class="sidebar-item">
                        <a class="sidebar-link" href="payment.php">
              <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Payment</span>
            </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="viewtreatmentrecord.php">
              <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Treatment</span>
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