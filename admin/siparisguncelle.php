<?php 
require_once 'header.php'; 
require_once 'sidebar.php'; 
error_reporting(0);

$siparisler=$baglanti->prepare("SELECT * FROM siparisler WHERE siparis_id=:siparis_id");
$siparisler->execute(array(
    'siparis_id'=>$_GET['id']
));
$sipariscek=$siparisler->fetch(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="card card-primary col-md-12">
              <div class="card-header">
                <h3 class="card-title">Kategoriler </h3> </div> <?php
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
                    <label >Sipariş Id</label>
                    <input value="<?php echo $sipariscek['siparis_id']?>" name="sipid" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Sipariş Adet</label>
                    <input value="<?php echo $sipariscek['urun_adet']?>" name="adet" type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="card-footer">
                  <button name="sipduzenle" type="submit" class="btn btn-primary">Gönder</button>
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
