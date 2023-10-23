<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';



require_once 'admin/islem/baglanti.php';

if (isset($_POST['sifremiunuttum'])) {


    $kadi=$_POST['kadi'];


    $kullanicisor=$baglanti->prepare("SELECT * from kullanicilar where kullanici_adi=:kullanici_adi  and kullanici_yetki=:kullanici_yetki ");
    $kullanicisor->execute(array(
    'kullanici_adi'=>$kadi,
    'kullanici_yetki'=>1
    ));
    $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
    $var=$kullanicisor->rowCount();
    // print_r($var);
    $id=$kullanicicek['kullanici_id'];
    $email=$kullanicicek['kullanici_mail'];
    if ($var=="0") {
        echo "Kullanıcıyı bulamadım";
    }
    else{
    $sifreolustur=rand(100,90800000);
    $sifreharf="aou";
    $sifreharf2="mhg";
    $yenisifre=$sifreharf.$sifreolustur.$sifreharf2;

    $md5sifre=md5($yenisifre);

    #veritabanı yükleme işlemleri

        $sifreunuttum=$baglanti->prepare("UPDATE kullanicilar SET 
            kullanici_sifre=:kullanici_sifre
            WHERE kullanici_id=$id
            ");
        $update=$sifreunuttum->execute(array(

            'kullanici_sifre'=>$md5sifre
        ));

        if ($update) {
            $mail = new PHPMailer(true);
            try {
                // $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = '883768c12cac21';                     //SMTP username
                $mail->Password   = 'dcace4f8a41a81';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                $mail->Port       = 465; 
                $mail->CharSet='UTF-8';        

                $mail->setFrom("zirem.beyter@gmail.com", 'Mailer');
                $mail->addAddress( $email, "irem beyter");     //Add a recipient

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "Şifre İşlemleri";
                $mail->Body    = "Merhaba, sisteme geçici olarak aşağıdaki şifre ile giriş yapabilirsiniz : ".$yenisifre;
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'gönderildi';
            } catch (Exception $e) {
                echo "gönderilmedi: {$mail->ErrorInfo}";
                // echo"<pre>";print_r($e);
            }

        }

    }

}

 ?>