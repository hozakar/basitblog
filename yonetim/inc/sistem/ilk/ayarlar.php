<?php
    if($_POST['id']) {
        $db->query("
            UPDATE sitebilgi 
            SET 
                dil             = '".s_addslashes($_POST['dil'])."',
                charset         = '".s_addslashes($_POST['charset'])."',
                zamandilimi     = '".s_addslashes($_POST['zamandilimi'])."',
                aciklama        = '".s_addslashes($_POST['aciklama'])."',
                keywords        = '".s_addslashes($_POST['keywords'])."',
                isim            = '".s_addslashes($_POST['isim'])."',
                url             = '".s_addslashes($_POST['url'])."',
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
                anadizin        = '".s_addslashes($_POST['anadizin'])."',
                postaadres      = '".s_addslashes($_POST['postaadres'])."',
                postasunucu     = '".s_addslashes($_POST['postasunucu'])."',
                postakullanici  = '".s_addslashes($_POST['postakullanici'])."',
                postasifre      = '".s_addslashes($_POST['postasifre'])."',
                postaport       = '".s_addslashes($_POST['postaport'])."',
                postaauth       = ".(intval($_POST['postaauth']) > 0 ? intval($_POST['postaauth']) : 0)."
            WHERE id = $_POST[id]");
    }
    header('location: ?sayfa=ayarlar');
    return;
?>