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
                    <label >Kategori Adı</label>
                    <input name="katadi" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label >Kategori Sıra</label>
                    <input name="sira" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                  <label>Kategori Durum</label>
                  <select name="kategoridurum" class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Seçiniz</option>
                    <option>Aktif</option>
                    <option>Pasif</option>
                  </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button name="kategorikaydet" type="submit" class="btn btn-primary">Gönder</button>
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
