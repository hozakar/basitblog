<?php
    include("inc/sistem/functions.php");
    include("inc/sistem/yonetim.php");
    if($returndummy) return;
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
		<!-- Standart Metalar -->
		<meta charset="<?php $site->sbyaz('charset')?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title><?php $site->sbyaz('baslik')?></title>

		<!-- Bootstrap CSS -->
		<link href="<?php $site->sbyaz('anadizin')?>inc/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link href="<?php $site->sbyaz('anadizin')?>inc/css/font-awesome.min.css" rel="stylesheet">

        <!-- Yazı Tipleri -->
        <link href='http://fonts.googleapis.com/css?family=Oswald|Roboto:400,400italic,700,700italic&subset=latin-ext,latin' rel='stylesheet' type='text/css'>

        <!-- Faviconlar -->
        <link rel="shortcut icon" type='image/x-icon' href="../favicon.png">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../apple-touch-icon-144x144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../apple-touch-icon-114x114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../apple-touch-icon-72x72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="../apple-touch-icon-precomposed.png">

        <?php   if($_GET['sayfa'] == 'makale') {?>
                    <!-- select2 -->
                    <link href="inc/select2/select2.css" rel="stylesheet"/>
                    <link href="inc/select2/select2-bootstrap.css" rel="stylesheet"/>

                    <!-- jQuery File Upload -->
                    <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
                    <link rel="stylesheet" href="inc/jquery-file-upload/css/jquery.fileupload.css">
                    <link rel="stylesheet" href="inc/jquery-file-upload/css/jquery.fileupload-ui.css">
                    <noscript><link rel="stylesheet" href="inc/jquery-file-upload/css/jquery.fileupload-noscript.css"></noscript>
                    <noscript><link rel="stylesheet" href="inc/jquery-file-upload/css/jquery.fileupload-ui-noscript.css"></noscript>
                    <style>
                        .ng-cloak {
                            display: none;
                        }
                    </style>
        <?php   }?>

        <?php   if($_GET['sayfa'] == 'etiketler' || $_GET['sayfa'] == 'ayarlar') {?>
                    <!-- bootstrap colorpicker -->
                    <link href="inc/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <?php   }?>

		<!-- Özel Stil Dosyaları -->
		<link href="inc/css/datepicker.css" rel="stylesheet">
		<link href="inc/css/stil.min.css" rel="stylesheet">

		<!-- Öncelikli Yüklenmesi Gereken JavaScript Dosyaları -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

		<!-- IE8 Desteği için -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
        <?php include('modals.php')?>
        <div class="menu">
            <!-- Menü -->
            <ul>
                <li class="menu-kapat cercevesiz text-right">
                    <button class="btn btn-default"><i class="fa fa-bars"></i></button>
                </li>

                <li class="cercevesiz">
                    <form class="form">
                        <input type="hidden" name="sayfa" value="arama" />
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" name="hizliara" placeholder="Ara..." value="<?php echo $_GET['hizliara'];?>" />
                            <span class="input-group-addon"><button><i class="fa fa-search"></i></button></span>
                        </div>
                    </form>
                </li>

                <li class="<?php echo !$_GET['sayfa'] ? 'aktif' : ''?> cercevesiz">
                    <i class="fa fa-home"></i><a href="<?php $site->sbyaz('anadizin')?>yonetim/">Genel Görünüm</a>
                </li>

                <li class="<?php echo $_GET['sayfa'] == 'makaleler' ? 'aktif' : ''?>">
                    <i class="fa fa-edit"></i><a href="?sayfa=makaleler">Makaleler</a>
                </li>

                <li class="<?php echo $_GET['sayfa'] == 'etiketler' ? 'aktif' : ''?>">
                    <i class="fa fa-tags"></i><a href="?sayfa=etiketler">Etiketler</a>
                </li>

                <li class="<?php echo $_GET['sayfa'] == 'yorumlar' ? 'aktif' : ''?>">
                    <?php $yorumlar = current($db->query("SELECT COUNT(*) FROM yorumlar INNER JOIN makaleler ON makaleler.id = yorumlar.mid WHERE NOT yorumlar.aktif AND makaleler.kullanici = ".$_SESSION['user']['id'])->fetch_row());?>
                    <i class="fa fa-comments-o"></i><a href="?sayfa=yorumlar">Yorumlar&nbsp;&nbsp;
                        <?php   if($yorumlar > 0) {?>
                                    <span class="badge"><?php echo $yorumlar;?></span>
                        <?php   }?>
                    </a>
                </li>

                <?php   if($_SESSION['user']['duzey']) {?>
                            <li class="<?php echo $_GET['sayfa'] == 'ayarlar' ? 'aktif' : ''?>">
                                <i class="fa fa-cogs"></i><a href="?sayfa=ayarlar">Site Ayarları</a>
                            </li>
                <?php   }?>

                <li class="<?php echo $_GET['sayfa'] == ($_SESSION['user']['duzey'] ? 'kullanicilar' : 'profil') ? 'aktif' : ''?>">
                    <i class="fa fa-users"></i><a href="?sayfa=<?php echo $_SESSION['user']['duzey'] ? 'kullanicilar' : 'profil'?>"><?php echo $_SESSION['user']['duzey'] ? 'Kullanıcılar' : 'Profil'?></a>
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
                        <div class="isim"><div><?php echo $_SESSION['user']['isim'];?></div></div>
                        <img src="<?php echo "http://www.gravatar.com/avatar/".md5($_SESSION['user']['eposta'])."&s=32"?>" />
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="?sayfa=profil"><i class="fa fa-cog"></i>&nbsp;Profil</a>
                        </li>
                        <li>
                            <a href="?sayfa=yorumlar"><i class="fa fa-comments-o"></i>&nbsp;Yorumlar</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="login.php"><i class="fa fa-power-off"></i>&nbsp;Çıkış</a>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- Son: Üst Bar -->

            <!-- İçerik -->
            <div class="body-icerik">
                <?php 
                    $sayfaDummy = $_GET['sayfa'] ? $_GET['sayfa'] : 'anasayfa';
                    include($sayfaDummy.'.php');
                ?>
            </div>
            <!-- Son: İçerik -->
        </div>

		<!-- Genel JavaScript Dosyaları -->
		<script src="<?php $site->sbyaz('anadizin')?>inc/js/bootstrap.min.js"></script>
		<script src="<?php $site->sbyaz('anadizin')?>inc/js/imgfix.min.js"></script>
		<script src="<?php $site->sbyaz('anadizin')?>inc/js/sscr.js"></script>
		<script src="inc/js/bootstrap-datepicker.js"></script>

        <?php   if($_GET['sayfa'] == 'makale') {?>

                    <!-- TinyMCE Editor -->
                    <script type="text/javascript" src="inc/tinymce/tinymce.min.js"></script>
                    <script type="text/javascript">
                        tinymce.init({
                            selector: ".icerik",
                            language : 'tr_TR',
                            content_css : [
                                "<?php $site->sbyaz('anadizin')?>inc/css/font-awesome.min.css?date<?php echo date('YmdHis');?>",
                                "<?php $site->sbyaz('anadizin')?>inc/css/stil.min.css?date<?php echo date('YmdHis');?>"
                            ],
                            plugins : 'link image visualblocks textcolor code table searchreplace stylebuttons syntaxhighlighter imagebrowser media',
                            menubar: false,
                            toolbar: [
                                "code | undo redo | style-h2 style-h3 | syntaxhighlighter | bold italic underline strikethrough | bullist numlist | forecolor | blockquote | link imagebrowser media | alignleft aligncenter alignright alignjustify | table | searchreplace"
                            ],
                            imagebrowser: {
                                root: "<?php $site->sbyaz('anadizin')?>inc/images/kullanici/",
                                overwrite: false
                            },
							relative_urls : false
                        });
                    </script>

                    <!-- Select2 -->
                    <script src="inc/select2/select2.min.js"></script>
                    <script src="inc/select2/select2_locale_tr.js"></script>
                    
                    <!-- jQuery File Upload -->
                    <script src="inc/jquery-file-upload/js/jquery.iframe-transport.js"></script>
                    <script src="inc/jquery-file-upload/js/jquery.fileupload.js"></script>
                    
                    <!-- imgfix -->
                    <script>
                        $('.makalefoto').imgfix({
                            scale: 1.05,
                            coverclass: 'cover',
                            cover: {
                                slide: 'in-up'
                            }
                        });
                    </script>
        <?php   }?>

        <?php   if($_GET['sayfa'] == 'etiketler' || $_GET['sayfa'] == 'ayarlar') {?>
                    <!-- bootstrap colorpicker -->
                    <script src="inc/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <?php   }?>

        <?php   if(!$_GET['sayfa']) {?>
                    <script src="inc/highcharts/highcharts.js"></script>
                    <script src="inc/highcharts/exporting.js"></script>
        <?php   }?>

		<!-- Özel JS Dosyaları -->
		<script src="inc/js/genel.min.js"></script>
    </body>
</html>
