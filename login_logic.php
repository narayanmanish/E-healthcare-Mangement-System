                            
<?php
session_start();

include("dbconnection.php");
if(isset($_SESSION['patientid']))
{
    
    echo "<script>window.location='users/patientaccount.php';</script>";
}
if(isset($_POST[login]))
{
    $sql = "SELECT * FROM patient WHERE loginid='$_POST[loginid]' AND password='$_POST[password]' AND status='Active'";
    $qsql = mysqli_query($con,$sql);
    if(mysqli_num_rows($qsql) >= 1)
    {
        $rslogin = mysqli_fetch_array($qsql);
        $_SESSION['patientid']= $rslogin['patientid'] ;
        echo "<script>window.location='users/patientaccount.php';</script>";
    }
    else
    {
        echo "<script>alert('Invalid login id and password entered..'); </script>";
    }
}
?>

                               <div class="col-md-12">
                                     <form method="post" action="" name="frmpatlogin" onSubmit="return validateform()">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="loginid" id="loginid" placeholder="Email *" value="" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password *" value="" />
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="col-md-6">
                                   <input type="submit" class="btnRegister" name="login" id="login" value="Login"/>
                                   
                                </form>
                               
 </div>
                                







