<?php
    if(!$_SESSION['user']['id']) return;
    switch ($_POST['islem']) {
        case 'sil':
            if($_POST['id']) {
                $db->query("DELETE FROM makaleler WHERE id = $_POST[id]");
            }
            break;
        case 'degistir':
            if($_POST['id']) {
                $db->query("UPDATE makaleler SET aktif = NOT aktif WHERE id = $_POST[id]");
            }
            break;
    }
    $returndummy = TRUE;
?>