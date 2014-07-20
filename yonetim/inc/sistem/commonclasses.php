<?php

class site {
    public $sb; //Sayfa Bilgi
    public $db; //Database

    public $q; //Query

    public $sayfasayi; //Son oluşturulan makale listesindeki sayfa sayisi.

    public $url; //Makale içerikleri bu değişkende bulunacak.

    function __construct() {
        global $sb;
        global $db;
        $this->sb = $sb;
        $this->db = $db;
    }

    public function makale($gelen) {
        if(!$gelen) $gelen = $_REQUEST['url'];
        if(!$gelen) return;
		$kim = $_SESSION['user']['id'] ? $_SESSION['user']['id'] : 0;

        $sql = "
            SELECT
                makaleler.*, 
                kullanicilar.isim as yazar, 
                kullanicilar.eposta as yazarposta,
                kullanicilar.eposta as gravatar
            FROM 
                makaleler 
            INNER JOIN kullanicilar 
                ON kullanicilar.id = makaleler.kullanici 
            WHERE 
                url = '$gelen'
                AND (makaleler.aktif OR makaleler.kullanici = ".$kim.")
                
        ";
        
        $rs = $this->db->query($sql);
        $this->url = $rs->fetch_array();
        
        $sql = "SELECT etiketler.* FROM etiketgruplari INNER JOIN etiketler ON etiketler.id = etiketgruplari.eid WHERE etiketgruplari.mid = ".$this->url['id']." ORDER BY etiketler.isim";
        $rs = $this->db->query($sql);
        $item = array();
        $fullitem = array();
        while($dummy = $rs->fetch_array()) {
            array_push($item, $dummy['isim']);
            array_push($fullitem, $dummy);
        }
        $this->url['etiketler'] = $fullitem;
        $this->url['etiketliste'] = implode(', ', $item);
        
        $sql = "SELECT CONCAT(id, uzanti) as isim FROM foto WHERE mid = ".$this->url['id']." ORDER BY sira";
        $rs = $this->db->query($sql);
        $item = array();
        while($dummy = $rs->fetch_array()) array_push($item, $dummy);
        $this->url['foto'] = $item;
        $this->url['ilkfoto'] = $item[0]['isim'];
    }

    public function sayfaisle($gelen) {
        $dummy = '';
        while($item = explode('[[ekle((', $gelen, 2)) {
            if(count($item) < 2) {
                $dummy .= $item[0];
                break;
            }
            $dummy .= $item[0];
            $item = explode('))]]', $item[1], 2);
            $dummy .= file_get_contents(getDir('index.php')."yonetim/sablon/".$item[0]);
            $gelen = $item[1];
        }
        $gelen = $dummy;

        while($item = explode('[[', $gelen, 2)) {
            if(count($item) < 2) {
                echo $item[0];
                break;
            }
            echo $item[0];
            $item = explode(']]', $item[1], 2);
            $gelen = $item[1];
            $this->calistir($item[0]);
        }
    }

    private function calistir($gelen) {
        $gelen = explode('((', $gelen, 2);
        $func = $gelen[0];
        $gelen = explode('))', $gelen[1], 2);
        $param = explode(',', $gelen[0]);
        $kod = current(explode('}}', end(explode('{{', $gelen[1], 2))));
        
        switch($func) {
            case 'sitebilgi':
                echo $this->sitebilgi($param[0]);
                break;
            case 'liste':
                $this->liste($kod);
                break;
            case 'menu':
                $this->menu($param[0], $kod);
                break;
            case 'sosyal':
                $this->sosyal($kod);
                break;
            case 'makalegaleri':
                $this->makalegaleri($kod, $param[0], $param[1]);
                break;
            case 'oncekisayfa':
                echo $this->sayfa('onceki', $param[0], $param[1]);
                break;
            case 'sonrakisayfa':
                echo $this->sayfa('sonraki', $param[0], $param[1]);
                break;
            case 'sayfabilgi':
                echo $this->sayfabilgi($param[0]);
                break;
            case 'etiket':
                echo $this->etiket($kod);
                break;
            case 'yorum':
                echo $this->yorum($kod);
                break;
            case 'oncekiyazi':
                echo $this->yazi('onceki', $param[0]);
                break;
            case 'sonrakiyazi':
                echo $this->yazi('sonraki', $param[0]);
                break;
            case 'sonyazilar':
                echo $this->sonyazilar($param[0], $kod);
                break;
        }
    }

    private function sitebilgi($alan) {
        $deger = $this->sb[$alan];
        if($alan == 'foto' && strpos($deger, '://') === FALSE) $deger = str_replace('//', '/', $this->sb['anadizin'].$deger);
        if($alan == 'gravatar') $deger = "http://www.gravatar.com/avatar/".md5(strtolower(trim($this->sb['yazarposta'])))."?s=120";
        return $deger;
    }

