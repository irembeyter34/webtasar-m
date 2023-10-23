<?php 
require_once 'header.php'; 
require_once 'sidebar.php'; 
error_reporting(0);

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
                  $katid=$_GET['katid'];
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
                    <input name="urunleresim" type="file" class="form-control">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Başlık</label>
                    <input name="urunlerbaslik" type="text" class="form-control" placeholder="">
                  </div>
                  <label>Hakkımızda Detay</label>
                  <textarea name="urunleraciklama" class="ckeditor" id="editor1"></textarea>
                <input type="hidden" name="katsid" value="<?php echo $_GET['katid']    ?>" >
                  <div class="form-group">
                    <label >urunler Sıra</label>
                    <input name="urunlersira" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Model</label>
                    <input name="urunlermodel" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Renk</label>
                    <input name="urunlerrenk" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Adet</label>
                    <input name="urunleradet" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Fiyat</label>
                    <input name="urunlerfiyat" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Ürünler Anahtar Kelime</label>
                    <input name="urunleranahtar" type="text" class="form-control" placeholder="">
                  </div>
                  
                  <div class="form-group">
                  <label>Ürünler Durum</label>
                  <select name="urunlerdurum" class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Seçiniz</option>
                    <option value="1" >Aktif</option>
                    <option value="0">Pasif</option>
                  </select>
                  </div>
                  <div class="form-group">
                  <label>Öne Çıkar</label>
                  <select name="urunleronecikar" class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Seçiniz</option>
                    <option value="1">Öne Çıkar</option>
                    <option value="0">Öne Çıkarma</option>
                  </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button name="urunlerkaydet" type="submit" class="btn btn-primary">Gönder</button>
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
