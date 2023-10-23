<?php
try {
    $baglanti=new PDO("mysql:host=localhost; dbname=eticaret", 'root','');
    //  echo "Bağlantı Başarılı";

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>