<?php
/*
**  Basit Blog 1.0.0
**  https://github.com/hozakar/basitblog
**
**  Copyright 2014, Hakan Özakar
**  http://beltslib.net
**
**  CC0 1.0 Universal Licence ile lisanslanmıştır
**  https://creativecommons.org/publicdomain/zero/1.0/
*/
    include("yonetim/inc/sistem/functions.php");

    if($_POST['yorum']) {
        $mid = current($db->query("SELECT id FROM makaleler WHERE url = '$_REQUEST[url]'")->fetch_row());
        if($mid) {
            $db->query("INSERT INTO yorumlar (mid, yorum, isim, eposta, web) VALUES(
                $mid,
                '".$db->real_escape_string(sql_filtre(htmlspecialchars(s_addslashes($_POST['yorum']))))."',
                '".$db->real_escape_string(sql_filtre(htmlspecialchars(s_addslashes($_POST['isim']))))."',
                '".$db->real_escape_string(sql_filtre(htmlspecialchars(s_addslashes($_POST['eposta']))))."',
                '".$db->real_escape_string(sql_filtre(htmlspecialchars(s_addslashes($_POST['web']))))."'
            )");
        }
        header('location: '.$site->sb['anadizin'].$_REQUEST['url'].'.html');
        return;
    }

    if($_REQUEST['url']) {
        $site->makale($_REQUEST['url']);
        $dosya = getDir('index.php')."yonetim/sablon/".$site->url['sablon'];
    } else {
        $dosya = getDir('index.php')."yonetim/sablon/".$anasayfasablon;
    }

    /* Log tutalım ileride lazım olur... 
	** Kullanıcı girişi yapılmışsa loglara 
	** dahil etmemeyi tercih ederim */
	if(!$_SESSION['user']['id'] > 0) {
		$log_sayfa = 'anasayfa';
		if($_GET['ara']) {
			$log_sayfa = 'arama';
			$log_terim = $db->real_escape_string(strip_tags($_GET['ara']));
		}
		if($_GET['etiket']) {
			$log_sayfa = 'etiket';
			$log_terim = $db->real_escape_string(strip_tags($_GET['etiket']));
		}
		$log_mid = $site->url['id'];
		if($log_mid) {
			$log_sayfa = 'makale';
			$log_terim = '';
		} else {
			$log_mid = "NULL";
		}
		$log_tekil = $_SESSION['ziyaret'] ? 0 : 1;
		$_SESSION['ziyaret'] = 1;

		$db->query("
			INSERT INTO log
			(sayfa, terim, mid, tekil)
			VALUES (
				'$log_sayfa',
				'$log_terim',
				$log_mid,
				$log_tekil
			)
		");
	}

    /* File Open İşlemi ile yapmak istersek
    $handle = fopen($dosya, "rb");
    $icerik = stream_get_contents($handle);
    fclose($handle);
    */

    /* file_get_contents ile */
    $icerik = file_get_contents($dosya);
    
    echo $site->sayfaisle($icerik);
?>