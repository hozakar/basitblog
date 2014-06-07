<?php
    include("inc/system/functions.php");
    $dosya = getDir('index.php')."yonetim\\temp\\index.html";
    /* File Open İşlemi ile yapmak istersek
    $handle = fopen($dosya, "rb");
    $icerik = stream_get_contents($handle);
    fclose($handle);
    */

    /* file_get_contents ile */
    $icerik = file_get_contents($dosya);

    echo $site->sayfaisle($icerik);
?>