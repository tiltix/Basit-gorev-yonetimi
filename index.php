<?php 
include("./inc/baglanti.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$_SITE_ADI?> | DevEkibi</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
<link rel="shortcut icon" href="./img/web-development.png" type="image/png">
<script src="https://kit.fontawesome.com/d22e1e917e.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<!-- Navbar -->
<?php include('./inc/navbar.php'); ?>
<!-- Navbarımız End -->





    <div class="baslik text-primary pt-2 text-center">
        <img src="./img/web-development.png" height="150" width="150" alt="">
        <h3 class="">Bulunan Hatalar</h3>
    </div>

<div class="col-md-8">
<form action="" method="post">
    <table class="table">
        
        <tr>
            <td>Ekleyen Kullanıcı Adı : </td>
            <td>
                <select name="kuladi" class="form-select" aria-label="Default select example">
                    <option value="tiltX">tiltX</option>
                    <option value="Felix">Felix</option>
                    <option value="Witch">Witch</option>
                </select></td>
            <!-- <td ><input readonly="false" value="tiltX" type="text" name="kuladi" class="form-control" ></td> -->
        </tr>

        <tr>
        <td>Önem Derecesi : </td>
        <td>
            <select name="durum" class="form-select" aria-label="Default select example">                    
                <option value="Normal">Varsayılan(Normal)</option>
                <option value="Düşük" class="text-success">Düşük</option>
                <option value="Normal" class="text-primary">Normal</option>
                <option value="Yüksek" class="text-danger">Yüksek</option>
            </select></td>
        </tr>


        <tr>
            <td>Bulunan Hata & Sorun</td>
            <td><textarea name="icerik" class="form-control" ></textarea></td>
        </tr>

        <tr>
            <td></td>
            <td><input class="btn btn-primary"  type="submit" value="Ekle"></td>
        </tr>

    </table>

</form>

<!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

<?php 

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $kuladi = $_POST['kuladi']; 
    $icerik = $_POST['icerik'];
    $durum = $_POST['durum'];

    if ($kuladi<>"" && $icerik<>"") { 
    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
        
         // Veri ekleme sorgumuzu yazıyoruz.
        if ($baglanti->query("INSERT INTO bulunanhatalar (kuladi, icerik, durum) VALUES ('$kuladi','$icerik','$durum')")) 
        {
            echo "<h3 class='text-success'>Hata & Bug Eklendi.</h3>"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
        }
        else
        {
            echo "<h3 class='text-danger'>Hata oluştu</h3>";
        }

    }
    else{
        echo "<h2 class='text-danger text-center'>İçerik Kısmını Boş Geçemezsiniz.</h2>";
    }

}

?>
</div>
<!-- ############################################################## -->

<!-- Veritabanına eklenmiş verileri sıralamak için önce üst kısmı hazırlayalım. -->
<div class="col-md-12">
<table class="table">
    
    <tr>
        <th>No</th>
        <th>Kullanıcı</th>
        <th>Durum</th>
        <th>İçerik</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>

<!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

<?php 

$sorgu = $baglanti->query("SELECT * FROM bulunanhatalar"); // Makale tablosundaki tüm verileri çekiyoruz.

while ($sonuc = $sorgu->fetch_assoc()) { 

$id = $sonuc['id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
$kuladi = $sonuc['kuladi'];
$icerik = $sonuc['icerik'];
$durum = $sonuc['durum'];


// While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz. 
?>
    
    <tr>
        <td><?php echo $id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
        <td><?php echo "<i>".$kuladi."</i>"; ?></td>
        <td><?php 
                if($durum == 'Düşük'){
                    echo  "<span class='text-success'><b>".$durum."</b></span>";
                }
                elseif($durum == "Normal"){
                    echo  "<span class='text-primary'><b>".$durum."</b></span>";
                }
                elseif($durum == "Yüksek" ){
                    echo  "<span class='text-danger'><b>".$durum."</b></span>";
                }
         ?></td>
        <td><?php echo $icerik; ?></td>
        <td><a class="btn btn-success" href="tamamlandi.php?id=<?php echo $id?>"><i class="fas fa-check"></i></a></td>
        <td><a href="duzenle.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $id; ?>"><i class="fas fa-trash-alt"></i></button>
    
        <div class="modal fade" id="exampleModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Silmek İstediğinize Emin Misiniz ?</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo "<i>".$icerik."</i>";?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <a href="sil.php?id=<?php echo $id; ?>" class="btn btn-danger m-1 ">Sil</a>
      </div>
    </div>
  </div>
</div>
    </td>
    </tr>
                <!-- Button trigger modal -->
<!-- Modal -->




<?php 
} 
// Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz. 
?>

</table>
</div>
</div>
<hr>
<footer class="pb-3 text-center">
    <small>&copy; <a class="text-secondary text-muted" target="_blank" href="ReadMe.md">Sürüm Notları</a> &copy;</small>
</footer>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
</body>
</html>