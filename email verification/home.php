<?php
session_start();

if(!isset($_SESSION['username'])){
echo"you are logged out!!";
    header('location:login.php');
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
    Hello I am <?php echo $_SESSION['username']; ?><br><br>
    <button><a href="logout.php">Click to Logout</a></button>
</body>
</html>