<?php
    if(!$_SESSION['user']['id']) return;
    switch ($_POST['islem']) {
        case 'duzenle':
            if($_POST['id']) {
                $db->query("UPDATE kullanicilar SET isim = '$_POST[isim]', eposta = '$_POST[eposta]', duzey = $_POST[duzey]".($_POST['sifre'] ? ", sifre = '".md5($_POST['sifre'])."'" : "")." WHERE id = $_POST[id]");
            } else {
                $db->query("INSERT INTO kullanicilar (isim, eposta, duzey, sifre) VALUES('$_POST[isim]', '$_POST[eposta]', $_POST[duzey], '".md5($_POST['sifre'])."')");
            }
            if($_SESSION['user']['id'] == $_POST['id']) {
                $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = $_POST[id]");
                $_SESSION['user'] = $kullanici->fetch_assoc();
            }
            header('location: ?sayfa=kullanicilar');
            break;
        case 'sil':
            if($_POST['id']) {
                $db->query("DELETE FROM kullanicilar WHERE id = $_POST[id]");
            }
            break;
        case 'degistir':
            if($_POST['id']) {
                $db->query("UPDATE kullanicilar SET aktif = NOT aktif WHERE id = $_POST[id]");
            }
            break;
    }
    $returndummy = TRUE;
?>