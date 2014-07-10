<?php
    session_start();
    $durum = "basla";
    if($_POST) {
        if($_POST['islem'] == 'vt_kur') {
            $db = new mysqli($_POST['sunucu'], $_POST['kullanici'], $_POST['sifre'], $_POST['isim']);
            if($db->connect_errno) {
                $durum = 'baglanti_hata';
            } else {
                $vtbilgiicerik = '<?php
    /*veri Tabanı Aktivasyonu*/
    $vt_bilgi = array(
        "sunucu"    => "'.$_POST['sunucu'].'",
        "kullanici" => "'.$_POST['kullanici'].'",
        "sifre"     => "'.$_POST['sifre'].'",
        "isim"      => "'.$_POST['isim'].'"
    );
?>';
                file_put_contents('inc/sistem/vtbilgi.php', $vtbilgiicerik);

                $db->query("DROP TABLE IF EXISTS `yorumlar`");
                $db->query("DROP TABLE IF EXISTS `sosyal`");
                $db->query("DROP TABLE IF EXISTS `log`");
                $db->query("DROP TABLE IF EXISTS `foto`");
                $db->query("DROP TABLE IF EXISTS `etiketgruplari`");
                $db->query("DROP TABLE IF EXISTS `etiketler`");
                $db->query("DROP TABLE IF EXISTS `makaleler`");
                $db->query("DROP TABLE IF EXISTS `kullanicilar`");
                $db->query("DROP TABLE IF EXISTS `sitebilgi`");

                $db->query("
                    CREATE TABLE `sitebilgi` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `dil` varchar(5) NOT NULL DEFAULT 'tr',
                      `charset` varchar(255) NOT NULL DEFAULT 'utf-8',
                      `zamandilimi` varchar(255) NOT NULL DEFAULT 'Asia/Istanbul',
                      `aciklama` varchar(1000) DEFAULT NULL,
                      `keywords` varchar(255) DEFAULT NULL,
                      `isim` varchar(255) DEFAULT NULL,
                      `url` varchar(255) DEFAULT NULL,
                      `foto` varchar(255) DEFAULT NULL,
                      `baslik` varchar(255) DEFAULT NULL,
                      `asbaslik` varchar(255) DEFAULT NULL,
                      `asaltbaslik` varchar(255) DEFAULT NULL,
                      `tarihformat` varchar(24) NOT NULL DEFAULT 'd/m/Y',
                      `tarihsaatformat` varchar(24) NOT NULL DEFAULT 'd/m/Y H:i',
                      `kisametin` smallint(6) NOT NULL DEFAULT '25',
                      `ortametin` smallint(6) NOT NULL DEFAULT '60',
                      `uzunmetin` smallint(6) NOT NULL DEFAULT '120',
                      `satirsayi` tinyint(4) NOT NULL DEFAULT '10',
                      `yazar` varchar(255) DEFAULT NULL,
                      `yazarposta` varchar(255) DEFAULT NULL,
                      `anadizin` varchar(255) NOT NULL DEFAULT '/',
                      `postaadres` varchar(255) DEFAULT NULL,
                      `postasunucu` varchar(255) DEFAULT NULL,
                      `postakullanici` varchar(255) DEFAULT NULL,
                      `postasifre` varchar(255) DEFAULT NULL,
                      `postaport` varchar(255) DEFAULT NULL,
                      `postaauth` tinyint(4) NOT NULL DEFAULT '1',
                      `g_analytics` text,
                      `aktif` tinyint(4) NOT NULL DEFAULT '0',
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
                ");

                $db->query("
                    CREATE TABLE `kullanicilar` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `isim` varchar(255) NOT NULL,
                      `eposta` varchar(255) NOT NULL,
                      `sifre` varchar(255) NOT NULL,
                      `duzey` tinyint(4) NOT NULL DEFAULT '0',
                      `sid` int(11) NOT NULL DEFAULT '1',
                      `aktif` tinyint(4) NOT NULL DEFAULT '1',
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `eposta` (`eposta`),
                      KEY `sid` (`sid`),
                      CONSTRAINT `kullanicilar_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sitebilgi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
                ");

                $db->query("
                    CREATE TABLE `makaleler` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `baslik` varchar(255) NOT NULL,
                      `altbaslik` varchar(255) DEFAULT NULL,
                      `icerik` text,
                      `aciklama` varchar(1000) DEFAULT NULL,
                      `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      `aktif` tinyint(4) NOT NULL DEFAULT '0',
                      `kullanici` int(11) NOT NULL,
                      `yapiskan` tinyint(4) NOT NULL DEFAULT '0',
                      `url` varchar(255) DEFAULT NULL,
                      `sablon` varchar(255) NOT NULL DEFAULT 'makale.html',
                      `akis` tinyint(4) NOT NULL DEFAULT '1',
                      `sid` int(11) NOT NULL,
                      PRIMARY KEY (`id`),
                      KEY `baslik` (`baslik`),
                      KEY `altbaslik` (`altbaslik`),
                      KEY `tarih` (`tarih`),
                      KEY `aktif` (`aktif`),
                      KEY `kullanici` (`kullanici`),
                      KEY `sid` (`sid`),
                      CONSTRAINT `makaleler_ibfk_1` FOREIGN KEY (`kullanici`) REFERENCES `kullanicilar` (`id`) ON UPDATE CASCADE,
                      CONSTRAINT `makaleler_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `sitebilgi` (`id`) ON UPDATE CASCADE
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
                ");

                $db->query("
                    CREATE TABLE `etiketler` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `isim` varchar(255) NOT NULL,
                      `menu` tinyint(4) NOT NULL DEFAULT '0',
                      `renk` varchar(10) NOT NULL DEFAULT '#ccc',
                      `sid` int(11) NOT NULL,
                      PRIMARY KEY (`id`),
                      KEY `isim` (`isim`),
                      KEY `menu` (`menu`),
                      KEY `sid` (`sid`),
                      CONSTRAINT `etiketler_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sitebilgi` (`id`) ON UPDATE CASCADE
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
                ");

                $db->query("
                    CREATE TABLE `etiketgruplari` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `eid` int(11) NOT NULL,
                      `mid` int(11) NOT NULL,
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `eid_2` (`eid`,`mid`),
                      KEY `eid` (`eid`),
                      KEY `mid` (`mid`),
                      CONSTRAINT `etiketgruplari_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `etiketler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                      CONSTRAINT `etiketgruplari_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
                ");

                $db->query("
                    CREATE TABLE `foto` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `mid` int(11) DEFAULT NULL,
                      `uzanti` varchar(5) NOT NULL,
                      `sira` int(11) NOT NULL DEFAULT '999999',
                      PRIMARY KEY (`id`),
                      KEY `mid` (`mid`),
                      KEY `uzanti` (`uzanti`),
                      KEY `sira` (`sira`),
                      CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
                ");

                $db->query("
                    CREATE TABLE `log` (
                      `id` bigint(20) NOT NULL AUTO_INCREMENT,
                      `sayfa` varchar(255) DEFAULT NULL,
                      `terim` varchar(1000) DEFAULT NULL,
                      `mid` int(11) DEFAULT NULL,
                      `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      `tekil` tinyint(4) NOT NULL DEFAULT '0',
                      PRIMARY KEY (`id`),
                      KEY `sayfa` (`sayfa`),
                      KEY `terim` (`terim`(255)),
                      KEY `mid` (`mid`),
                      KEY `tarih` (`tarih`),
                      KEY `tekil` (`tekil`),
                      CONSTRAINT `log_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
                ");

                $db->query("
                    CREATE TABLE `sosyal` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `isim` varchar(255) NOT NULL,
                      `url` varchar(255) NOT NULL,
                      `ikon` varchar(255) NOT NULL DEFAULT 'fa-circle',
                      `renk` varchar(10) NOT NULL DEFAULT 'black',
                      `hoverrenk` varchar(10) NOT NULL DEFAULT 'white',
                      `sid` int(11) NOT NULL,
                      `sira` int(11) NOT NULL DEFAULT '999999',
                      PRIMARY KEY (`id`),
                      KEY `sid` (`sid`),
                      CONSTRAINT `sosyal_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sitebilgi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
                ");

                $db->query("
                    CREATE TABLE `yorumlar` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `mid` int(11) NOT NULL,
                      `yorum` varchar(1000) DEFAULT NULL,
                      `isim` varchar(255) DEFAULT NULL,
                      `eposta` varchar(255) DEFAULT NULL,
                      `web` varchar(255) DEFAULT NULL,
                      `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      `aktif` tinyint(4) NOT NULL DEFAULT '0',
                      PRIMARY KEY (`id`),
                      KEY `mid` (`mid`),
                      KEY `tarih` (`tarih`),
                      CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
                ");

                $db->query("
                    INSERT INTO `sitebilgi` (`isim`, `url`, `foto`, `baslik`, `asbaslik`, `aktif`) VALUES(
                        '".$_SERVER['SERVER_NAME']."',
                        'http://".$_SERVER['SERVER_NAME']."',
                        '/inc/images/varsayilan.png',
                        '".$_SERVER['SERVER_NAME']."',
                        '".$_SERVER['SERVER_NAME']."',
                        0
                    )
                ");

                $db->query("INSERT INTO `sosyal` VALUES (NULL, 'Twitter', 'http://twitter.com/', 'twitter', '#00abf0', '#ffffff', '1', '0')");
                $db->query("INSERT INTO `sosyal` VALUES (NULL, 'Facebook', 'http://facebook.com/', 'facebook', '#3c599f', '#ffffff', '1', '1')");
                $db->query("INSERT INTO `sosyal` VALUES (NULL, 'Google+', 'http://plus.google.com/', 'google-plus', '#f03f27', '#ffffff', '1', '2')");
                $db->query("INSERT INTO `sosyal` VALUES (NULL, 'RSS', '/rss.xml', 'rss', '#fea501', '#ffffff', '1', '3')");

                $db->close();
                $durum = 'kullanici';
            }
        } elseif($_POST['islem'] == 'kullanici') {
            include('inc/sistem/vtbilgi.php');

            $db = new mysqli($vt_bilgi['sunucu'], $vt_bilgi['kullanici'], $vt_bilgi['sifre'], $vt_bilgi['isim']);
            if($db->connect_errno) {
                $durum = 'baglanti_hata';
            } else {
                $hoy = $db->query("INSERT INTO `kullanicilar` VALUES (NULL, '".addslashes($_POST['isim'])."', '".addslashes($_POST['eposta'])."', '".md5($_POST['sifre'])."', 1, 1, 1)");
                $durum = ($hoy ? 'sitebilgi' : 'baglanti_hata');
            }
            $rs = $db->query("SELECT * FROM sitebilgi WHERE id = 1")->fetch_assoc();
        } elseif($_POST['islem'] == 'sitebilgi') {
            include('inc/sistem/vtbilgi.php');
            
            $db = new mysqli($vt_bilgi['sunucu'], $vt_bilgi['kullanici'], $vt_bilgi['sifre'], $vt_bilgi['isim']);
            if($db->connect_errno) {
                $durum = 'baglanti_hata';
            } else {
				$anadizin = $_POST['anadizin'];
				while(strpos($anadizin, '//') !== FALSE) $anadizin = str_replace('//', '/', '/'.$anadizin.'/');
                $hoy = $db->query("
                    UPDATE `sitebilgi` SET
                        isim = '".addslashes($_POST['isim'])."',
                        aciklama = '".addslashes($_POST['aciklama'])."',
                        keywords = '".addslashes($_POST['keywords'])."',
                        url = '".addslashes($_POST['url'])."',
                        baslik = '".addslashes($_POST['baslik'])."',
                        asbaslik = '".addslashes($_POST['asbaslik'])."',
                        asaltbaslik = '".addslashes($_POST['asaltbaslik'])."',
                        yazar = '".addslashes($_POST['yazar'])."',
                        yazarposta = '".addslashes($_POST['yazarposta'])."',
						anadizin = '".addslashes($anadizin)."'
                    WHERE id = 1
                ");

				$ad = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
                $ad = str_replace('//', '/', $ad.$anadizin.'.htaccess');
                if(file_exists($ad)) {
                    $htaccess = file_get_contents($ad);
                    $htaccess = explode('ReWriteBase', $htaccess);
                    if(count($htaccess) == 2) {
                        $htaccess[1] = end(explode(chr(13).chr(10), $htaccess[1], 2));
                        $htaccess = implode('ReWriteBase '.$anadizin.chr(13).chr(10), $htaccess);
                        file_put_contents($ad, $htaccess);
                    }
                }

                $durum = ($hoy ? 'tamam' : 'baglanti_hata');
            }
        }
    } else {
        if(file_exists('inc/sistem/vtbilgi.php')) {
            echo '<h1 style="text-align: center;">Site kurulumu zaten yapilmis!</h1>';
            return;
        }
    }
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
		<!-- Standart Metalar -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Basit Blog Kurulum</title>

		<!-- Bootstrap CSS -->
		<link href="../inc/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link href="../inc/css/font-awesome.min.css" rel="stylesheet">

        <!-- Yazı Tipleri -->
        <link href='http://fonts.googleapis.com/css?family=Oswald|Roboto:400,400italic,700,700italic&subset=latin-ext,latin' rel='stylesheet' type='text/css'>

		<!-- Özel Stil Dosyaları -->
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
        <br>
		<div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <?php
                        if($durum == 'basla' || $durum == 'baglanti_hata') {
                    ?>
                            <h1 class="text-center">
                                Basit Blog Kurulumu<br>
                                <small>Hoş geldiniz...</small>
                            </h1>
                            <p class="text-center">
                                Öncelikle sunucunuzda boş bir MySQL veri tabanı yaratarak bu veri tabanı ile ilgili kullanım bilgilerini aşağıdaki kutulara giriniz.<br><br><br>
                            </p>

                            <form class="form form-horizontal" method="post">
                                <?php   if($durum == 'baglanti_hata') {?>
                                            <div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i>&nbsp;Veri Tabanına Bağlanılamadı!</div>
                                <?php   }?>
                                <input type="hidden" name="islem" value="vt_kur" />
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input name="sunucu" required class="form-control" placeholder="Sunucu Adresi" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input name="isim" required class="form-control" placeholder="Veri Tabanı İsmi" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input name="kullanici" required class="form-control" placeholder="Kullanıcı Adı" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input name="sifre" class="form-control" placeholder="Şifre" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button class="btn btn-success" style="width: 100%;">DEVAM</button>
                                    </div>
                                </div>
                            </form>
                    <?php
                        } elseif($durum == 'kullanici') {
                    ?>
                            <h1 class="text-center">
                                Basit Blog Kurulumu<br>
                                <small>Kullanıcı Bilgileri...</small>
                            </h1>
                            <p class="text-center">
                                Lütfen sitenizin yetkili ana kullanıcısını oluşturun.<br><br><br>
                            </p>

                            <form class="form form-horizontal" method="post">
                                <input type="hidden" name="islem" value="kullanici" />
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input name="isim" required class="form-control" placeholder="Ad" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input name="eposta" type="email" required class="form-control" placeholder="E-Posta" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input name="sifre" required class="form-control" placeholder="Şifre" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button class="btn btn-success" style="width: 100%;">DEVAM</button>
                                    </div>
                                </div>
                            </form>
                    <?php
                        } elseif($durum == 'sitebilgi') {
                    ?>
                            <h1 class="text-center">
                                Basit Blog Kurulumu<br>
                                <small>Site Bilgileri...</small>
                            </h1>
                            <p class="text-center">
                                Lütfen siteniz ile ilgili temel bilgileri giriniz.<br>Daha detaylı ayarlamaları <strong>Yönetim Panelinden</strong> yapabilirsiniz.<br><br><br>
                            </p>

                            <form class="form form-horizontal" method="post">
                                <input type="hidden" name="islem" value="sitebilgi" />
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Site İsmi</label>
                                        <input name="isim" required class="form-control" placeholder="Site İsmi" value="<?php echo $rs['isim'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Açıklama</label>
                                        <input name="aciklama" class="form-control" placeholder="Açıklama" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Anahtar Kelimeler</label>
                                        <input name="keywords" class="form-control" placeholder="Anahtar Kelimeler" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Site Adresi</label>
                                        <input name="url" type="url" required class="form-control" placeholder="Site Adresi" value="<?php echo $rs['url'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Ana Dizin</label>
                                        <input name="anadizin" type="text" class="form-control" placeholder="Ana Dizin" value="<?php echo $rs['anadizin'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Site Başlığı</label>
                                        <input name="baslik" class="form-control" placeholder="Site Başlığı" value="<?php echo $rs['baslik'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Ana Sayfa Başlığı</label>
                                        <input name="asbaslik" class="form-control" placeholder="Ana Sayfa Başlığı" value="<?php echo $rs['asbaslik'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Ana Sayfa Alt Başlığı</label>
                                        <input name="asaltbaslik" class="form-control" placeholder="Ana Sayfa Alt Başlığı" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Site Yazarı</label>
                                        <input name="yazar" required class="form-control" placeholder="Site Yazarı" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Yazar E-Posta</label>
                                        <input name="yazarposta" type="email" required class="form-control" placeholder="Yazar E-Posta" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button class="btn btn-success" style="width: 100%;">DEVAM</button>
                                    </div>
                                </div>
                            </form>
                    <?php
                            $db->close();
                        } elseif($durum == 'tamam') {
                            $_SESSION['user'] = $db->query("SELECT * FROM kullanicilar WHERE id = 1")->fetch_assoc();
                            $db->close();
                    ?>
                            <h1 class="text-center">
                                Basit Blog Kurulumu<br>
                                <small>Kurulum Tamamlandı...</small>
                            </h1>
                            <p class="text-center">
                                Lütfen siteniz ile ilgili detaylı ayarlamaları <strong>Yönetim Panelinde Site Bilgileri</strong> sayfasından yapınız.<br><br>
                            </p>

                            <a href="index.php?sayfa=ayarlar" class="btn btn-success" style="width: 100%;">KULLANMAYA BAŞLA</a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Genel JavaScript Dosyaları -->
		<script src="../inc/js/bootstrap.min.js"></script>
    </body>
</html>
