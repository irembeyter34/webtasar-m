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
                <h3 class="card-title">Genel Ayarlar </h3> </div> <?php
                if($_GET['yuklenme']=="basarili"){?>
                <h6 style="color: green;">(Yükleme İşlemi Başarılı.)</h6>
                  <?php }
                  elseif($_GET['yuklenme']=="basarisiz"){?>
                <h6 style="color: red;">(Yükleme İşlemi Başarısız.)</h6>
                <?php } ?>              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="islem/islem.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Site Başlığı</label>
                    <input value="<?php echo $ayarcek['baslik']?>" name="baslik" type="" class="form-control" placeholder="Site başlığı">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Açıklama</label>
                    <input value="<?php echo $ayarcek['aciklama']?>" name="aciklama" type="" class="form-control" placeholder="Açıklama">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Anahtar Kelime</label>
                    <input value="<?php echo $ayarcek['anahtarkelime']?>" name="anahtarkelime" type="" class="form-control" placeholder="Anahtar Kelime">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button name="ayarkaydet" type="submit" class="btn btn-primary">Gönder</button>
                </div>
              </form>
            </div>
          

         
        </div>
        <div class="card card-primary col-md-12">                          
              <!-- /.card-header -->
              <!-- form start -->
              <form action="islem/islem.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <input type="hidden" name="eskilogo" value="<?php echo $ayarcek['logo'] ?>" >
                <!-- yüklediğimiz resmi görebilmek için admin panelinde yaptığımız işlem -->
                  <div class="form-group"> 
                    <label for="exampleInputPassword1">Logo = </label>
                    <img style="width: 250px;" src = "resimler/logo/<?php echo $ayarcek['logo']?>">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Logo</label>
                    <input name="logo" type="file" class="form-control">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button name="logokaydet" type="submit" class="btn btn-primary">Gönder</button>
                </div>
              </form>
            </div>
          

         
        </div>


        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once 'footer.php'; ?> 
