<?php
    include("inc/sistem/functions.php");
    
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
		<!-- Standart Metalar -->
		<meta charset="[[sitebilgi((charset))]]">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title><?php $site->sbyaz('baslik')?></title>

		<!-- Bootstrap CSS -->
		<link href="<?php $site->sbyaz('anadizin')?>inc/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link href="<?php $site->sbyaz('anadizin')?>inc/css/font-awesome.min.css" rel="stylesheet">

        <!-- Yazı Tipleri -->
        <link href='http://fonts.googleapis.com/css?family=Oswald|Roboto:400,400italic,700,700italic&subset=latin-ext,latin' rel='stylesheet' type='text/css'>

		<!-- Özel Stil Dosyaları -->
		<link href="inc/css/stil.min.css" rel="stylesheet">

		<!-- IE8 Desteği için -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
        <div class="menu">
            <!-- Menü -->
            <ul>
                <li class="menu-ac-kapat">
                    <button class="btn btn-default"><i class="fa fa-bars"></i></button>
                </li>
                <li>
                    <form class="form">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" name="hizliara" />
                            <span class="input-group-addon"><button><i class="fa fa-search"></i></button></span>
                        </div>
                    </form>
                </li>
                <li class="<?php echo !$_GET['sayfa'] ? 'aktif' : ''?>">
                    <i class="fa fa-home"></i><a href="<?php $site->sbyaz('anadizin')?>/yonetim/">Genel Görünüm</a>
                </li>
                <li class="<?php echo $_GET['sayfa'] == 'makaleler' ? 'aktif' : ''?> bordered">
                    <i class="fa fa-edit"></i><a href="?sayfa=makaleler">Makaleler</a>
                </li>
                <li class="<?php echo $_GET['sayfa'] == 'etiketler' ? 'aktif' : ''?> bordered">
                    <i class="fa fa-tags"></i><a href="?sayfa=etiketler">Etiketler</a>
                </li>
                <li class="<?php echo $_GET['sayfa'] == 'yorumlar' ? 'aktif' : ''?> bordered">
                    <i class="fa fa-comments-o"></i><a href="?sayfa=yorumlar">Yorumlar</a>
                </li>
                <li class="<?php echo $_GET['sayfa'] == 'ayarlar' ? 'aktif' : ''?> bordered">
                    <i class="fa fa-cogs"></i><a href="?sayfa=ayarlar">Site Ayarları</a>
                </li>
                <li class="<?php echo $_GET['sayfa'] == 'kullanicilar' ? 'aktif' : ''?> bordered">
                    <i class="fa fa-users"></i><a href="?sayfa=kullanicilar">Kullanıcılar</a>
                </li>
            </ul>
            <!-- Son: Menü -->
        </div>
        <div class="body">
            <!-- Üst Bar -->
            <div class="ust-bar">
                <div class="menu-ac-kapat body-menu-btn">
                    <button class="btn btn-default"><i class="fa fa-bars"></i></button>
                </div>
                
                <div class="kullanici">
                    <a href="javascript:;" role="button" data-toggle="dropdown">
                        <div class="isim"><div>Hakan Özakar</div></div>
                        <img src="<?php echo "http://www.gravatar.com/avatar/".md5('hozakar@gmail.com')."&s=32"?>" />
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#"><i class="fa fa-cog"></i>&nbsp;Profil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-warning"></i>&nbsp;Okunmamış Yorumlar</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-power-off"></i>&nbsp;Çıkış</a>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- Son: Üst Bar -->

            <!-- İçerik -->
            <div class="body-icerik">
                <?php include($_GET['sayfa'].'.php');?>
            </div>
            <!-- Son: İçerik -->
        </div>

		<!-- Genel JavaScript Dosyaları -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="<?php $site->sbyaz('anadizin')?>inc/js/bootstrap.min.js"></script>
		<script src="<?php $site->sbyaz('anadizin')?>inc/js/imgfix.min.js"></script>
		<script src="<?php $site->sbyaz('anadizin')?>inc/js/sscr.js"></script>
		<!-- Özel JS Dosyaları -->
		<script src="inc/js/genel.min.js"></script>
        <script>
            $('.isim').data('width', $('.isim').width());
            $('.isim div').width($('.isim').data('width'));
            $('.isim').width(0);
            $('.kullanici').mouseenter(function () {
                $('.isim').width($('.isim').data('width'));
            });
            $('.kullanici').mouseleave(function () {
                $('.isim').width(0);
            });
        </script>
    </body>
</html>
