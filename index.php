<?php
    include("yonetim/inc/sistem/functions.php");
    if($_REQUEST['url']) {
        $site->makale($_REQUEST['url']);
        $dosya = getDir('index.php')."yonetim\\sablon\\".$site->url['sablon'];
    } else {
        $dosya = getDir('index.php')."yonetim\\sablon\\index.html";
    }
    
    /* File Open İşlemi ile yapmak istersek
    $handle = fopen($dosya, "rb");
    $icerik = stream_get_contents($handle);
    fclose($handle);
    */

    /* file_get_contents ile */
    $icerik = file_get_contents($dosya);
    
    echo $site->sayfaisle($icerik);
?>