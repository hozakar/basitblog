<?php
    $dosya = $_GET['dosya'];
    if(!$dosya) return;

    unlink("foto/".$dosya);

    $klasorler = explode(',', 'buyuk,normal,minik');
    foreach($klasorler as $klasor) {
        //rename("foto/".$klasor."/".$dosya, "foto/".$klasor."/".$dosya);
    }
?>