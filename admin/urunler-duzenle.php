<?php 
require_once 'header.php'; 
require_once 'sidebar.php'; 
error_reporting(0);

$urunler=$baglanti->prepare("SELECT * FROM urunler WHERE urun_id=:urun_id");
$urunler->execute(array(
    'urun_id'=>$_GET['id']
));
$urunlercek=$urunler->fetch(PDO::FETCH_ASSOC);

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="card card-primary col-md-12">
              <div class="card-header">
                <h3 class="card-title">urunler</h3> </div> <?php
                if($_GET['yuklenme']=="basarili"){?>
                <h6 style="color: green;">(Yükleme İşlemi Başarılı.)</h6>
                  <?php } 
                  elseif($_GET['yuklenme']=="basarisiz"){?>
                <h6 style="color: red;">(Yükleme Başarısız.)</h6>
                <?php } 
                  elseif($_GET['yuklenme']=="kullanicivar"){?>
                <h6 style="color: red;">(Bu kullanıcı kayıtlı.)</h6>
                <?php } ?>               
              <!-- /.card-header -->
              <!-- form start -->
              <form action="islem/islem.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                  <label>Kategori Seç</label>
                  <select name="urunkategori" class="form-control select2bs4" style="width: 100%;">
                  <?php
                  $katid=$urunlercek['kategori_id'];
                  $kategori=$baglanti->prepare("SELECT * FROM kategoriler ORDER BY kategori_id ASC");
                    $kategori->execute();
                    while ($kategoricek=$kategori->fetch(PDO::FETCH_ASSOC)){
                        $kategoriid=$kategoricek['kategori_id'];
                    ?>
                    <option <?php if ($katid==$kategoriid) {
                        echo "selected";
                    }     ?> value="<?= $kategoriid ?>"> <?php echo $kategoricek['kategori_adi'] ?></option>
                    <?php } ?>
                  </select>
                  </div>
                  <div class="form-group">
                    <label >Ürünler Resim</label>
                    <img style="width:200px" src="resimler/urunler/<?php echo $urunlercek['urun_resim'] ;?>">
                  </div>
                <div class="form-group">
                    <label >Ürünler Resim</label>
                    <input name="urunleresim" type="file" class="form-control">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Başlık</label>
                    <input value="<?= $urunlercek['urun_baslik'] ?>" name="urunlerbaslik" type="text" class="form-control" placeholder="">
                  </div>
                  <label>Hakkımızda Detay</label>
                  <textarea name="urunleraciklama" class="ckeditor" id="editor1"><?= $urunlercek['urun_aciklama'] ?></textarea>
                <input type="hidden" name="katsid" value="<?php echo $_GET['katid']    ?>" >
                  <div class="form-group">
                    <label >urunler Sıra</label>
                    <input value="<?= $urunlercek['urun_sira'] ?>" name="urunlersira" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Model</label>
                    <input value="<?= $urunlercek['urun_model'] ?>" name="urunlermodel" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Renk</label>
                    <input value="<?= $urunlercek['urun_renk'] ?>" name="urunlerrenk" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Adet</label>
                    <input value="<?= $urunlercek['urun_adet'] ?>" name="urunleradet" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Fiyat</label>
                    <input value="<?= $urunlercek['urun_fiyat'] ?>" name="urunlerfiyat" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Anahtar Kelime</label>
                    <input value="<?php $urunlercek['urun_etiket'] ?>" name="urunleranahtar" type="text" class="form-control" placeholder="">
                  </div>
                  
                  <div class="form-group">
                  <label>Ürünler Durum</label>
                  <select name="urunlerdurum" class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Seçiniz</option>
                    <option <?php if ($urunlercek['urun_durum']=="1") { echo "selected";} ?> value="1" >Aktif</option>
                    <option <?php if ($urunlercek['urun_durum']=="0") { echo "selected";} ?> value="0">Pasif</option>
                  </select>
                  </div>
                  <input type="hidden" name="id" value="<?php echo $urunlercek['urun_id']?>"   >
                  <input type="hidden" name="eskiresim" value="<?php echo $urunlercek['urun_id']?>"   >
                  <div class="form-group">
                  <label>Öne Çıkar</label>
                  <select name="urunleronecikar" class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Seçiniz</option>
                    <option <?php if ($urunlercek['onecikan']=="1") {
                        echo "selected";
                    }  ?> value="1">Öne Çıkar</option>
                    <option <?php if ($urunlercek['onecikan']=="0") {
                        echo "selected";
                    }   ?> value="0">Öne Çıkarma</option>
                  </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button name="urunduzenle" type="submit" class="btn btn-primary">Gönder</button>
                </div>
              </form>
            </div>
        </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once 'footer.php'; ?> 
