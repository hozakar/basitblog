<?php
    if(!$_SESSION['user']['id']) return;
    if($_POST['id']) {
        $siteurl = $_POST['url'];
        if(substr($siteurl, -1) == '/') $siteurl = substr($siteurl, 0, strlen($siteurl) - 1);
        $anadizin = $_POST['anadizin'];
        while(strpos($anadizin, '//') !== FALSE) $anadizin = str_replace('//', '/', '/'.$anadizin.'/');
        $db->query("
            UPDATE sitebilgi 
            SET 
                dil             = '".s_addslashes($_POST['dil'])."',
                charset         = '".s_addslashes($_POST['charset'])."',
                zamandilimi     = '".s_addslashes($_POST['zamandilimi'])."',
                aciklama        = '".s_addslashes($_POST['aciklama'])."',
                keywords        = '".s_addslashes($_POST['keywords'])."',
                isim            = '".s_addslashes($_POST['isim'])."',
                url             = '".s_addslashes($siteurl)."',
                foto            = '".s_addslashes($_POST['foto'])."',
                baslik          = '".s_addslashes($_POST['baslik'])."',
                asbaslik        = '".s_addslashes($_POST['asbaslik'])."',
                asaltbaslik     = '".s_addslashes($_POST['asaltbaslik'])."',
                tarihformat     = '".s_addslashes($_POST['tarihformat'])."',
                tarihsaatformat = '".s_addslashes($_POST['tarihsaatformat'])."',
                kisametin       = ".(intval($_POST['kisametin']) > 0 ? intval($_POST['kisametin']) : 0).",
                ortametin       = ".(intval($_POST['ortametin']) > 0 ? intval($_POST['ortametin']) : 0).",
                uzunmetin       = ".(intval($_POST['uzunmetin']) > 0 ? intval($_POST['uzunmetin']) : 0).",
                satirsayi       = ".(intval($_POST['satirsayi']) > 0 ? intval($_POST['satirsayi']) : 0).",
                yazar           = '".s_addslashes($_POST['yazar'])."',
                yazarposta      = '".s_addslashes($_POST['yazarposta'])."',
                anadizin        = '".s_addslashes($anadizin)."',
                postaadres      = '".s_addslashes($_POST['postaadres'])."',
                postasunucu     = '".s_addslashes($_POST['postasunucu'])."',
                postakullanici  = '".s_addslashes($_POST['postakullanici'])."',
                postasifre      = '".s_addslashes($_POST['postasifre'])."',
                postaport       = '".s_addslashes($_POST['postaport'])."',
                postaauth       = ".(intval($_POST['postaauth']) > 0 ? intval($_POST['postaauth']) : 0).",
                g_analytics     = '".s_addslashes($_POST['g_analytics'])."',
                aktif           = ".($_POST['aktif'] ? 1 : 0)."
            WHERE id = $_POST[id]");

			$ad = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
            $ad = str_replace('//', '/', $ad.$anadizin.'.htaccess');
            if(file_exists($ad)) {
                $htaccess = file_get_contents($ad);
                $htaccess = explode('ReWriteBase', $htaccess);
                if(count($htaccess) == 2) {
                    $htaccess[1] = end(explode("\n", $htaccess[1], 2));
                    $htaccess = implode('ReWriteBase '.$anadizin."\n", $htaccess);
                    file_put_contents($ad, $htaccess);
                }
            }
    }

    $q = $db->query("SELECT id FROM sosyal WHERE sid = $_SESSION[sid]");
    while($r = current($q->fetch_assoc())) {
        if($_POST['sil_'.$r]) {
            $db->query("DELETE FROM sosyal WHERE id = $r");
        } else {
            $db->query("
                UPDATE sosyal SET
                    isim = '".end(explode('||', $_POST['sosyal_'.$r]))."',
                    ikon = '".current(explode('||', $_POST['sosyal_'.$r]))."',
                    url = '".$_POST['sadres_'.$r]."',
                    renk = '".$_POST['renk_'.$r]."',
                    hoverrenk = '".$_POST['hoverrenk_'.$r]."',
                    sira = ".$_POST['sira_'.$r]."
                WHERE id = $r
            ");
        }
    }

    $yeni = count($_POST['sosyal_yeni']);
    for($i = 0; $i < $yeni; $i++) {
        if($_POST['sil_yeni'][$i] == 0) {
            $db->query("
                INSERT INTO sosyal (isim, ikon, url, renk, hoverrenk, sira, sid) VALUES(
                    '".end(explode('||', $_POST['sosyal_yeni'][$i]))."',
                    '".current(explode('||', $_POST['sosyal_yeni'][$i]))."',
                    '".$_POST['sadres_yeni'][$i]."',
                    '".$_POST['renk_yeni'][$i]."',
                    '".$_POST['hoverrenk_yeni'][$i]."',
                    ".$_POST['sira_yeni'][$i].",
                    ".$_SESSION['sid']."
                )
            ");
        }
    }
    header('location: ?sayfa=ayarlar');
    return;
?>