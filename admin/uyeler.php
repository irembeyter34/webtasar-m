<?php
 
require_once 'header.php'; 
require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Üyeler Tablosu</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <a href="uyeler-ekle"><button style="float: right;" type="submit" class="btn btn-success">Yeni Kullanıcı Ekle</button></a>

                  <thead>
                    <tr>
                      <th>Kullanıcı Numara</th>
                      <th>Kullanıcı adı</th>
                      <th>Kullanıcı tarihi</th>
                      <th>Yetki</th>
                      <th>AdSoyad</th>
                      <th>Adres</th>
                      <th>İl</th>
                      <th>İlçe</th>
                      <th>Telefon</th>
                      <th>Sil</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    //DESC En son kayıttan en ilk kayda doğru sıracalar
                    $kullanici=$baglanti->prepare("SELECT * FROM kullanicilar ORDER BY kullanici_id ASC");
                    $kullanici->execute();
                    while ($kullanicicek=$kullanici->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <tr>
                      <td><?php echo $kullanicicek['kullanici_id']?></td>
                      <td><?php echo $kullanicicek['kullanici_adi']?></td>
                      <td><?php echo $kullanicicek['kullanici_zaman']?></td>
                      <td><span class="tag tag-success"><?php
                      if($kullanicicek['kullanici_yetki']=="2"){
                        echo "Admin kullanıcı";
                      }elseif($kullanicicek['kullanici_yetki']=="1") {
                        echo "Normal kullanıcı";
                      }
                      ?>
                    </span></td>
                      <td><?php echo $kullanicicek['kullanici_adsoyad']?></td>
                      <td><?php echo $kullanicicek['kullanici_adres']?></td>
                      <td><?php echo $kullanicicek['kullanici_il']?></td>
                      <td><?php echo $kullanicicek['kullanici_ilce']?></td>
                      <td><?php echo $kullanicicek['kullanici_tel']?></td>
                      <td><a href="islem/islem.php?kullanicisil&id=<?php echo $kullanicicek['kullanici_id']?>"><button class="btn btn-danger" type="submit">Sil</button></a></td>
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
