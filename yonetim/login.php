<?php
    include("inc/sistem/functions.php");
    if($_POST) {
        $kullanici = $db->query("SELECT * FROM kullanicilar WHERE eposta = '$_POST[eposta]' AND sifre = '".md5($_POST['sifre'])."' AND aktif");
        if($kullanici->num_rows > 0) {
			$kullaniciDummy = $kullanici->fetch_assoc();
            if($_POST['eposta'] == $kullaniciDummy['eposta']) {
				$_SESSION['user'] = $kullaniciDummy;
				header('location: '.$sb['anadizin'].'yonetim/');
				return;
			}
        }
    }
    $_SESSION['user'] = NULL;
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

		<!-- Özel Stil Dosyaları -->
		<link href="inc/css/stil.min.css" rel="stylesheet">

		<!-- IE8 Desteği için -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="login">
        <div class="container">
            <div class="row">
                <form class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4 form-horizontal" role="form" method="post">
                    <h3 class="baslik"><?php $site->sbyaz('isim');?></h3>
                    <?php   if($_POST) {?>
                                <div class="alert alert-warning">Kullanıcı Adı ya da Şifre Hatalı!</div>
                    <?php   }?>
                    <div class="form-group row">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                <input type="text" class="form-control" name="eposta" placeholder="E-Posta" value="<?php echo $_POST['eposta']?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" name="sifre" placeholder="Şifre"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 text-right">
                            <button class="btn btn-info">GİRİŞ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
		
        <!-- Genel JavaScript Dosyaları -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="<?php $site->sbyaz('anadizin')?>inc/js/bootstrap.min.js"></script>

		<!-- Özel JS Dosyaları -->
		<script></script>
    </body>
</html>
