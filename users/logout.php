

<?php  
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
 
?>
<script>
window.location="http://localhost/e-health/login_page.php";
</script>
<?php
//to redirect back to "index.php" after logging out
  exit;
?>