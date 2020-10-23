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

<?php 

$sorgu = $baglanti->query("SELECT * FROM bulunanhatalar WHERE id =".(int)$_GET['id']); 
//id değeri ile düzenlenecek verileri veritabanından alacak sorgu

$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>

<div class="container pt-3">
    <h2 class="text-center text-secondary">Fixlenen Hata & Bug</h2>


<form  action="" method="post">
    
    <table class="table">

        <tr>
            <td>Durumu : </td>
            <td><input style="border:none;" readonly="false" name="durum" value="<?php echo $sonuc['durum'];?>"></td>
        </tr>

        <tr>
            <td>Tamamlayan Kullanıcı : </td>
            <td>
                <select name="t_kuladi" class="form-select" aria-label="Default select example">
                    <option value="tiltX">tiltX</option>
                    <option value="Felix">Felix</option>
                    <option value="Witch">Witch</option>
                </select>
            </td>
            <!-- <td><input type="text" name="kuladi" class="form-control" value="  -->
            </td>
        </tr>

        <tr>
            <td>Hatayı Ekleyen Kullanıcı : </td>
            <td><input style="border:none;" name="kuladi" readonly="false" value="<?php echo $sonuc['kuladi'];?>" ></tr>

        <tr>
            <td>İçerik</td>
            <td><textarea readonly="false" name="icerik" class="form-control"><?php echo $sonuc['icerik']; ?></textarea></td>
        </tr>
        
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-success" value="Tamamla">&nbsp;<a class="btn btn-danger" href="./index.php">İptal</a></td>

        </tr>

    </table>

</form>

<?php 

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $kuladi = $_POST['kuladi']; 
    $icerik = $_POST['icerik'];
    $durum = $_POST['durum'];
    $t_kuladi = $_POST['t_kuladi'];

    if ($kuladi<>"" && $icerik<>"") { 
    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
        
         // Veri ekleme sorgumuzu yazıyoruz.
        if ($baglanti->query("INSERT INTO tamamlananlar (kuladi, icerik, durum,t_kuladi) VALUES ('$kuladi','$icerik','$durum','$t_kuladi')"))
        {
            
// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($baglanti->query("DELETE FROM bulunanhatalar WHERE id =".(int)$_GET['id'])) 
{
    header("location:index.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
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
<div>
</body>
</html>
