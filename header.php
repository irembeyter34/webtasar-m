<?php
error_reporting(0);
session_start();
ob_start();
require_once 'admin/islem/baglanti.php';
require_once 'function.php';
$ayar=$baglanti->prepare("SELECT * FROM  ayarlar where id=?");
$ayar->execute(array(1));
$ayarcek=$ayar->fetch(PDO::FETCH_ASSOC);

 
$hakkimizda=$baglanti->prepare("SELECT * FROM  hakkimizda where hakkimizda_id=?");
$hakkimizda->execute(array(1));
$hakkimizdacek=$hakkimizda->fetch(PDO::FETCH_ASSOC);


 $kullanicisor=$baglanti->prepare("SELECT * from kullanicilar where kullanici_adi=:kullanici_adi  ");
 $kullanicisor->execute(array(
'kullanici_adi'=>$_SESSION['normalgiris']
 ));
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
// print_r($kullanicicek);
$var=$kullanicisor->rowCount();
// print_r($_SESSION);
?>
<!doctype html>
<html class="no-js" lang="zxx">
<!-- index28:48-->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
        <!-- Material Design Iconic Font-V2.2.0 -->
        <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Font Awesome Stars-->
        <link rel="stylesheet" href="css/fontawesome-stars.css">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="css/meanmenu.css">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <!-- Slick Carousel CSS -->
        <link rel="stylesheet" href="css/slick.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="css/animate.css">
        <!-- Jquery-ui CSS -->
        <link rel="stylesheet" href="css/jquery-ui.min.css">
        <!-- Venobox CSS -->
        <link rel="stylesheet" href="css/venobox.css">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="css/nice-select.css">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="css/magnific-popup.css">
        <!-- Bootstrap V4.1.3 Fremwork CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Helper CSS -->
        <link rel="stylesheet" href="css/helper.css">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="css/responsive.css">
        <!-- Modernizr js -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        
    </head>
    <body>
        <!-- Begin Body Wrapper -->
        <div class="body-wrapper">
            <!-- Begin Header Area -->
            <header>
            <div style="background-color: black;" class="header-top">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Top Left Area -->
                            <div class="col-lg-3 col-md-4">
                                <div class="header-top-left">
                                    <ul class="phone-wrap">
                                        <li><span style="color: white;">Telephone :</span><a style="color: white;" href="#"><?= $ayarcek['telefon'] ?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Left Area End Here -->
                            <!-- Begin Header Top Right Area -->
                            <div class="col-lg-9 col-md-8">
                                <div class="header-top-right">
                                    <ul class="ht-menu">
                                        <!-- Begin Setting Area -->
                                        <li>
                                            <div class="ht-setting-trigger"><span style="color: white;">Hesabım</span></div>
                                            <div class="setting ht-setting">
                                                <ul class="ht-setting-list">
                                                    <li><a href="kullanici">Hesabım</a></li>
                                                    <li><a href="sepet">Sepetim</a></li>
                                                    <li><a href="siparisler">Ürünlerim </a></li>
                                                    <li><a href="sifremidegistir">Şifre Değiştir </a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Top Area End Here -->
                <!-- Begin Header Middle Area -->
                <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Logo Area -->
                            <div class="col-lg-3">
                                <div class="logo pb-sm-30 pb-xs-30">
                                    <a href="index.html">
                                        <img src="images/menu/logo/1.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- Header Logo Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                                <!-- Begin Header Middle Searchbox Area -->
                                <form action="#" class="hm-searchbox">
                                    <select class="nice-select select-search-category">
                                        <option value="0">All</option>
                                        <option value="13">Cameras</option>                          
                                        <option value="14">headphone</option>                                
                                        <option value="15">Smartwatch</option>                           
                                        <option value="16">Accessories</option>
                                    </select>
                                    <input type="text" placeholder="Enter your search key ...">
                                    <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                                <!-- Header Middle Searchbox Area End Here -->
                                <!-- Begin Header Middle Right Area -->
                                <div class="header-middle-right">
                                    <ul class="hm-menu">
                                        <!-- Begin Header Middle Wishlist Area -->
                                        <li class="hm-wishlist">
                                            <a href="kullanici.php">
                                                <i class="fa fa-user-o"></i>
                                            </a>
                                            Hesabım
                                        </li>
                                        <!-- Header Middle Wishlist Area End Here -->
                                        <!-- Begin Header Mini Cart Area -->
                                        <li class="hm-minicart">
                                            <div class="hm-minicart-trigger">
                                                <span class="item-icon"></span>
                                                <span class="item-text">Sepetim
                                                    <span class="cart-item-count"></span>
                                                </span>
                                            </div>
                                            <span></span>
                                            <div class="minicart">
                                                <ul class="minicart-product-list">
                                                    <?php
                                                    foreach ($_COOKIE['sepet'] as $key => $value) {
                                                        $urunler=$baglanti->prepare("SELECT * FROM  urunler where urun_id=:urun_id  order by urun_sira ASC");
                                                        $urunler->execute(array(
                                                            'urun_id'=>$key
                                                        ));
                                                        $urunlercek=$urunler->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <?php
                                            $sepettoplam+=  $urunlercek['urun_fiyat'] * $value;
                                            $kdv=$sepettoplam * 0.18;
                                            $geneltoplam=$sepettoplam + $kdv;
                                            ?>
                                                    <li>
                                                        <a href="single-product.html" class="minicart-product-image">
                                                            <img src="admin/resimler/urunler/<?= $urunlercek['urun_resim'] ?>" alt="cart products">
                                                        </a>
                                                        <div class="minicart-product-details">
                                                            <h6><a href="single-product.html"><?= $urunlercek['urun_baslik'] ?></a></h6>
                                                            <span><?= $urunlercek['urun_fiyat'] * $value?>₺</span>
                                                        </div>
                                                        <a href="islem?sepetsil&id=<?= $key ?>"><button class="close" title="Remove">
                                                            <i class="fa fa-close"></i>
                                                        </button></a>
                                                    </li>
                                                    <?php }  ?>
                                                </ul>
                                                <p class="minicart-total">Toplam: <span><?= $geneltoplam ?></span></p>
                                                <div class="minicart-button">
                                                    <a href="sepet" class="li-button li-button-fullwidth li-button-dark">
                                                        <span>Sepeti Görüntüle</span>
                                                    </a>
                                                    <a href="alısveris" class="li-button li-button-fullwidth">
                                                        <span>Alışverişi Tamamla</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Header Mini Cart Area End Here -->
                                    </ul>
                                </div>
                                <!-- Header Middle Right Area End Here -->
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Middle Area End Here -->
                <!-- Begin Header Bottom Area -->
                <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Begin Header Bottom Menu Area -->
                                <div class="hb-menu">
                                    <nav>
                                        <ul>
                                        <li><a href="index.php">Anasayfa</a></li>

                                            <li class="megamenu-holder"><a href="">Kategoriler</a>
                                                <ul class="megamenu hb-megamenu">
                                                    <li><a href="shop-left-sidebar.html">Kategori-1</a>
                                                        <ul>
                                                        <?php
                                                        $kategori=$baglanti->prepare("SELECT * FROM kategoriler WHERE kategori_durum=:kategori_durum AND kategori_sira BETWEEN 1 AND 10 LIMIT 8");
                                                        $kategori->execute(array(
                                                            'kategori_durum'=>1
                                                        ));
                                                        while ($kategoricek=$kategori->fetch(PDO::FETCH_ASSOC)){?>
                                                        
                                                        <li><a href="urunler-<?= seolink($kategoricek['kategori_adi']).'-'.$kategoricek['kategori_id']?>"><?php echo $kategoricek['kategori_adi']?></a></li>
                                                        <?php } ?>
                                                        </ul>
                                                    </li>
                                                    <li><a href="shop-left-sidebar.html">Kategori-2</a>
                                                        <ul>
                                                        <?php
                                                        //DESC En son kayıttan en ilk kayda doğru sıracalar
                                                        $kategori=$baglanti->prepare("SELECT * FROM kategoriler WHERE kategori_durum=:kategori_durum AND kategori_sira BETWEEN 10 AND 20 LIMIT 8");
                                                        $kategori->execute(array(
                                                            'kategori_durum'=>1
                                                        ));
                                                        while ($kategoricek=$kategori->fetch(PDO::FETCH_ASSOC)){?>
                    
                                                        <li><a href="urunler-<?= seolink($kategoricek['kategori_adi']).'-'.$kategoricek['kategori_id']?>"><?php echo $kategoricek['kategori_adi']?></a></li>
                                                           <?php } ?>
                                                        </ul>
                                                    </li>
                                                    <li><a href="shop-left-sidebar.html">Kategori-3</a>
                                                        <ul>
                                                        <?php
                                                        //DESC En son kayıttan en ilk kayda doğru sıracalar
                                                        $kategori=$baglanti->prepare("SELECT * FROM kategoriler WHERE kategori_durum=:kategori_durum AND kategori_sira BETWEEN 20 AND 30 LIMIT 8");
                                                        $kategori->execute(array(
                                                            'kategori_durum'=>1
                                                        ));
                                                        while ($kategoricek=$kategori->fetch(PDO::FETCH_ASSOC)){?>
                                                        <li><a href="urunler-<?= seolink($kategoricek['kategori_adi']).'-'.$kategoricek['kategori_id']?>"><?php echo $kategoricek['kategori_adi']?></a></li>
                                                        <?php } ?>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="hakkimizda">Hakkımızda</a></li>
                                            <li><a href="bilgi">Kargo Bilgileri</a></li>
                                            <li><a href="iletisim">İletişim</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header Bottom Menu Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header Bottom Area End Here -->
                <!-- Begin Mobile Menu Area -->
                <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                    <div class="container"> 
                        <div class="row">
                            <div class="mobile-menu">
                            </div>
                        </div>
                    </div>
                </div>
                
            </header>