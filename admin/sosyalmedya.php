<?php 
require_once 'header.php'; 
require_once 'sidebar.php'; 
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="card card-primary col-md-12">
              <div class="card-header">
                <h3 class="card-title">Sosyal Medya Ayarları </h3> </div> <?php
                if(@$_GET['yuklenme']=="basarili"){?>
                <h6 style="color: green;">(Yükleme İşlemi Başarılı.)</h6>
                  <?php }
                  elseif(@$_GET['yuklenme']=="basarisiz"){?>
                <h6 style="color: red;">(Yükleme İşlemi Başarısız.)</h6>
                <?php } ?>              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="islem/islem.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Facebook</label>
                    <input value="<?php echo $ayarcek['facebook']?>" name="facebook" type="" class="form-control" placeholder="Facebook ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">İnstagram</label>
                    <input value="<?php echo $ayarcek['instagram']?>" name="instagram" type="" class="form-control" placeholder="İnstagram">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Twitter</label>
                    <input value="<?php echo $ayarcek['twitter']?>" name="twitter" type="" class="form-control" placeholder="Twitter">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Youtube</label>
                    <input value="<?php echo $ayarcek['youtube']?>" name="youtube" type="" class="form-control" placeholder="Youtube">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button name="sosyalmedyakaydet" type="submit" class="btn btn-primary">Gönder</button>
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
