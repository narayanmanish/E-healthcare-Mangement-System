

<?php
session_start();
if(!isset($_SESSION['doctorid']))
{
  echo "<script>window.location='doctorlogin.php';</script>";
}
else
{
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_SESSION['doctorid']))
	{
			$sql ="UPDATE doctor SET doctorname='$_POST[doctorname]',mobileno='$_POST[mobilenumber]',departmentid='$_POST[select3]',loginid='$_POST[loginid]',education='$_POST[education]',experience='$_POST[experience]',consultancy_charge='$_POST[consultancy_charge]' WHERE doctorid='$_SESSION[doctorid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Doctor profile updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO doctor(doctorname,mobileno,departmentid,loginid,password,status,education,experience) values('$_POST[doctorname]','$_POST[mobilenumber]','$_POST[select3]','$_POST[loginid]','$_POST[password]','$_POST[select]','$_POST[education]','$_POST[experience]')";
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
if(isset($_SESSION['doctorid']))
{
	$sql="SELECT * FROM doctor WHERE doctorid='$_SESSION[doctorid]' ";
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
							<h3><strong>Doctor Account</strong> Profile</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">Profile</a></li>
									
									<li class="breadcrumb-item active" aria-current="page">View Profile</li>
								</ol>
							</nav>
						</div>
					</div>

					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title text-center">Doctor Profile</h4>
									<h6 class="card-subtitle text-muted text-center">View or Edit Doctor Profile</h6>
									<hr>
								</div>
								<div class="card-body">
									
									<form method="post" action="" name="frmdoctprfl" onSubmit="return validateform()">
										<div class="row">

											<div class="mb-3 col-md-4">
												<label class="form-label" for="doctorname">Doctor name</label>
												<input type="text" class="form-control" name="doctorname" id="doctorname" value="<?php echo $rsedit[doctorname]; ?>">
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label" for="mobilenumber">Mobile No</label>
												<input type="text" class="form-control" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>">
											</div>
										  <div class="mb-3 col-md-4">
											



												<label class="form-label" for="select3">Department</label>
												<select name="select3" id="select3" class="form-control">
                                                       
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
											<label class="form-label" for="admissiontme">Email</label>
											<input type="text" class="form-control" name="loginid" id="loginid" value="<?php echo $rsedit[loginid]; ?>">
										</div>
											
										
										<div class="mb-3 col-md-4">
											
											<label class="form-label" for="education">Education</label>
											<input type="text" class="form-control"name="education" id="education" value="<?php echo $rsedit[education]; ?>" >
										</div>
										<div class="mb-3 col-md-4" >
											
											<label class="form-label" for="experience">Experience</label>
											<input type="text" class="form-control"  name="experience" id="experience" value="<?php echo $rsedit[experience]; ?>"  >
										</div>
										<div class="mb-3 col-md-4" >
											
											<label class="form-label" for="consultancy_charge">consultancy charge</label>
											<input type="text" class="form-control" name="consultancy_charge" id="consultancy_charge" value="<?php echo $rsedit[consultancy_charge]; ?>"  >
										</div>	
									    <div>
										<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
							</div>
							<?php
}

?>
						</div>

				</div class="clear">
			</main>

			<?php include("footer.php");?>
		</div>
	</div>

	<script src="js/app.js"></script>

	

</body>

</html>