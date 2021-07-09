







<?php
error_reporting(0);
session_start();

include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE doctor SET doctorname='$_POST[doctorname]',mobileno='$_POST[mobilenumber]',departmentid='$_POST[select3]',loginid='$_POST[loginid]',password='$_POST[password]',status='$_POST[select]',education='$_POST[education]',experience='$_POST[experience]',consultancy_charge='$_POST[consultancy_charge]' WHERE doctorid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('doctor record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO doctor(doctorname,mobileno,departmentid,loginid,password,status,education,experience,consultancy_charge) values('$_POST[doctorname]','$_POST[mobilenumber]','$_POST[select3]','$_POST[loginid]','$_POST[password]','Active','$_POST[education]','$_POST[experience]','$_POST[consultancy_charge]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Doctor record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM doctor WHERE doctorid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
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
							<h3><strong>Admin Account</strong> Add New Doctor</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Doctor</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">Add New Doctor</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h2 class="card-title text-center">Add New Doctor</h2>
									<hr>
								</div>
								<div class="card-body">
									
									<form method="post" action="" name="frmdoct" onSubmit="return validateform()">
										<div class="row">

											<div class="mb-3 col-md-4">
												<label class="form-label" for="patiente">Doctor Name</label>
												<input type="text" class="form-control" name="doctorname" id="doctorname" value="<?php echo $rsedit[doctorname]; ?>" required/>
											</div>
											<div class="mb-3 col-md-4">
												
												<label class="form-label" for="textarea">Mobile no</label>
												<input type="text" class="form-control" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>"required/>
											</div>
										
										<div class="mb-3 col-md-4">
											
											<label class="form-label" for="city">Department</label>
											<select class="form-control" name="select3" id="select3" required>
          <option value="">Select</option>
            <?php
		  	$sqldepartment= "SELECT * FROM department WHERE status='Active'";
			$qsqldepartment = mysqli_query($con,$sqldepartment);
			while($rsdepartment=mysqli_fetch_array($qsqldepartment))
			{
				if($rsdepartment[departmentid] == $rsedit[departmentid])
				{
	echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
				}
				else
				{
  echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
				}
				
			}
		  ?>
          </select>
										</div>
										
										
										<div class="mb-3 col-md-4">
												<label class="form-label" for="dob">Email</label>
												<input type="email" class="form-control" name="loginid" id="loginid"  value="<?php echo $rsedit[loginid];?>" required/>
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label" for="dob">Password</label>
												<input type="password" class="form-control" name="password" id="password" value="<?php echo $rsedit[password]; ?>" required/>
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label" for="confirmpassword">confirm password</label>
												<input type="password" class="form-control" name="confirmpassword" id="confirmpassword"  value="<?php echo $rsedit[confirmpassword]; ?>" required/>
											</div>
											<div class="mb-3 col-md-4">

												<label class="form-label" for="app_reason">Education</label>
												<input type="text" class="form-control" name="education" id="education" value="<?php echo $rsedit[education]; ?>" required/>
											</div>
											<div class="mb-3 col-md-4">

												<label class="form-label" for="app_reason">Experience</label>
												<input type="text" class="form-control" name="experience" id="experience" value="<?php echo $rsedit[experience]; ?>" required/>
											</div>
											<div class="mb-3 col-md-4">

												<label class="form-label" for="app_reason">consultancy charge</label>
												<input type="text" class="form-control" name="consultancy_charge" id="consultancy_charge" value="<?php echo $rsedit[experience]; ?>" required/>
											</div>
											<div class="mb-3 col-md-12">

												<label class="form-label" for="app_reason">Status</label>
												<select class="form-control" name="select" id="select" required>
            <option value="">Select</option>
            <?php
		  $arr= array("Active","Inactive");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[status])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
			  echo "<option value='$val'>$val</option>";
			  }
		  }
		  ?>
          </select>
											</div>
										<div>
										<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
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