<?php require_once 'header.php'; ?>
            <!-- Begin Login Content Area -->
            <div class="page-section mb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                            <!-- Login Form s-->
                            <form action="admin/islem/islem.php" method="post" >
                                <div class="login-form">
                                    <input type="hidden" name="kullaniciid" value="<?php $kullanicicek['kullanici_id']?>"  >
                                    <div class="row">
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Yeni adet sayısı.*</label>
                                            <input name="yeniadet" required="" class="mb-0" type="text" placeholder="Yeni adet sayısı.">
                                        </div>
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Siparis numaranızı giriniz.*</label>
                                            <input name="siparisnumara" required="" class="mb-0" type="text" placeholder="Siparis numaranızı giriniz.">
                                        </div>
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Notunuzu giriniz.*</label>
                                            <input name="not" required="" class="mb-0" type="text" placeholder="Notunuzu giriniz.">
                                        </div>
                                        <div class="col-md-12">
                                            <button name="siparisguncelle" class="register-button mt-0">Kaydet</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                    </div>
                </div>
            </div>
          <?php require_once 'footer.php'; ?>