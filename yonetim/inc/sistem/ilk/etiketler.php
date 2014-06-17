<?php
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
    }
    $returndummy = TRUE;
?>