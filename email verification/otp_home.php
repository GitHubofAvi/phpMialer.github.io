<?php
session_start();
if(!isset($_SESSION['username'])){
    echo "please login first";
}
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
    <?php
   session_destroy();
    if(isset($_SESSION['username'])){
        $output = $_SESSION['username'];
        ?> Hello I am <?php echo  $output;
        ?><br><br> 
    <button><a href="logout.php">Click to Logout</a></button><?php
    }?>
    
    <?php
   ?>
    <button><a href="login.php">click to login</a></button>
    
</body>
</html>