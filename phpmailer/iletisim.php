<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';


// echo 1; //isteğim geliyor mu kontrolü?
// print_r($_POST);

if(isset($_POST['mailgonder'])){

$adsoyad=$_POST['adsoyad'];
$email=$_POST['email'];
$konu=$_POST['konu'];
$mesaj=$_POST['mesaj'];

$mail = new PHPMailer(true);
//Load Composer's autoloader
//Create an instance; passing `true` enables exceptions
try {
    $envFile ='../env';
     if (file_exists($envFile)) { $envVars = parse_ini_file($envFile);
        $host = $envVars['MAIL_HOST'];
        $username = $envVars['MAIL_USERNAME']; 
        $password = $envVars['MAIL_PASSWORD'];
        $port = $envVars['MAIL_PORT'];
        $auth = $envVars['MAIL_AUTH'];
        $secure = $envVars['MAIL_SECURE'];
        } else 
         {echo ".env dosyası bulunamadı.";
            exit();
         }

    // print_r([$host,$username]);exit();
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $host;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = $auth;                                   //Enable SMTP authentication
    $mail->Username   = $username;                     //SMTP username
    $mail->Password   = $password;                               //SMTP password
    $mail->SMTPSecure = $secure;            //Enable implicit TLS encryption
    $mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
    //Recipients
    $mail->setFrom("zirem.beyter@gmail.com", 'Mailer');
    $mail->addAddress( $email, $adsoyad);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo("$email", 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "$konu";
    $mail->Body    = "$mesaj";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'gönderildi';
} catch (Exception $e) {
    echo "gönderilmedi: {$mail->ErrorInfo}";
	// echo"<pre>";print_r($e);
}
}