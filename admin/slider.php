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
                <h3 class="card-title">Slider Tablosu</h3>

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
                <a href="slider-ekle"><button style="float: right;" type="submit" class="btn btn-success">Yeni Slider Ekle</button></a>

                  <thead>
                    <tr>
                    <th>Slider Resim</th>
                      <th>Slider Başlık</th>
                      <th>Slider Açıklama</th>
                      <th>Slider Buton İsmi</th>
                      <th>Slider Durum</th>
                      <th>Slider Sıra</th>
                      <th>Slider Banner</th>
                      <th>Sil</th>
                      <th>Düzenle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    //DESC En son kayıttan en ilk kayda doğru sıracalar
                    $slider=$baglanti->prepare("SELECT * FROM slider ORDER BY slider_id ASC");
                    $slider->execute();
                    while ($slidercek=$slider->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <tr>
                      <td><img style="width: 300px;" src="resimler/slider/<?php echo $slidercek['slider_resim']?>"></td>
                      <td><?php echo $slidercek['slider_baslik']?></td>
                      <td><?php echo $slidercek['slider_aciklama']?></td>
                      <td><?php echo $slidercek['slider_button']?></td>
                      <td><span class="tag tag-success"><?php
                      if($slidercek['slider_durum']=="1"){
                        echo "Aktif";
                      }elseif($slidercek['slider_durum']=="0") {
                        echo "Pasif";
                      }
                      ?>
                    </span></td>
                      <td><?php echo $slidercek['slider_banner']?></td>
                      <td><span class="tag tag-success"><?php
                      if($slidercek['slider_banner']=="1"){
                        echo "Slider";
                      }elseif($slidercek['slider_banner']=="0") {
                        echo "Banner";
                      }
                      ?>
                    </span></td>
                    
                    <form action="islem/islem.php" method="post" >
                      <input type="hidden" name="resim" value="<?php echo $slidercek['slider_resim']?>"> 
                      <input type="hidden" name="id" value="<?php echo $slidercek['slider_id']?>">                                           
                      <td><button name="slidersil" class="btn btn-danger" type="submit">Sil</button></td></form>
                      <td><a href="slider-duzenle?id=<?php echo $slidercek['slider_id']?>"><button class="btn btn-info" type="submit">Düzenle</button></a></td>
                      
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
