<?php
$_SITE_ADI = "TryM2"; // Siteİsminiz
$_HOST = ""; // Veritabanı Adı
$_USER = ""; // Veritabanı kullanıcı adı
$_PASS = ""; // veritabanı şifresi
$_DB = ""; // Veritabanı ismi

    @$baglanti = new mysqli($_HOST, $_USER, $_PASS, $_DB); // Veritabanı bağlantımızı yapıyoruz.
    if(mysqli_connect_error()) //Eğer hata varsa yazdırıyoruz 
    {
        echo mysqli_connect_error();
        exit; //eğer bağlantıda hata varsa PHP çalışmasını sonlandırıyoruz.
    }

$baglanti->set_charset("utf8"); // Türkçe karakter sorunu olmaması için utf8'e çeviriyoruz.

?>