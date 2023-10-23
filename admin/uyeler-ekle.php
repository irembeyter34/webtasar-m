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
                <h3 class="card-title">Kullanıcı Ayarları </h3> </div> <?php
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
                  <input type="hidden" name="eskiresim" value="<?php echo $kullanicicek['hakkimizda_resim']?>" >
                  <div class="form-group">
                    <label >Resim</label>
                    <input name="resim" type="file" class="form-control">
                  </div>
                  <div class="form-group">
                    <label >Kullanıcı Adı</label>
                    <input name="kadi" type="" class="form-control" placeholder="Kullanıcı Adı">
                  </div>
                  <div class="form-group">
                    <label >Kullanıcı Şifre</label>
                    <input name="sifre" type="" class="form-control" placeholder="şifre">
                  </div>
                  <div class="form-group">
                    <label >Kullanıcı Ad Soyad</label>
                    <input name="adsoyad" type="" class="form-control" placeholder="AdSoyad">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button name="uyelerkaydet" type="submit" class="btn btn-primary">Gönder</button>
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
