<?php
    if(!$_SESSION['user']['id']) return;
    switch ($_POST['islem']) {
        case 'degistir':
            
            $id         = intval($_POST['id']);
            $baslik     = s_addslashes($_POST['baslik']);
            $altbaslik  = s_addslashes($_POST['altbaslik']);
            $aciklama   = htmlspecialchars(s_addslashes($_POST['aciklama']));
            $icerik     = s_addslashes($_POST['icerik']);
            $tarih      = $_POST['tarih'];
            $aktif      = intval($_POST['aktif']);
            $kullanici  = $_SESSION['user']['id'];
            $yapiskan   = intval($_POST['yapiskan']);
            $url        = seo($_POST['baslik'], $id);
            $sablon     = $_POST['sablon'];
            $akis       = intval($_POST['akis']);
            $sid        = $_SESSION['sid'];
            $etiket     = explode(',', $_POST['etiket']);
            
            $icerik = explode('<pre', $icerik);
            for($i = 1; $i < count($icerik); $i++) {
                $icerik[$i] = explode('</pre', $icerik[$i]);
                if(count($icerik[$i]) == 2) {
                    $icerik[$i][0] = implode(chr(13).chr(10), explode('<br>', $icerik[$i][0]));
                    $icerik[$i][0] = implode(chr(13).chr(10), explode('<br/>', $icerik[$i][0]));
                    $icerik[$i][0] = implode(chr(13).chr(10), explode('<br />', $icerik[$i][0]));
                    
                    $icerik[$i] = implode('</pre', $icerik[$i]);
                }
            }
            $icerik = implode('<pre', $icerik);

            if($id) {
                $db->query("
                    UPDATE makaleler SET 
                        baslik = '$baslik',
                        altbaslik = '$altbaslik',
                        aciklama = '$aciklama',
                        icerik = '$icerik',
                        tarih = '$tarih',
                        aktif = $aktif,
                        kullanici = $kullanici,
                        yapiskan = $yapiskan,
                        url = '$url',
                        sablon = '$sablon',
                        akis = $akis,
                        sid = $sid
                    WHERE id = $id
                ");
            } else {
                $db->query("
                    INSERT INTO makaleler 
                    ( 
                        baslik,
                        altbaslik,
                        aciklama,
                        icerik,
                        tarih,
                        aktif,
                        kullanici,
                        yapiskan,
                        url,
                        sablon,
                        akis,
                        sid
                    ) VALUES (
                        '$baslik',
                        '$altbaslik',
                        '$aciklama',
                        '$icerik',
                        '$tarih',
                        $aktif,
                        $kullanici,
                        $yapiskan,
                        '$url',
                        '$sablon',
                        $akis,
                        $sid
                    )
                ");

                $id = current($db->query("SELECT LAST_INSERT_ID() FROM makaleler")->fetch_row());
            }

            $etiketidliste = array();

            $rs = $db->query("SELECT eid FROM etiketgruplari WHERE mid = $id");
            while($item = current($rs->fetch_row())) $etiketidliste[$item] = 'sil';

            foreach($etiket as $item) {
                if($item) {
                    $dummyid = current($db->query("SELECT id FROM etiketler WHERE isim = '".s_addslashes($item)."' AND sid = $_SESSION[sid]")->fetch_row());
                    if(!$dummyid) {
                        $db->query("INSERT INTO etiketler (isim, sid) VALUES('".s_addslashes($item)."', $_SESSION[sid])");
                        $dummyid = current($db->query("SELECT LAST_INSERT_ID() FROM etiketler")->fetch_row());
                    }
                    $etiketidliste[$dummyid] = $etiketidliste[$dummyid] == 'sil' ? 'kal' : 'ekle';
                }
            }
            
            foreach($etiketidliste as $item => $val) {
                switch($val) {
                    case 'sil':
                        $db->query("DELETE FROM etiketgruplari WHERE eid = $item AND mid = $id");
                        break;
                    case 'ekle':
                        $db->query("INSERT INTO etiketgruplari (eid, mid) VALUES($item, $id)");
                        break;
                }
            }

            header("location: ?sayfa=makale&id=".$id.($_POST['acilis'] ? "&acilis=".$_POST['acilis'] : ''));
            return;
            break;
        case 'fotosil':
            if($_POST['id']) {
                $foto = $_POST['id'].current($db->query("SELECT uzanti FROM foto WHERE id = $_POST[id]")->fetch_row());
                $klasorler = explode(',', 'buyuk,normal,minik');
                foreach($klasorler as $klasor) {
                    $yol = $_SERVER['DOCUMENT_ROOT'].$sb['anadizin'];
                    unlink($yol."upload/foto/".$klasor."/".$foto);
                }
                $db->query("DELETE FROM foto WHERE id = $_POST[id]");
            }
            break;
        case 'fotosirala':
            $sira = explode(',', $_POST['sira']);
            $kntr = 0;
            foreach($sira as $item) {
                $kntr++;
                $db->query("UPDATE foto SET sira = $kntr WHERE id = $item");
            }
            break;
    }
    $returndummy = TRUE;
?>