<?php
session_start(); //ise tabhi destroy krenge jab session ko khatam krna ho// 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div><p bgcolor='white' text='green'><?php 
include 'connection_Email.php';
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
    }?>
    </p></div>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method= "post">
        <input type="number" placeholder="enter your otp here" name="otp"><br><br>
        <input type="submit" value="verify" name="submit">
    </form>
    <?php
   
      if(isset($_POST['submit'])){
        $otp = $_POST['otp'];
                if(isset($otp)){
                  
                  $update_token = "update verification set status = 'active' where token ='$otp'";
                  $query = mysqli_query($con, $update_token);
                  if($query){
                    // $select = "select * from verification where token = '$otp' and status = 'active'";
                    // $s_query = mysqli_query($con, $select);
                   
                    echo  $_SESSION['msg']= "Account verified successfully";
                    header('location:otp_home.php');
                    // if($s_query){
                       
                    // } 
                  }
                  
                }else{
                   echo $_SESSION['msg'] = "You are logged out, please enter your otp first";
                    header('location:login.php');
                }
      }
    ?>
    
</body>
</html>
