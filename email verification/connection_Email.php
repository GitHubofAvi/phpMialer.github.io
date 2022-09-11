
<?php 
$username = "root";
$password = "";
$database = "email verification";
$server = "localhost";

$con = mysqli_connect($server,$username,$password,$database);
if($con){

}else{
   ?>
   <script>
       die("no connection".mysqli_connect_error());
   </script>
   <?php
}

?>