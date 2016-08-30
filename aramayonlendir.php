<?php
    if($_REQUEST['ara'])
        header('location: /ara/' . rawurlencode(strip_tags($_REQUEST['ara'])));
    else
        header('location: /');
?>
