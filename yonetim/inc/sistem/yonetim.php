<?php
    if(!$_SESSION['user']['id'] && end(explode('/', $_SERVER['URL'])) != 'login.php') header('location: login.php');
    if($_POST && $_GET['sayfa']) {
        include(getDir().'ilk/'.$_GET['sayfa'].'.php');
    }
?>