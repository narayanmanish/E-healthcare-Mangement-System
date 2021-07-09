
<?php
session_start();
include("dbconnection.php");
if(!isset($_SESSION['doctorid']))
{
  echo "<script>window.location='doctorlogin.php';</script>";
}
else
{

  $sql = "SELECT doctorname FROM doctor  WHERE doctorid='$_SESSION[doctorid]'";
  $qsql = mysqli_query($con,$sql);
  $rsdoctorprofile=  mysqli_fetch_array($qsql);
  ?>

<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>

				<form class="d-none d-sm-inline-block">
					<div class="input-group input-group-navbar">
						<input type="text" class="form-control" placeholder="Search…" aria-label="Search" disabled="">
						<button class="btn" type="button">
              <i class="align-middle" data-feather="search"></i>
            </button>
					</div>
				</form>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						
						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                <img src="img/doctor.png" class="avatar img-fluid rounded mr-1" alt="Charles Hall" /> <span class="text-dark">Dr. <?php echo $rsdoctorprofile[doctorname]; ?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="doctorprofile.php"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>
								
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="viewdoctorconsultancycharge.php"><i class="align-middle mr-1" data-feather="book"></i> Income</a>
								
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php"><i class="align-middle mr-1" data-feather="log-out"></i>Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<?php }?>