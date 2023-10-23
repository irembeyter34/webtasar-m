<?php
session_start();
require_once 'admin/islem/baglanti.php';

if(isset($_POST['login'])) {
        $kadi=htmlspecialchars ($_POST['kadi']);
        $sifre=htmlspecialchars($_POST['sifre']);
        $sifreguclu=md5($sifre);
        // echo $sifreguclu;
        
    
        $kullanicisor=$baglanti->prepare("SELECT * FROM kullanicilar WHERE
         kullanici_adi=:kullanici_adi AND kullanici_sifre=:kullanici_sifre AND kullanici_yetki=:kullanici_yetki");
         $kullanicisor->execute(array(
            'kullanici_adi'=>$kadi,
            'kullanici_sifre'=>$sifreguclu,
            'kullanici_yetki'=>1
            //normal kullanıcının yetkisi 1, admin kullanıcı yetkisi 2'dir.
         ));
         $var=$kullanicisor->rowCount();
         if ($var>0) {
            $_SESSION['normalgiris']=$kadi;
            header("Location:index?durum=hosgeldin");
    
    
         }else{
            header("Location:giris?durum=hata");
         }
    }

    if(isset($_POST['register'])) {

        $kadi=htmlspecialchars($_POST['kadi']);
        $sifre=htmlspecialchars($_POST['sifre']);
        $sifrem=md5($sifre);
        $sifreiki=htmlspecialchars($_POST['sifretekrar']);
        $mail=htmlspecialchars($_POST['email']);
        $adsoyad=htmlspecialchars($_POST['adsoyad']);

        $kullanicisor=$baglanti->prepare("SELECT * FROM kullanicilar WHERE
        kullanici_adi=:kullanici_adi  AND kullanici_yetki=:kullanici_yetki OR kullanici_mail=:kullanici_mail");
        $kullanicisor->execute(array(
           'kullanici_adi'=>$kadi,
           'kullanici_yetki'=>2,
           'kullanici_mail'=>$mail
        ));
        $var=$kullanicisor->rowCount();

        if($var>0) {
            header("location:giris?durum=kullanicivar");
        } else {
            if ($sifre==$sifreiki) {
                if (strlen($sifre)>=8) {
                    $kullanıcıkaydet=$baglanti->prepare("INSERT INTO kullanicilar SET
                    kullanici_adi=:kullanici_adi,
                    kullanici_sifre=:kullanici_sifre,
                    kullanici_adsoyad=:kullanici_adsoyad,
                    kullanici_yetki=:kullanici_yetki,
                    kullanici_mail=:kullanici_mail
                    ");
                    $insert=$kullanıcıkaydet->execute(array(
                        'kullanici_adi'=>$kadi,
                        'kullanici_sifre'=>$sifrem,
                        'kullanici_adsoyad'=>$adsoyad,
                        'kullanici_yetki'=>1,
                        'kullanici_mail'=>$mail
                    ));
                    if($insert){
                       header("Location:kullanici?yuklenme=basarili");
                    }else{
                        header("Location:giris?yuklenme=basarisiz");
                    }
                }
                else {
                    header("location:giris?durum=sifreeksik");
                }
            } else {
                header("location:giris?durum=sifrehata");
            }
        }
    }

    if (isset($_POST['sepeteekle'])) {
       $id=$_POST['urunid'];
       $adet= $_POST['adet'];

       setcookie ('sepet['.$id.']', $adet , strtotime("+7day"));

       header("location:sepet?durum=eklendi");


    }

    if (isset($_GET['sepetsil'])) {
        $id=$_GET['id'];
        $adet= $_GET['adet'];
 
        setcookie ('sepet['.$id.']', $adet , strtotime("-7day"));
 
        header("location:sepet?durum=silindi");
 
 
     }

     if (isset($_POST['alisverisbitir'])) {

        $toplamfiyat=$_POST['toplamfiyat'];
        $kadi=$_POST['kadi'];
        //error_reporting(E_ALL);//tüm hataları göster;
        //ini_set("display_errors","on");//sunucudaki hataları göstermeyle ilgili display error off sa bile burası bize hataları gösterir!!!

        foreach ($_COOKIE['sepet'] as $key => $value) {
        
            $urunler=$baglanti->prepare("SELECT * FROM  urunler where urun_id=:urun_id  order by urun_sira ASC");
            $urunler->execute(array(
                'urun_id'=>$key
    
    
            ));
            $urunlercek=$urunler->fetch(PDO::FETCH_ASSOC);
            $fiyat=$urunlercek['urun_fiyat'];

    
            $alisveriskaydet=$baglanti->prepare("INSERT into siparisler SET 
    
                kullanici_id=:kullanici_id,
                urun_id=:urun_id,
                urun_adet=:urun_adet,
    
                urun_fiyat=:urun_fiyat,
                toplam_fiyat=:toplam_fiyat,
                odeme_turu=:odeme_turu,
                siparis_onay=:siparis_onay
                ");
    
            $insert=$alisveriskaydet->execute(array(
                'kullanici_id'=>$kadi,
                'urun_id'=>$key,
                'urun_adet'=>$value,
                'urun_fiyat'=>$fiyat,
                'toplam_fiyat'=>$toplamfiyat,
                'odeme_turu'=>$_POST['odeme'],
                'siparis_onay'=>0
            ));
        }
        if ($insert) {
            header("Location:index?durum=tesekkur");
        }
        else{
            header("Location:index?durum=basarisiz");
        }
        
    }

if (isset($_POST['sifreduzenle'])) {
$eskisifre=htmlspecialchars($_POST['eskisifre']);
$yenisifre=htmlspecialchars($_POST['yenisifre']);
$yenisifretekrar=htmlspecialchars($_POST['yenitekrar']);
$kullaniciid=$_POST['kullaniciid'];
$md5sifre=md5($eskisifre);
$yenisifremd5=md5($yenisifre);
       
$kullanicisor=$baglanti->prepare("SELECT * from kullanicilar where kullanici_id=:kullanici_id  ");
$kullanicisor->execute(array(
'kullanici_id'=>$kullaniciid
 ));
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
$veritabanisifre=$kullanicicek['kullanici_sifre'];

if ($md5sifre==$veritabanisifre) {
    if ($yenisifre==$yenisifretekrar) {
	$duzenle=$baglanti->prepare("UPDATE kullanicilar SET 
		kullanici_sifre=:kullanici_sifre
		WHERE kullanici_id=$kullaniciid
		");
	$update=$duzenle->execute(array(
		'kullanici_sifre'=>$yenisifremd5
	));
	if ($update) {
		header("Location:../sifremidegistir.php?durum=basarili");
	}
	else{
		header("Location:../sifremidegistir.php?durum=basarisiz");
	}
}
    else{
	Header("Location:sifremidegistir?durum=ikisifreaynigir");
    }

}
else{
	Header("Location:sifremidegistir?durum=sifrefarkli");
}
}

    if (isset($_POST['aboneol'])) {

    $aboneol=$baglanti->prepare("INSERT INTO abone SET
    abone_email=:abone_email
    ");
    $insert=$aboneol->execute(array(
        'abone_email'=>$_POST['abone']
    ));
    if($insert){
       header("Location:index?yuklenme=basarili");
    }else{
        header("Location:index?yuklenme=basarisiz");
    }
    }


            

    
?>