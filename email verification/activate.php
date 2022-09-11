<?php
session_start();
include 'connection_Email.php';
if(isset($_GET['token'])){
    $table_token = $_GET['token'];
    $update_token = "update verification set status = 'active' where token= '$table_token'";
    $query = mysqli_query($con, $update_token);
    if($query){
        if(isset($_SESSION['msg'])){
          echo  $_SESSION['msg']= "Account updated successfully";
        }else{
           echo $_SESSION['msg'] = "You are logged out";
            header('location:login.php');
        }
    }else{
     echo  $_SESSION['msg'] = "Account not updated";
        header('location:signup.php');
    }
}

?>