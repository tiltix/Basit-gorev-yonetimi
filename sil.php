
 <?php 

if ($_GET) 
{

include("./inc/baglanti.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($baglanti->query("DELETE FROM bulunanhatalar WHERE id =".(int)$_GET['id'])) 
{
    header("location:index.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>