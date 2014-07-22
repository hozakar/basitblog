<?php
    if(!$_SESSION['user']['id']) return;

    $_SESSION['atab'] = $_POST['atab'];
    switch ($_POST['islem']) {
        case 'sil':
            if($_POST['id']) {
                $db->query("DELETE FROM yorumlar WHERE id = $_POST[id]");
            }
            break;
        case 'degistir':
            if($_POST['id']) {
                $db->query("UPDATE yorumlar SET aktif = NOT aktif WHERE id = $_POST[id]");
            }
            break;
    }

    $returndummy = TRUE;
?>