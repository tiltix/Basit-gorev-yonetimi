<?php 
include("./inc/baglanti.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$_SITE_ADI?> | DevEkibi</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
</head>
<body>
<div class="container">

<!-- Navbarımız -->
<?php include('./inc/navbar.php'); ?>
<!-- Navbarımız  End-->

<div class="col-md-12 pt-4">
    <h4 class="text-secondary">Tamamlanan Hatalar</h4>
<table class="table">
    
    <tr>
        <th>No</th>
        <th>İçerik</th>
        <th>Durum</th>
        <th>Ekleyen</th>
        <th>Tamamlayan</th>
    </tr>
<?php 

$sorgu = $baglanti->query("SELECT * FROM tamamlananlar"); // Makale tablosundaki tüm verileri çekiyoruz.

while ($sonuc = $sorgu->fetch_assoc()) { 

$id = $sonuc['id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
$icerik = $sonuc['icerik'];
$durum = $sonuc['durum'];
$kuladi = $sonuc['kuladi'];
$t_kuladi = $sonuc['t_kuladi'];


// While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz. 
?>
    
    <tr>
        <td><?php echo $id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
        <td><?php echo $icerik?></td>
        <td><?php echo $durum?></td>
        <td><?php echo $kuladi?></td>
        <td><?php echo $t_kuladi?></td>
  </tr>
                <!-- Button trigger modal -->
<!-- Modal -->




<?php 
} 
// Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz. 
?>

</table>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
</body>
</html>