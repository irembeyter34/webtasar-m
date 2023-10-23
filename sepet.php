<?php 
require_once 'header.php';
?>
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!--Shopping Cart Area Strat-->
            <div class="Shopping-cart-area pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if ($_GET['durum']=="eklendi") { ?>
                                <b style="color: green;"> "Ürününüz sepete eklendi."</b>
                            <?php } ?>
                            <form action="#">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="li-product-remove"></th>
                                                <th class="li-product-thumbnail">Resim</th>
                                                <th class="cart-product-name">Başlık</th>
                                                <th class="li-product-price">Ücret</th>
                                                <th class="li-product-quantity">Adet</th>
                                                <th class="li-product-subtotal">Toplam Fiyat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach ($_COOKIE['sepet'] as $key => $value) {
                                                $urunler=$baglanti->prepare("SELECT * FROM  urunler where urun_id=:urun_id  order by urun_sira ASC");
                                                $urunler->execute(array(
                                                    'urun_id'=>$key
                                                ));
                                                $urunlercek=$urunler->fetch(PDO::FETCH_ASSOC);
                                            //key şu demek sepet adında bir cookie oluşturduk. Bu cookiyi ilk başa alıyoruz. devamında cookimizin içinde biz id yüklemiştik. bunu key ile alıyoruz. devamında value yazan kısımda adetimizi bastırıyor.
                                            ?>
                                            <tr>
                                                <td class="li-product-remove"><a href="islem?sepetsil&id=<?= $key ?>"><i class="fa fa-times"></i></a></td>
                                                <td class="li-product-thumbnail"><a href="#"><img src="admin/resimler/urunler/<?= $urunlercek['urun_resim'] ?>" alt="Li's Product Image"></a></td>
                                                <td class="li-product-name"><a href="#"><?= $urunlercek['urun_baslik'] ?></a></td>
                                                <td class="li-product-price"><span class="amount"><?= $urunlercek['urun_fiyat']?>₺</span></td>
                                                <td class="quantity">
                                                    <label>Adet</label>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" value="<?= $value ?>" type="text">
                                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"><span class="amount"><?= $urunlercek['urun_fiyat'] * $value?>₺</span></td>
                                            </tr>
                                            <?php }  ?>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">
                                            <div class="coupon">
                                                <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                                <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                            </div>
                                            <div class="coupon2">
                                                <input class="button" name="update_cart" value="Update cart" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="cart-page-total">
                                            <h2>Toplam Fiyat</h2>
                                            <ul>
                                                <li>Toplam Fiyat <span><?= $sepettoplam ?>₺</span></li>
                                                <li>Kdv<span><?= $kdv ?>₺</span></li>
                                                <li>Genel Toplam<span><?= $geneltoplam ?>₺</span></li>
                                            </ul>
                                            <a href="alisveris?toplamfiyat=<?= $geneltoplam ?>">Alışverişi Tamamla</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php require_once 'footer.php'; ?>           