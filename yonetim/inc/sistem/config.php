<?php
session_start();
error_reporting(0);

if(file_exists(getDir().'vtbilgi.php')) {
    include('vtbilgi.php');
} else {
    header('location: yonetim/kur.php');
    return;
}

$slashkullan = TRUE;

$db = new mysqli($vt_bilgi['sunucu'], $vt_bilgi['kullanici'], $vt_bilgi['sifre'], $vt_bilgi['isim']) or die("Baglanilamadi");
$rs = $db->query("SELECT * FROM sitebilgi".($_SESSION['sid'] ? " WHERE id = ".$_SESSION['sid'] : "")." ORDER BY aktif DESC, id LIMIT 1");

$sb = $rs->fetch_assoc();
$_SESSION['sid'] = $sb['id'];

$anasayfasablon = 'index'.(!$sb['aktif'] ? '-yapimasamasinda' : '').'.html';

$satirsayi = 15; // Yönetim Panelinde Liste Sayfalarında Sayfa Başına Kayıt Sayısı

date_default_timezone_set($sb['zamandilimi']);
?>