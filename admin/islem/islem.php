<?php
@session_start();
require_once 'baglanti.php';

if(isset($_POST['ayarkaydet'])){
    $duzenle=$baglanti->prepare("UPDATE ayarlar SET
    baslik=:baslik,
    aciklama=:aciklama,
    anahtarkelime=:anahtarkelime
    WHERE id=1    
    ");
    $update=$duzenle->execute(array(
        'baslik'=>$_POST['baslik'],
        'aciklama'=>$_POST['aciklama'],
        'anahtarkelime'=>$_POST['anahtarkelime']
        
    ));
    if($update){
       header("Location:../ayarlar.php?yuklenme=basarili");
    }else{
        header("Location:../ayarlar.php?yuklenme=basarisiz");
    }
}

if(isset($_POST['iletisimkaydet'])){
    $duzenle=$baglanti->prepare("UPDATE ayarlar SET
    telefon=:telefon,
    email=:email,
    adres=:adres,
    mesai=:mesai
    WHERE id=1    
    ");
    $update=$duzenle->execute(array(
        'telefon'=>$_POST['telefon'],
        'email'=>$_POST['email'],
        'adres'=>$_POST['adres'],
        'mesai'=>$_POST['mesai']
        
    ));
    if($update){
       header("Location:../iletisim.php?yuklenme=basarili");
    }else{
        header("Location:../iletisim.php?yuklenme=basarisiz");
    }
}

if(isset($_POST['sosyalmedyakaydet'])){
    $duzenle=$baglanti->prepare("UPDATE ayarlar SET
    facebook=:facebook,
    instagram=:instagram,
    twitter=:twitter,
    youtube=:youtube
    WHERE id=1    
    ");
    $update=$duzenle->execute(array(
        'facebook'=>$_POST['facebook'],
        'instagram'=>$_POST['instagram'],
        'twitter'=>$_POST['twitter'],
        'youtube'=>$_POST['youtube']
        
    ));
    if($update){
       header("Location:../sosyalmedya.php?yuklenme=basarili");
    }else{
        header("Location:../sosyalmedya.php?yuklenme=basarisiz");
    }
}

if(isset($_POST['logokaydet'])){
    $uploads_dir='../resimler/logo';
    @$tmp_name=$_FILES['logo'] ["tmp_name"];
    @$name=$_FILES['logo'] [""];

    $sayi=rand(1,1000000);
    $sayi2=rand(1,1000000);
    $sayi3=rand(10000,2000000);

    $sayilar=$sayi.$sayi2.$sayi3;
    $resimyolu=$sayilar.$name;

    @move_uploaded_file($tmp_name,"$uploads_dir/$sayilar$name");

    $duzenle=$baglanti->prepare("UPDATE ayarlar SET
    logo=:logo
    WHERE id=1    
    ");
    $update=$duzenle->execute(array(
        'logo'=>$resimyolu //resimyolu değişkenini kullanmamızın sebebi biz yukarıda sayısını ve name'i aldık.

        
    ));
    if($update){
        $resimsil=$_POST['eskilogo'];
        unlink(("../resimler/logo/$resimsil"));
        
       header("Location:../ayarlar.php?yuklenme=basarili");
    }else{
        header("Location:../ayarlar.php?yuklenme=basarisiz");
    }


}
if(isset($_POST['hakkimizdakaydet'])){
    if($_FILES['resim'] ['size']>0) {

    $uploads_dir='../resimler/hakkimizda';
    @$tmp_name=$_FILES['resim'] ["tmp_name"];
    @$name=$_FILES['resim'] [""];

    $sayi=rand(1,1000000);
    $sayi2=rand(1,1000000);
    $sayi3=rand(10000,2000000);

    $sayilar=$sayi.$sayi2.$sayi3;
    $resimyolu=$sayilar.$name;

    @move_uploaded_file($tmp_name,"$uploads_dir/$sayilar$name");

        $duzenle=$baglanti->prepare("UPDATE hakkimizda SET
        hakkimizda_baslik=:hakkimizda_baslik,
        hakkimizda_detay=:hakkimizda_detay,
        hakkimizda_misyon=:hakkimizda_misyon,
        hakkimizda_vizyon=:hakkimizda_vizyon,
        hakkimizda_resim=:hakkimizda_resim
        WHERE hakkimizda_id=1    
        ");
        $update=$duzenle->execute(array(
            'hakkimizda_baslik'=>$_POST['hakkimizda_baslik'],
            'hakkimizda_detay'=>$_POST['hakkimizda_detay'],
            'hakkimizda_misyon'=>$_POST['hakkimizda_misyon'],
            'hakkimizda_vizyon'=>$_POST['hakkimizda_vizyon'],
            'hakkimizda_resim'=>$resimyolu
            
        ));
        if($update){
           header("Location:../hakkimizda.php?yuklenme=basarili");
        }else{
            header("Location:../hakkimizda.php?yuklenme=basarisiz");
        }
    }else{
        $duzenle=$baglanti->prepare("UPDATE hakkimizda SET
        hakkimizda_baslik=:hakkimizda_baslik,
        hakkimizda_detay=:hakkimizda_detay,
        hakkimizda_misyon=:hakkimizda_misyon,
        hakkimizda_vizyon=:hakkimizda_vizyon
        WHERE hakkimizda_id=1    
        ");
        $update=$duzenle->execute(array(
            'hakkimizda_baslik'=>$_POST['hakkimizda_baslik'],
            'hakkimizda_detay'=>$_POST['hakkimizda_detay'],
            'hakkimizda_misyon'=>$_POST['hakkimizda_misyon'],
            'hakkimizda_vizyon'=>$_POST['hakkimizda_vizyon']
            
        ));
        if($update){
            $resimsil=$_POST['eskiresim'];
            unlink(("../resimler/hakkimizda/$resimsil"));

           header("Location:../hakkimizda.php?yuklenme=basarili");
        }else{
            header("Location:../hakkimizda.php?yuklenme=basarisiz");
        }
    }
}

if (isset($_POST['girisyap'])) {
    $kadi=htmlspecialchars ($_POST['kadi']);
    $sifre=htmlspecialchars($_POST['sifre']);
    $sifreguclu=md5($sifre);
    // echo $sifreguclu;
    

    $kullanicisor=$baglanti->prepare("SELECT * FROM kullanicilar WHERE
     kullanici_adi=:kullanici_adi AND kullanici_sifre=:kullanici_sifre AND kullanici_yetki=:kullanici_yetki");
     $kullanicisor->execute(array(
        'kullanici_adi'=>$kadi,
        'kullanici_sifre'=>$sifreguclu,
        'kullanici_yetki'=>2
     ));
     $var=$kullanicisor->rowCount();
     if ($var>0) {
        $_SESSION['girisbelgesi']=$kadi;
        header("Location:../index?durum=hosgeldin");
     }else{
        header("Location:../login?durum=hata");
     }
}
//yetki 1 normal yetki2 admin
if(isset($_POST['uyelerkaydet'])){
    $kadi=htmlspecialchars ($_POST['kadi']);
    $sifre=htmlspecialchars($_POST['sifre']);
    $adsoyad=htmlspecialchars($_POST['adsoyad']);
    $sifreguclu=md5($sifre);

    $kullanicisor=$baglanti->prepare("SELECT * FROM kullanicilar WHERE
     kullanici_adi=:kullanici_adi AND kullanici_yetki=:kullanici_yetki ");
     $kullanicisor->execute(array(
        'kullanici_adi'=>$kadi,
        'kullanici_yetki' =>2
        ));

        $var=$kullanicisor->rowCount();
        if($var>0){
            header("Location:../uyeler-ekle?yuklenme=kullanicivar");
        }else{
            header("Location:../uyeler-ekle?yuklenme=kullaniciyok");
        }

    $uploads_dir='../resimler/kullanici';
    @$tmp_name=$_FILES['resim'] ["tmp_name"];
    @$name=$_FILES['resim'] [""];

    $sayi=rand(1,1000000);
    $sayi2=rand(1,1000000);
    $sayi3=rand(10000,2000000);

    $sayilar=$sayi.$sayi2.$sayi3;
    $resimyolu=$sayilar.$name;

    @move_uploaded_file($tmp_name,"$uploads_dir/$sayilar$name");




    $kullanıcıkaydet=$baglanti->prepare("INSERT INTO kullanicilar SET
    kullanici_adi=:kullanici_adi,
    kullanici_sifre=:kullanici_sifre,
    kullanici_adsoyad=:kullanici_adsoyad,
    kullanici_yetki=:kullanici_yetki,
    kullanici_resim=:kullanici_resim
    ");
    $insert=$kullanıcıkaydet->execute(array(
        'kullanici_adi'=>$kadi,
        'kullanici_sifre'=>$sifreguclu,
        'kullanici_adsoyad'=>$adsoyad,
        'kullanici_yetki'=>2,
        'kullanici_resim'=>$resimyolu
    ));
    if($insert){
       header("Location:../uyeler?yuklenme=basarili");
    }else{
        header("Location:../uyeler?yuklenme=basarisiz");
    }
}

if(isset($_GET['kullanicisil'])){

    $kullanicisil=$baglanti->prepare("DELETE FROM kullanicilar WHERE kullanici_id=:kullanici_id");
    $kullanicisil->execute(array(
        'kullanici_id'=>$_GET['id']
    ));
    if($kullanicisil){
        header("Location:../uyeler?durum=basarili");
    }else{
        header("Location:../uyeler?durum=hata");     
    }
} 

if(isset($_POST['kategorikaydet'])) {

    $kategorikaydet=$baglanti->prepare("INSERT INTO kategoriler SET
    kategori_adi=:kategori_adi,
    kategori_sira=:kategori_sira,
    kategori_durum=:kategori_durum
    ");
    $insert=$kategorikaydet->execute(array(
        'kategori_adi'=>$_POST['katadi'],
        'kategori_sira'=>$_POST['sira'],
        'kategori_durum'=>$_POST['kategoridurum']
    ));
    if($insert){
       header("Location:../kategori?yuklenme=basarili");
    }else{
        header("Location:../kategori?yuklenme=basarisiz");
    }
}
if(isset($_POST['kategoriduzenle'])){
    $kat=$_POST['katid'];

    $duzenle=$baglanti->prepare("UPDATE kategoriler SET
    kategori_adi=:kategori_adi,
    kategori_sira=:kategori_sira,
    kategori_durum=:kategori_durum
    WHERE
    kategori_id = $kat  
    ");
    $update=$duzenle->execute(array(
        'kategori_adi'=>$_POST['katadi'],
        'kategori_sira'=>$_POST['sira'],
        'kategori_durum'=>$_POST['kategoridurum']
        
    ));
    if($update){
       header("Location:../kategori.php?yuklenme=basarili");
    }else{
        header("Location:../sosyalmedya.php?yuklenme=basarisiz");
    }
}
if(isset($_GET['kategorisil'])){

    $kategorisil=$baglanti->prepare("DELETE FROM kategoriler WHERE kategori_id=:kategori_id");
    $kategorisil->execute(array(
        'kategori_id'=>$_GET['id']
    ));
    if($kategorisil){
        header("Location:../kategori?yuklenme=basarili");
    }else{
        header("Location:../kategori?yuklenme=hata");     
    }
} 
if (isset($_POST['sliderkaydet'])) {


	$uploads_dir='../resimler/slider';
	@$tmp_name= $_FILES['slideresim'] ["tmp_name"];
	@$name= $_FILES['slideresim'] ["name"];


	$sayi=rand(1,1000000);
	$sayi2=rand(1,100000);
	$sayi3=rand(10000, 20000000);


	$sayilar=$sayi.$sayi2.$sayi3;
	$resimyolu=$sayilar.$name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$sayilar$name");
	$sliderkaydet=$baglanti->prepare("INSERT into slider SET 

		
		

		
		
		
		
		

		slider_baslik=:slider_baslik,
		slider_aciklama=:slider_aciklama,
		slider_sira=:slider_sira,
		slider_link=:slider_link,
		slider_button=:slider_button,
		slider_durum=:slider_durum,
		slider_banner=:slider_banner,
		slider_resim=:slider_resim


		");

	$insert=$sliderkaydet->execute(array(
		'slider_baslik'=>$_POST['sliderbaslik'],
		'slider_aciklama'=>$_POST['slideraciklama'],
		'slider_sira'=>$_POST['slidersira'],
		'slider_link'=>$_POST['sliderlink'],
		'slider_button'=>$_POST['sliderbutton'],
		'slider_durum'=>$_POST['sliderdurum'],
		'slider_banner'=>$_POST['sliderbanner'],
		'slider_resim'=>$resimyolu




	));
	if ($insert) {

		header("Location:../slider?yuklenme=basarili");
	}
	else{
		header("Location:../slider?yuklenme=basarisiz");
	}

}


if (isset($_POST['sliderduzenle'])) {

	$slideid=$_POST['id'];

	if ($_FILES['slideresim']   ["size"]>0) {

		$uploads_dir='../resimler/slider';
		@$tmp_name= $_FILES['slideresim'] ["tmp_name"];
		@$name= $_FILES['slideresim'] ["name"];


		$sayi=rand(1,1000000);
		$sayi2=rand(1,100000);
		$sayi3=rand(10000, 20000000);


		$sayilar=$sayi.$sayi2.$sayi3;
		$resimyolu=$sayilar.$name;

		@move_uploaded_file($tmp_name, "$uploads_dir/$sayilar$name");
		$duzenle=$baglanti->prepare("UPDATE slider SET 



			slider_baslik=:slider_baslik,
			slider_aciklama=:slider_aciklama,
			slider_sira=:slider_sira,
			slider_link=:slider_link,
			slider_button=:slider_button,
			slider_durum=:slider_durum,
			slider_banner=:slider_banner,
			slider_resim=:slider_resim

			WHERE slider_id=$slideid

			");

		$update=$duzenle->execute(array(

			'slider_baslik'=>$_POST['sliderbaslik'],
			'slider_aciklama'=>$_POST['slideraciklama'],
			'slider_sira'=>$_POST['slidersira'],
			'slider_link'=>$_POST['sliderlink'],
			'slider_button'=>$_POST['sliderbutton'],
			'slider_durum'=>$_POST['sliderdurum'],
			'slider_banner'=>$_POST['sliderbanner'],
			'slider_resim'=>$resimyolu


		));
		if ($update) {

			$resimsil=$_POST['eskiresim'];
			unlink("../resimler/slider/$resimsil");

			header("Location:../slider.php?yuklenme=basarili");
		}
		else{
			header("Location:../slider.php?yuklenme=basarisiz");
		}




	}
	else{

		$duzenle=$baglanti->prepare("UPDATE slider SET 



			slider_baslik=:slider_baslik,
			slider_aciklama=:slider_aciklama,
			slider_sira=:slider_sira,
			slider_link=:slider_link,
			slider_button=:slider_button,
			slider_durum=:slider_durum,
			slider_banner=:slider_banner
			WHERE slider_id=$slideid

			");

		$update=$duzenle->execute(array(

			'slider_baslik'=>$_POST['sliderbaslik'],
			'slider_aciklama'=>$_POST['slideraciklama'],
			'slider_sira'=>$_POST['slidersira'],
			'slider_link'=>$_POST['sliderlink'],
			'slider_button'=>$_POST['sliderbutton'],
			'slider_durum'=>$_POST['sliderdurum'],
			'slider_banner'=>$_POST['sliderbanner']


		));
		if ($update) {

			header("Location:../slider.php?yuklenme=basarili");
		}
		else{
			header("Location:../slider.php?yuklenme=basarisiz");
		}
	}
}




if (isset($_POST['slidersil'])) {


	$slidersil=$baglanti->prepare("DELETE from  slider where slider_id=:slider_id ");

	$slidersil->execute(array(
		'slider_id'=>$_POST['id']


	));

	if ($slidersil) {

		$resimsil=$_POST['resim'];
		unlink("../resimler/slider/$resimsil");
		Header("Location:../slider?yuklenme=basarili");
	}
	else{
		Header("Location:../slider?yuklenme=hata");
	}
}






















if (isset($_POST['urunlerkaydet'])) {

    $yonlendir=$_POST['katsid'];
        $uploads_dir='../resimler/urunler';
        @$tmp_name= $_FILES['urunleresim'] ["tmp_name"];
        @$name= $_FILES['urunleresim'] ["name"];
    
    
        $sayi=rand(1,1000000);
        $sayi2=rand(1,100000);
        $sayi3=rand(10000, 20000000);
    
    
        $sayilar=$sayi.$sayi2.$sayi3;
        $resimyolu=$sayilar.$name;
    
        @move_uploaded_file($tmp_name, "$uploads_dir/$sayilar$name");
        $urunlerkaydet=$baglanti->prepare("INSERT into urunler SET 
    
    
    
            kategori_id=:kategori_id,
            urun_baslik=:urun_baslik,
            urun_aciklama=:urun_aciklama,
            urun_sira=:urun_sira,
            urun_model=:urun_model,
    
            urun_renk=:urun_renk,
            urun_adet=:urun_adet,
            urun_fiyat=:urun_fiyat,
            urun_etiket=:urun_etiket,
            urun_durum=:urun_durum,
            onecikan=:onecikan,
            urun_resim=:urun_resim
    
    
            ");
    
        $insert=$urunlerkaydet->execute(array(
            'kategori_id'=>$_POST['urunkategori'],
            'urun_baslik'=>$_POST['urunlerbaslik'],
            'urun_aciklama'=>$_POST['urunleraciklama'],
            'urun_sira'=>$_POST['urunlersira'],
            'urun_model'=>$_POST['urunlermodel'],
    
            'urun_renk'=>$_POST['urunlerrenk'],
            'urun_adet'=>$_POST['urunleradet'],
            'urun_fiyat'=>$_POST['urunlerfiyat'],
            'urun_etiket'=>$_POST['urunleranahtar'],
            'urun_durum'=>$_POST['urunlerdurum'],
            'onecikan'=>$_POST['urunleronecikar'],
            'urun_resim'=>$resimyolu
    
    
    
    
        ));
        if ($insert) {
    
            header("Location:../urunler?katid=$yonlendir&yuklenme=basarili");
        }
        else{
            header("Location:../urunler?katid=$yonlendir&yuklenme=basarisiz");
        }
    
    }
    
    
    if (isset($_POST['urunduzenle'])) {
        $yonlendir=$_POST['katsid'];
    
        $urunid=$_POST['id'];
    
        if ($_FILES['urunleresim']   ["size"]>0) {
    
            $uploads_dir='../resimler/urunler';
            @$tmp_name= $_FILES['urunleresim'] ["tmp_name"];
            @$name= $_FILES['urunleresim'] ["name"];
    
    
            $sayi=rand(1,1000000);
            $sayi2=rand(1,100000);
            $sayi3=rand(10000, 20000000);
    
    
            $sayilar=$sayi.$sayi2.$sayi3;
            $resimyolu=$sayilar.$name;
    
            @move_uploaded_file($tmp_name, "$uploads_dir/$sayilar$name");
            $duzenle=$baglanti->prepare("UPDATE urunler SET 
    
    
            kategori_id=:kategori_id,
            urun_baslik=:urun_baslik,
            urun_aciklama=:urun_aciklama,
            urun_sira=:urun_sira,
            urun_model=:urun_model,
    
            urun_renk=:urun_renk,
            urun_adet=:urun_adet,
            urun_fiyat=:urun_fiyat,
            urun_etiket=:urun_etiket,
            urun_durum=:urun_durum,
            onecikan=:onecikan,
            urun_resim=:urun_resim
    
    
                WHERE urun_id=$urunid
    
                ");
    
            $update=$duzenle->execute(array(
    
                
    'kategori_id'=>$_POST['urunkategori'],
            'urun_baslik'=>$_POST['urunlerbaslik'],
            'urun_aciklama'=>$_POST['urunleraciklama'],
            'urun_sira'=>$_POST['urunlersira'],
            'urun_model'=>$_POST['urunlermodel'],
    
            'urun_renk'=>$_POST['urunlerrenk'],
            'urun_adet'=>$_POST['urunleradet'],
            'urun_fiyat'=>$_POST['urunlerfiyat'],
            'urun_etiket'=>$_POST['urunleranahtar'],
            'urun_durum'=>$_POST['urunlerdurum'],
            'onecikan'=>$_POST['urunleronecikar'],
            'urun_resim'=>$resimyolu
    
            ));
            if ($update) {
    
                $resimsil=$_POST['eskiresim'];
                unlink("../resimler/urunler/$resimsil");
    
                header("Location:../urunler?katid=$yonlendir&yuklenme=basarili");
            }
            else{
            header("Location:../urunler?katid=$yonlendir&yuklenme=basarisiz");
            }
    
    
    
    
        }
        else{
    
            $duzenle=$baglanti->prepare("UPDATE urunler SET 
    
    
    kategori_id=:kategori_id,
            urun_baslik=:urun_baslik,
            urun_aciklama=:urun_aciklama,
            urun_sira=:urun_sira,
            urun_model=:urun_model,
    
            urun_renk=:urun_renk,
            urun_adet=:urun_adet,
            urun_fiyat=:urun_fiyat,
            urun_etiket=:urun_etiket,
            urun_durum=:urun_durum,
            onecikan=:onecikan
                WHERE urun_id=$urunid
    
                ");
    
            $update=$duzenle->execute(array(
    
                        
    'kategori_id'=>$_POST['urunkategori'],
            'urun_baslik'=>$_POST['urunlerbaslik'],
            'urun_aciklama'=>$_POST['urunleraciklama'],
            'urun_sira'=>$_POST['urunlersira'],
            'urun_model'=>$_POST['urunlermodel'],
    
            'urun_renk'=>$_POST['urunlerrenk'],
            'urun_adet'=>$_POST['urunleradet'],
            'urun_fiyat'=>$_POST['urunlerfiyat'],
            'urun_etiket'=>$_POST['urunleranahtar'],
            'urun_durum'=>$_POST['urunlerdurum'],
            'onecikan'=>$_POST['urunleronecikar']
    
    
            ));
            if ($update) {
    
            header("Location:../urunler?katid=$yonlendir&yuklenme=basarili");
            }
            else{
                header("Location:../urunler?katid=$yonlendir&yuklenme=basarisiz");
            }
        }
    }
    
    
    if (isset($_POST['urunlersil'])) {
    $yonlendir=$_POST['katsid'];
    
        $urunlersil=$baglanti->prepare("DELETE from  urunler where urun_id=:urun_id ");
    
        $urunlersil->execute(array(
            'urun_id'=>$_POST['id']
        ));
    
        if ($urunlersil) {
    
            $resimsil=$_POST['resim'];
            unlink("../resimler/urunler/$resimsil");
            header("Location:../urunler?katid=$yonlendir&yuklenme=basarili");
        }
        else{
                header("Location:../urunler?katid=$yonlendir&yuklenme=basarisiz");
        }
    }
    

    if (isset($_POST['cokluresimsil'])) {
        $yonlendir=$_POST['urunid'];
        
            $cokluresimsil=$baglanti->prepare("DELETE from  cokluresim where id=:id ");
        
            $cokluresimsil->execute(array(
                'id'=>$_POST['id']
               
            ));
        
            if ($cokluresimsil) {
        
                $resimsil=$_POST['resim'];
                unlink("../resimler/cokluresim/$resimsil");
                header("Location:../cokluresim?id=$yonlendir&yuklenme=basarili");
            }
            else{
                    header("Location:../cokluresim?id=$yonlendir&yuklenme=basarisiz");
            }
        }

        if (isset($_POST['kullaniciduzenle'])) {
            $id=$_POST['kullaniciid'];
        
            $duzenle=$baglanti->prepare("UPDATE kullanicilar SET 
        
                kullanici_adsoyad=:kullanici_adsoyad,
                kullanici_mail=:kullanici_mail,
                kullanici_adres=:kullanici_adres,
                kullanici_il=:kullanici_il,
                kullanici_ilce=:kullanici_ilce,
                kullanici_tel=:kullanici_tel
                WHERE kullanici_id=$id
                ");
            $update=$duzenle->execute(array(
        
                'kullanici_adsoyad'=>$_POST['adsoyad'],
                'kullanici_mail'=>$_POST['email'],
                'kullanici_adres'=>$_POST['adres'],
                'kullanici_il'=>$_POST['sehir'],
                'kullanici_ilce'=>$_POST['ilce'],
                'kullanici_tel'=>$_POST['telefon']
                
            ));
            if ($update) {
        
                header("Location:../../kullanici?yuklenme=basarili");
            }
            else{
                header("Location:../../kullanici?yuklenme=basarisiz");
            }
        
        
        
        }
        
        if (isset($_POST['Yorumkaydet'])) {
            $gelenurl=$_SERVER['HTTP_REFERER'];
                $yorumkaydet=$baglanti->prepare("INSERT into yorumlar SET 
            
            
            
                    yorum_detay=:yorum_detay,
                    urun_id=:urun_id,
                    kullanici_id=:kullanici_id,
                    yorum_onay=:yorum_onay
                    ");
            
                $insert=$yorumkaydet->execute(array(
                    'yorum_detay'=>$_POST['Yorum'],
                    'urun_id'=>$_POST['urunid'],
                    'kullanici_id'=>$_POST['kullaniciid'],
            
                    'yorum_onay'=>0
            
            
                ));
                if ($insert) {
            
                    header("Location:$gelenurl?yuklenme=basarili");
                }
                else{
                    header("Location:$gelenurl?yuklenme=basarisiz");
                }
            
            }

            if(isset($_POST['yorumonayla'])){
                $yorumid=$_POST['yorumid'];
                $duzenle=$baglanti->prepare("UPDATE yorumlar SET
                yorum_onay=:yorum_onay
                WHERE yorum_id=$yorumid 
                ");
                $update=$duzenle->execute(array(
                    'yorum_onay'=>1
                    
                ));
                if($update){
                   header("Location:../yorumlar.php?yuklenme=basarili");
                }else{
                    header("Location:../yorumlar.php?yuklenme=basarisiz");
                }
            }

            if(isset($_GET['yorumlarsil'])){

                $yorumlarsil=$baglanti->prepare("DELETE FROM yorumlar WHERE yorum_id=:yorum_id");
                $yorumlarsil->execute(array(
                    'yorum_id'=>$_GET['id']
                ));
                if($yorumlarsil){
                    header("Location:../yorumlar?durum=basarili");
                }else{
                    header("Location:../yorumlar?durum=hata");     
                }
            } 

            if(isset($_GET['siparisonayla'])){
                $siparisid=$_GET['id'];
                $duzenle=$baglanti->prepare("UPDATE siparisler SET
                siparis_onay=:siparis_onay
                WHERE siparis_id=$siparisid 
                ");
                $update=$duzenle->execute(array(
                    'siparis_onay'=>1
                    
                ));
                if($update){
                   header("Location:../siparisler.php?yuklenme=basarili");
                }else{
                    header("Location:../siparisler.php?yuklenme=basarisiz");
                }
            }

            if(isset($_GET['siparisreddet'])){
                $siparisid=$_GET['id'];
                $duzenle=$baglanti->prepare("UPDATE siparisler SET
                siparis_onay=:siparis_onay
                WHERE siparis_id=$siparisid 
                ");
                $update=$duzenle->execute(array(
                    'siparis_onay'=>0
                    
                ));
                if($update){
                   header("Location:../siparisler.php?yuklenme=basarili");
                }else{
                    header("Location:../siparisler.php?yuklenme=basarisiz");
                }
            }
            
            if(isset($_GET['abonesil'])){

                $abonesil=$baglanti->prepare("DELETE FROM abone WHERE abone_id=:abone_id");
                $abonesil->execute(array(
                    'abone_id'=>$_GET['id']
                ));
                if($abonesil){
                    header("Location:../abone?yuklenme=basarili");
                }else{
                    header("Location:../abone?yuklenme=hata");     
                }
            } 

            if(isset($_POST['siparisguncelle'])){
                $siparisid=$_POST['siparisnumara'];
            
                $duzenle=$baglanti->prepare("UPDATE siparisler SET
                siparis_yeniadet=:siparis_yeniadet,
                siparis_not=:siparis_not
                WHERE
                siparis_id=$siparisid  
                ");
                $update=$duzenle->execute(array(
                    'siparis_yeniadet'=>$_POST['yeniadet'],
                    'siparis_not'=>$_POST['not']
                    
                ));
                if($update){
                   header("Location:../../siparisler.php?yuklenme=guncellendi");
                }else{
                    header("Location:../../siparisler.php?yuklenme=basarisiz");
                }
            }

            if(isset($_POST['sipduzenle'])){
                $siparisid=$_POST['sipid'];
            
                $duzenle=$baglanti->prepare("UPDATE siparisler SET
                urun_adet=:urun_adet
                WHERE
                siparis_id=$siparisid  
                ");
                $update=$duzenle->execute(array(
                    'urun_adet'=>$_POST['adet']
                    
                ));
                if($update){
                   header("Location:../siparisler.php?yuklenme=guncellendi");
                }else{
                    header("Location:../siparisler.php?yuklenme=basarisiz");
                }
            }
            
?>