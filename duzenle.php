<?php 
include("./inc/baglanti.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Trm2 | DevEkibi</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
</head>
<body>

<?php 

$sorgu = $baglanti->query("SELECT * FROM bulunanhatalar WHERE id =".(int)$_GET['id']); 
//id değeri ile düzenlenecek verileri veritabanından alacak sorgu

$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>

<div class="container">


<form  action="" method="post">
    
    <table class="table">
        
        <tr style="display:none;">
            <td>Kullanıcı : </td>
            <td>
                <select name="kuladi" class="form-select" aria-label="Default select example">
                    <option value="<?php echo $sonuc['kuladi'];?>"><?php echo $sonuc['kuladi'];?></option>
                    <option value="tiltX">tiltX</option>
                    <option value="Felix">Felix</option>
                    <option value="Witch">Witch</option>
                </select></td>
            <!-- <td><input type="text" name="kuladi" class="form-control" value="  -->
            </td>
        </tr>
        <tr>
        <td>Önem Derecesi : </td>
        <td>
            <select name="durum" class="form-select" aria-label="Default select example">                    
                <option value="<?php echo $sonuc['durum'];?>">Varsayılan(<?php echo $sonuc['durum'];?>)</option>
                <option value="Düşük" class="text-success">Düşük</option>
                <option value="Normal" class="text-primary">Normal</option>
                <option value="Yüksek" class="text-danger">Yüksek</option>
            </select></td>
        </tr>

        <tr>
            <td>İçerik</td>
            <td><textarea name="icerik" class="form-control"><?php echo $sonuc['icerik']; ?></textarea></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-primary" value="Kaydet"></td>
        </tr>

    </table>

</form>
</div>
<div>
<?php 

if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
    
    $kuladi = $_POST['kuladi']; // Post edilen değerleri değişkenlere aktarıyoruz
    $icerik = $_POST['icerik'];
    $durum = $_POST['durum'];

    if ($kuladi<>"" && $icerik<>"") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        
        // Veri güncelleme sorgumuzu yazıyoruz.
        if ($baglanti->query("UPDATE bulunanhatalar SET durum = '$durum', icerik = '$icerik' WHERE id =".$_GET['id'])) 
        {
            header("location:index.php"); 
            // Eğer güncelleme sorgusu çalıştıysa ekle.php sayfasına yönlendiriyoruz.
        }
        else
        {
            echo "Hata oluştu"; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
        }
    }
}

?>
</body>
</html>
