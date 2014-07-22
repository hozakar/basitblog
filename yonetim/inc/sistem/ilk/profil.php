<?php
    if(!$_SESSION['user']['id']) return;
    $db->query("UPDATE kullanicilar SET isim = '$_POST[isim]', eposta = '$_POST[eposta]'".($_POST['sifre'] ? ", sifre = '".md5($_POST['sifre'])."'" : "")." WHERE id = $_POST[id]");
    $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = $_POST[id]");
    $_SESSION['user'] = $kullanici->fetch_assoc();
    header('location: ?sayfa=profil');
    return;
?>