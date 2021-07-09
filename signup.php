

<script type="text/javascript">
  function matchPassword() {  
     var password = $("#password").val();
    var confirmPassword = $("#confirmpassword").val();

    if (password != confirmPassword)
        $("#message2").html("Passwords do not match!");
    else
        $("#message2").html("Passwords match.");

}  
</script>
<script language="javascript">
  function checkemail(email)
  {
    var xmlhttp;
    if(window.XMLHttpRequest)
        xmlhttp=new XMLHttpRequest();
    else
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("emsg").innerHTML=xmlhttp.responseText;
        }
    }
    
    xmlhttp.open("GET","checkemail.php?q="+email,true);
    xmlhttp.send();
  }
</script>


 
<?php

include("dbconnection.php");

    $dt = date("Y-m-d");
    date_default_timezone_set("Asia/Calcutta");
$tim = date("H:i:s");
print_r($tim);
if(isset($_POST['submit']))
{

    $sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,mobileno,city,pincode,loginid,password,bloodgroup,gender,dob,status) values('$_POST[patientname]','$dt','$tim','$_POST[address]','$_POST[mobilenumber]','$_POST[city]','$_POST[pincode]','$_POST[loginid]','$_POST[password]','$_POST[select2]','$_POST[select3]','$_POST[dateofbirth]','Active')";
    if($qsql = mysqli_query($con,$sql))
    {
        echo "<script>alert('patients record inserted successfully...');</script>";
            
    }
    else
    {
        echo mysqli_error($con);
    }

}
?>
<div class="col-md-12">
  <form  method="post" action="" name="frmpatient" class="needs-validation form-row" novalidate >
          
          <div class="form-group col-md-6" >
             <label for="patientname">Patient Name</label>
              <input type="text" class="form-control" placeholder="Patient Name *" value="" name="patientname" id="patientname" required />
              <div class="invalid-feedback">
                Please Enter Patient Name.
              </div>
          </div> 
          <div class="form-group col-md-6">
              <label for="mobilenumbe">Mobile No</label>
              <input type="text" maxlength="10" minlength="10" class="form-control" placeholder="Mobile Number *" name="mobilenumber" id="mobilenumber" value="" required />
            <div class="invalid-feedback">
                 Please Enter Mobile No.
             </div>
          </div>
          <div class="form-group col-md-12">
              <label for="email">Email</label>
              <input type="email" class="form-control" placeholder="Email *" onBlur="checkemail(this.value)"
                                            name="loginid" id="loginid" value="" required />
                <span id="emsg" class="text-danger"></span>
                <div class="invalid-feedback">
                               Please Enter Email.
                </div>
          </div>
          <div class="form-group col-md-4">
             <label for="select3">Gender</label>
              <select name="select3" id="select3" class="form-control" required>
                  <option    selected disabled value="">Gender</option>
                    <?php
                           $arr = array("MALE","FEMALE");
                           foreach($arr as $val)
                            {
                              if($val == $rsedit[gender])
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
              <div class="invalid-feedback">
                Please Select Gender.
              </div>
          </div>
          <div class="form-group col-md-4">
              <label for="dateofbirth">Date of birth</label>
               <input type="Date" class="form-control"  value="DOB" name="dateofbirth" required />
              <div class="invalid-feedback">
                Please provide DOB.
              </div>
          </div>
          <div class="form-group col-md-4">
              <label for="select2">Blood Group</label>
                <select class="form-control " name="select2" id="select2" required>
                  <option   selected disabled value="">Select Blood Group</option>
                <?php
               $arr = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
                foreach($arr as $val)
                 {
                  if($val == $rsedit[bloodgroup])
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
            <div class="invalid-feedback">
              Please Select bloodgroup.
            </div>
         </div>
         <div class="form-group col-md-6">
              <label for="password">Password</label>
              <input type="password" class="form-control" placeholder="Password *" name="password" id="password" value="" required />
              <div class="invalid-feedback">
                Please Enter Password.
              </div>
        </div>
        <div class="form-group col-md-6">
              <label for="confirmpassword">Confirm Password</label>
                 <input type="password" class="form-control"  placeholder="Confirm Password *" name="confirmpassword" id="confirmpassword" value="" onChange ="matchPassword();" required />
                 
                 <div
                    id = "message2" style="color:red">
                 </div>
            <div class="invalid-feedback">
          
              Please Enter Confirm Password.
            </div>
        </div>
        <div class="form-group col-md-5">
                <label for="address">Address</label>
                   <input type="text" class="form-control" placeholder="Address *" value="" name="address" id="address" required />
            <div class="invalid-feedback">
              Please Enter Address.
            </div>
        </div>
        <div class="form-group col-md-4">
                  <label for="city">City</label>
                  <input type="text"  class="form-control" placeholder="City *" name="city" id="city" value="" required />
          <div class="invalid-feedback">
            Please Enter City.
          </div>
        </div>   
        
        
        <div class="form-group col-md-3">
              <label for="pincode">Pincode</label>
                  <input type="text" maxlength="10" minlength="10" class="form-control" placeholder="Pincode *" name="pincode" id="pincode" value="" required />
          <div class="invalid-feedback">
             Please provide Pin no.
          </div>
        </div>
        <div class="col-md-6">
          <input type="submit" class="btnRegister" name="submit" id="submit" value="Register"/> 
        </div>
  </form>
</div>


<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

</script>





