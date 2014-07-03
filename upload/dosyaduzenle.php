<?php
	$dosya = $_GET['dosya'];
    $id = $_GET['id'];
    $yol = $_GET['yol'];
    if(!$dosya || !$id || !$yol) return;

    include($_SERVER['DOCUMENT_ROOT'].$yol."yonetim/inc/sistem/functions.php");
    
    $db->query("INSERT INTO foto (mid, uzanti) VALUES($id, '.".end(explode('.', $dosya))."')");
    $foto = current($db->query("SELECT LAST_INSERT_ID() FROM foto")->fetch_row()).".".end(explode('.', $dosya));

    unlink("foto/".$dosya);

    $klasorler = explode(',', 'buyuk,normal,minik');
    foreach($klasorler as $klasor) {
        rename("foto/".$klasor."/".$dosya, "foto/".$klasor."/".$foto);
    }
?>