<?php
	$qemail=$_GET["q"];
	$con=mysqli_connect("localhost","root","","php2021");
	$sql="select loginid from patient where loginid='$qemail'";
	$rs=mysqli_query($con,$sql);
	if(mysqli_num_rows($rs)==0)
		echo "Email Available For Register";
	else
		echo "Email Already Registred";
	 
?>