    private function sayfabilgi($alan) {
        return $this->bicimlendir($alan, $this->url[$alan]);
    }

    private function liste($kod) {
        $sayfa = $_REQUEST['sayfa'] ? $_REQUEST['sayfa'] : 1;
        
        $tip = 'tum';
        if($_REQUEST['etiket']) $tip = 'etiket';
        if($_REQUEST['ara']) $tip = 'ara';

        $sql = "
            SELECT 
                makaleler.*, makaleler.icerik as kisametin, makaleler.icerik as ortametin, makaleler.icerik as uzunmetin, CONCAT(foto.id, foto.uzanti) as foto, IFNULL(renksec.renk, '#ccc') as renk, kullanicilar.isim as yazar
            FROM 
                makaleler 
            LEFT JOIN 
                etiketgruplari ON etiketgruplari.mid = makaleler.id 
            LEFT JOIN 
                etiketler ON etiketler.id = etiketgruplari.eid 
            INNER JOIN
                kullanicilar ON kullanicilar.id = makaleler.kullanici
            LEFT JOIN foto ON foto.mid = makaleler.id
            LEFT JOIN 
                etiketler as renksec ON renksec.id = etiketgruplari.eid AND renksec.menu
        ";
        $ara = $tip != 'tum' ? '%'.implode('%', explode(' ', $_REQUEST[$tip])).'%' : '';
        switch($tip) {
            case "etiket": /* etiket */
                $sql .= "
                    WHERE 
                        makaleler.aktif ".(!$ara ? "" : "
                        AND etiketler.isim LIKE '$ara'")."
                        AND makaleler.sid = $_SESSION[sid]
                    GROUP BY makaleler.id
                    ORDER BY makaleler.tarih DESC, foto.sira
                ";
                break;
            default: /* Tüm ve ara */
                $sql .= "
                    WHERE 
                        makaleler.aktif ".(!$ara ? "" : "
                        AND (
                            CONCAT(IFNULL(makaleler.baslik, ''), ' ', IFNULL(makaleler.altbaslik, ''), ' ', IFNULL(makaleler.icerik, ''), ' ', IFNULL(makaleler.aciklama, '')) LIKE '$ara'
                            OR etiketler.isim LIKE '$ara'
                            OR kullanicilar.isim LIKE '$ara'
                            OR kullanicilar.eposta LIKE '$ara'
                        ) ")."
                        AND makaleler.sid = $_SESSION[sid]
                        ".($tip=='tum' ? "AND makaleler.akis" : "")."
                    GROUP BY makaleler.id
                    ORDER BY ".(!$ara ? "makaleler.yapiskan DESC, " : "")."makaleler.tarih DESC, foto.sira
                ";
        }
        $lc = " LIMIT ".(($sayfa - 1) * $this->sb['satirsayi']).", ".$this->sb['satirsayi'];

        $rs = $this->db->query($sql);
        $satir = $rs->num_rows;
        $this->sayfasayi = ceil($satir / $this->sb['satirsayi']);
        
        $sql .= $lc;

        $rs = $this->db->query($sql);
        while($rec = $rs->fetch_array()) $this->donguicerik($rec, $kod);
    }

    private function menu($tum, $kod) {
        $sql = "
            SELECT etiketler.* 
            FROM etiketler 
            LEFT JOIN etiketgruplari ON etiketgruplari.eid = etiketler.id
            LEFT JOIN makaleler ON etiketgruplari.mid = makaleler.id AND makaleler.aktif
            WHERE 
                menu
                AND etiketler.sid = $_SESSION[sid]
                ".(!$tum ? "AND NOT ISNULL(makaleler.id)" : "")."
            GROUP BY
                etiketler.id
            ORDER BY etiketler.isim
        ";

        $rs = $this->db->query($sql);
        while($rec = $rs->fetch_array()) $this->donguicerik($rec, $kod);
    }

    private function sosyal($kod) {
        $sql = "
            SELECT *, url as fullurl 
            FROM sosyal 
            WHERE 
                sid = $_SESSION[sid]
            ORDER BY sira
        ";

        $rs = $this->db->query($sql);
        while($rec = $rs->fetch_array()) $this->donguicerik($rec, $kod);
    }

    private function makalegaleri($kod, $ilk, $sayi) {
        $sql = "
            SELECT
                CONCAT('".$this->sb['anadizin']."upload/foto/minik/', id, uzanti) as minik,
                CONCAT('".$this->sb['anadizin']."upload/foto/normal/', id, uzanti) as normal,
                CONCAT('".$this->sb['anadizin']."upload/foto/buyuk/', id, uzanti) as buyuk
            FROM foto 
            WHERE 
                mid = ".$this->url['id']."
            ORDER BY sira
        ";

        if($ilk && $sayi) {
            $sql .= " LIMIT ".$ilk.", ".$sayi;
        }

        $rs = $this->db->query($sql);
        while($rec = $rs->fetch_array()) $this->donguicerik($rec, $kod);
    }

