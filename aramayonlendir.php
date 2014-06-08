<?php
    if($_REQUEST['ara'])
        header('location: /ara/'.$_REQUEST['ara'].'.html');
    else
        header('location: /');
?>
