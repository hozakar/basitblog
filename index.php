<?php
    include("yonetim/inc/sistem/functions.php");
    if($_REQUEST['url']) {
        $site->makale($_REQUEST['url']);
        $dosya = getDir('index.php')."yonetim\\sablon\\".$site->url['sablon'];
    } else {
        $dosya = getDir('index.php')."yonetim\\sablon\\index.html";
    }

    /* Log tutalım ileride lazım olur... */
    $log_sayfa = 'anasayfa';
    if($_GET['ara']) {
        $log_sayfa = 'arama';
        $log_terim = $_GET['ara'];
    }
    if($_GET['etiket']) {
        $log_sayfa = 'etiket';
        $log_terim = $_GET['etiket'];
    }
    $log_mid = $site->url['id'];
    if($log_mid) {
        $log_sayfa = 'makale';
        $log_terim = '';
    } else {
        $log_mid = "NULL";
    }
    $log_tekil = $_SESSION['ziyaret'] ? 0 : 1;
    $_SESSION['ziyaret'] = 1;

    $db->query("
        INSERT INTO log
        (sayfa, terim, mid, tekil)
        VALUES (
            '$log_sayfa',
            '$log_terim',
            $log_mid,
            $log_tekil
        )
    ");

    /* File Open İşlemi ile yapmak istersek
    $handle = fopen($dosya, "rb");
    $icerik = stream_get_contents($handle);
    fclose($handle);
    */

    /* file_get_contents ile */
    $icerik = file_get_contents($dosya);
    
    echo $site->sayfaisle($icerik);
?>