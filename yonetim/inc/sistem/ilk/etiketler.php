<?php
    if(!$_SESSION['user']['id']) return;
    $returndummy = TRUE;
    if(!$_SESSION['user']['duzey']) {
        return;
    }
    switch ($_POST['islem']) {
        case 'renk':
            if($_POST['id']) {
                $db->query("UPDATE etiketler SET renk = '".$_POST['renk']."' WHERE id = $_POST[id]");
            }
            break;
        case 'degistir':
            if($_POST['id']) {
                $db->query("UPDATE etiketler SET menu = NOT menu WHERE id = $_POST[id]");
            }
            break;
        case 'sil':
            if($_POST['id']) {
                $db->query("DELETE FROM etiketler WHERE id = $_POST[id]");
            }
            break;
    }
?>