<?php
 
require_once 'header.php'; 
require_once 'sidebar.php'; 
error_reporting(0);

?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
          <?php
                if($_GET['yuklenme']=="basarili"){?>
                <h6 style="color: green;">(Yükleme İşlemi Başarılı.)</h6>
                  <?php } 
                  elseif($_GET['yuklenme']=="basarisiz"){?>
                <h6 style="color: red;">(Yükleme Başarısız.)</h6>
                <?php } 
                  elseif($_GET['yuklenme']=="kullanicivar"){?>
                <h6 style="color: red;">(Bu kullanıcı kayıtlı.)</h6>
                <?php } ?> 
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Yorumlar Tablosu</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <a href="yorumlar-ekle"><button style="float: right;" type="submit" class="btn btn-success">Yeni Yorumla Ekle</button></a>

                  <thead>
                    <tr>
                      <th>Yorum Zaman</th>
                      <th>Yorum Detay</th>
                      <th>Ürün id</th>
                      <th>yorumlar durum</th>
                      <th>Kullanıcı id</th>
                      <th>Onayla</th>
                      <th>Düzenle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    //DESC En son kayıttan en ilk kayda doğru sıracalar
                    $yorumlar=$baglanti->prepare("SELECT * FROM yorumlar ORDER BY yorum_id ASC");
                    $yorumlar->execute();
                    while ($yorumlarcek=$yorumlar->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <tr>
                      <td><?php echo $yorumlarcek['yorum_zaman']?></td>
                      <td><?php echo $yorumlarcek['yorum_detay']?></td>
                      <td><?php echo $yorumlarcek['urun_id']?></td>
                      <td><?php echo $yorumlarcek['kullanici_id']?></td>
                      
                      <form action="islem/islem.php" method="post" >
                        <input type="hidden" name="yorumid" value="<?php echo $yorumlarcek['yorum_id']?>" >
                      <td><button 
                      <?php
                      if ($yorumlarcek['yorum_onay']=="1") {
                        echo "disabled";
                      }
                      
                      ?>
                      name="yorumonayla" class="btn btn-info" type="submit">Onayla</button></a></td>
                      </form>
                      <td><a href="islem/islem.php?yorumlarsil&id=<?php echo $yorumlarcek['yorum_id']?>"><button class="btn btn-danger" type="submit">Sil</button></td>

                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php require_once 'footer.php'; ?> 
