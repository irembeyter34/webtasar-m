<?php require_once 'header.php'; ?>
  <title>Yazılım Yolcusu İletişim</title>

            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->     
            <!-- Begin Contact Main Page Area -->
            <div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
                <div class="container mb-60">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                            <div class="contact-page-side-content">
                                <h3 class="contact-page-title">Bizi Arayın</h3>
                                <p class="contact-page-message mb-25"><?php echo $ayarcek['aciklama'] ?></p>
                                <div class="single-contact-block">
                                    <h4><i class="fa fa-fax"></i> Adres</h4>
                                    <p><?php echo $ayarcek['adres'] ?></p>
                                </div>
                                <div class="single-contact-block">
                                    <h4><i class="fa fa-phone"></i>Telefon</h4>
                                    <p><?php echo $ayarcek['telefon'] ?></p>
                                    <p><?php echo $ayarcek['telefon'] ?></p>
                                </div>
                                <div class="single-contact-block last-child">
                                    <h4><i class="fa fa-envelope-o"></i>E-mail</h4>
                                    <p><?php echo $ayarcek['email'] ?></p>
                                    <p><?php echo $ayarcek['email'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                            <div class="contact-form-content pt-sm-55 pt-xs-55">
                                <h3 class="contact-page-title">Mesaj bırak</h3>
                                <div class="contact-form">
                                    <form  id="contact-form" action="phpmailer/iletisim.php" method="post">
                                        <div class="form-group">
                                            <label>Adınız <span class="required">*</span></label>
                                            <input type="text" name="adsoyad" id="adsoyad" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="email" name="email" id="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Konu</label>
                                            <input type="text" name="konu" id="konu">
                                        </div>
                                        <div class="form-group mb-30">
                                            <label>Mesajınız</label>
                                            <textarea name="mesaj" id="mesaj" ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" value="gonder" name="mailgonder">
                                            <button name="register" class="register-button mt-0">Gönder</button>                                        </div>
                                    </form>
                                </div>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Main Page Area End Here -->
           <?php require_once 'footer.php';  ?>