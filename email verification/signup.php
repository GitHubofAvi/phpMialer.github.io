
<?php
session_start(); //ise tabhi destroy krenge jab session ko khatam krna ho// 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// ob_start(); //used as a buffer which prevent the error//


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
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?> " method="post">
      <input type="text" placeholder="Enter Your name" name="name" required><br><br>
      <input type="email" placeholder="Enter Your Email" name="email" required><br><br>
      <input type="password" placeholder="Enter Your Password" name="password" required><br><br>
      
      <input type="Submit" value="Create Account" name="submit">
    </form><br><br>
    Already have an account? <a href="login.php">Login</a>
</body>
</html>

<?php
include 'connection_Email.php';

if(isset($_POST['submit'])){
$name = mysqli_real_escape_string($con, $_POST['name']);  
$email = mysqli_real_escape_string($con, $_POST['email']);     
$password = mysqli_real_escape_string($con, $_POST['password']);
// $Epassword = password_hash($password, PASSWORD_BCRYPT); //B_CRYPT -> Blowfish cryption//

$emailquery = "select * from verification where email = '$email' ";
$equery = mysqli_query($con, $emailquery);

$emailcount = mysqli_num_rows($equery);
$token = rand(1111111,9999999);
//$token = bin2hex(random_bytes(15));
if ($emailcount==0) {
    $insertquery = "insert into verification(username, email, password, token, status) 
    values('$name','$email','$password','$token','inactive')";    
    $iquery = mysqli_query($con, $insertquery);

    if($iquery){

        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/SMTP.php';
                $mail = new PHPMailer(true);
        
                try {         
                    $mail->isSMTP();                                    
                    $mail->Host       = 'smtp.gmail.com';               
                    $mail->SMTPAuth   = true;                           
                    $mail->Username   = 'prajapatiavinash67@gmail.com'; 
                    $mail->Password   = 'aaetammksveihlmk';             
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    
                    $mail->Port       = 465;                            
                
                    //Recipients
                    $mail->setFrom('prajapatiavinash67@gmail.com', 'Email Verification!!');
                    $mail->addAddress($email, $name);     
                    $mail->isHTML(true);                                  
                    $mail->Subject = 'Email Activation';
                    $mail->Body    = "<b>Hi, $name </b> <br>
                                     <!-- <h2><a href='http://localhost/phpMailer%20smtp/email%20verification/activate.php?token=$token'>
                                      Click here to activate your account</a></h2> -->
                                      <p>OTP for Email Verification <h1>$token</h1></p>";
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                    $mail->send();
                    $_SESSION['msg'] = "Hi, $name, OTP is sent to ($email), To verify, Plese check your Account";
                    header('location:otp.php');
                    // header('location:login.php');
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }else{
    echo "email already exists";
   
    }
}

?>