    private function yorum($kod) {
        $sql = "
            SELECT *, tarih as tarihsaat, eposta as gravatar
            FROM yorumlar
            WHERE 
                mid = ".$this->url['id']."
                AND aktif
            ORDER BY tarih DESC
        ";

        $rs = $this->db->query($sql);
        while($rec = $rs->fetch_array()) $this->donguicerik($rec, $kod);
    }

    private function etiket($kod) {
        foreach($this->url['etiketler'] as $rec) {
            $this->donguicerik($rec, $kod);
        }
    }

    private function donguicerik($rec, $kod) {
        $dummy = explode('@]', $kod);
        foreach($dummy as $item) {
            $item = explode('[@=', $item);
            echo $item[0];
            if($item[1]) echo $this->bicimlendir($item[1], $rec[$item[1]]);
        }
    }

    private function bicimlendir($isim, $deger) {
        switch($isim) {
            case 'tarih':
                $deger = date($this->sb['tarihformat'], strtotime($deger));
                break;
            case 'tarihsaat':
                $deger = date($this->sb['tarihsaatformat'], strtotime($deger));
                break;
            case 'kisametin':
            case 'ortametin':
            case 'uzunmetin':
                $deger = strip_tags($deger);
                $deger = str_replace(array(
                    chr(13),
                    chr(9),
                    chr(10)
                ), ' ', $deger);
                $deger = str_replace('  ', ' ', trim($deger));
                $deger = explode(' ', $deger, $this->sb[$isim] + 1);
                $comma = '';
                if(count($deger) > $this->sb[$isim]) {
                    array_pop($deger);
                    $comma = '...';
                }
                $deger = implode(' ', $deger).$comma;
                break;
            case 'url':
                $deger = $this->sb['anadizin'].$deger.'.html';
                break;
			case 'anadizin':
				$deger = $this->sb['anadizin'];
				break;
            case 'gravatar':
                $deger = "http://www.gravatar.com/avatar/".md5(strtolower(trim($deger)))."?s=120";
                break;
        }
        return sql_filtre($deger, TRUE);
    }

    private function sayfa($yon, $tip, $sayfasayi) {
        if(!$sayfasayi) {
            $sayfa = $_REQUEST['sayfa'] ? $_REQUEST['sayfa'] : 1;
        } else {
            $sayfa = $sayfasayi;
        }

        if($yon == 'onceki') {
            $sayfa -= 1;
            $sayfa = max($sayfa, 0);
            $gosterim = ($sayfa > 0 ? '' : 'hidden');
        } else {
            $sayfa += 1;
            $gosterim = ($sayfa > $this->sayfasayi ? 'hidden' : '');
            $sayfa = min($sayfa, $this->sayfasayi);
        }

        $cevap = array(
            'sayfa' => $sayfa,
            'gosterim' => $gosterim
        );

        return $cevap[$tip];
    }

    private function yazi($yon, $tip) {
        $sql = "SELECT * FROM makaleler WHERE aktif ORDER BY tarih";

        $rs = $this->db->query($sql);
        $yazi = array(
            'onceki' => array(
                'sayfa' => '',
                'gosterim' => 'hidden'
            ),
            'sonraki' => array(
                'sayfa' => '',
                'gosterim' => 'hidden'
            )
        );
        $crnt = 'onceki';
        while($rec = $rs->fetch_array()) {
            if($this->url['id'] == $rec['id']) {
                $crnt = 'sonraki';
            } else {
                $yazi[$crnt]['sayfa'] = $rec['url'];
                $yazi[$crnt]['gosterim'] = '';
                if($crnt == 'sonraki') break;
            }
        }
        return $yazi[$yon][$tip];
    }

    private function sonyazilar($sayi = 3, $kod) {
        $sql = "
            SELECT 
                makaleler.*, CONCAT(foto.id, foto.uzanti) as foto, IFNULL(renksec.renk, '#ccc') as renk
            FROM 
                makaleler 
            LEFT JOIN 
                etiketgruplari ON etiketgruplari.mid = makaleler.id 
            LEFT JOIN 
                etiketler as renksec ON renksec.id = etiketgruplari.eid
            LEFT JOIN
                foto ON foto.mid = makaleler.id
            WHERE 
                makaleler.aktif
                AND makaleler.sid = $_SESSION[sid]
                AND makaleler.id <> ".$this->url['id']."
				AND renksec.menu
            GROUP BY makaleler.id
            ORDER BY makaleler.tarih DESC, foto.sira
            LIMIT 0, $sayi
        ";
        $rs = $this->db->query($sql);
        while($rec = $rs->fetch_array()) $this->donguicerik($rec, $kod);
    }

    public function sbyaz($gelen) {
        echo $this->sb[$gelen];
    }
}
?>