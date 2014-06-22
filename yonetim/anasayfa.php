<div class="container anasayfa">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">En Çok Okunan Makaleler</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <?php
                                $eksql = " AND makaleler.aktif";

                                $rs = $db->query("
                                    SELECT 
                                        makaleler.*, ziyaret.ziyaret
                                    FROM 
                                        makaleler 
                                        LEFT JOIN (
                                            SELECT mid, COUNT(id) as ziyaret
                                            FROM log
                                            GROUP BY mid
                                        ) as ziyaret ON ziyaret.mid = makaleler.id 
                                        LEFT JOIN etiketgruplari ON etiketgruplari.mid = makaleler.id 
                                        LEFT JOIN etiketler ON etiketler.id = etiketgruplari.eid 
                                    WHERE 
                                        makaleler.kullanici = ".$_SESSION['user']['id'].$eksql." 
                                    GROUP BY 
                                        makaleler.id 
                                    ORDER BY 
                                        ziyaret.ziyaret DESC LIMIT 10");
                                while($makale = $rs->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td class="text-muted xs-kapat"><?php echo $makale['ziyaret'];?></td>
                                        <td><a href="?sayfa=makale&id=<?php echo $makale['id'];?>" class="liste-uzun-metin" title="Düzenle"><?php echo $makale['baslik']?></a></td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="?sayfa=makaleler">
                        <i class="fa fa-cog"></i>
                        Tüm Makaleleri Göster
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Pasif Makaleler</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <?php
                                $eksql = " AND NOT makaleler.aktif";

                                $rs = $db->query("SELECT makaleler.* FROM makaleler LEFT JOIN etiketgruplari ON etiketgruplari.mid = makaleler.id LEFT JOIN etiketler ON etiketler.id = etiketgruplari.eid WHERE makaleler.kullanici = ".$_SESSION['user']['id'].$eksql." GROUP BY makaleler.id ORDER BY makaleler.tarih DESC");
                                while($makale = $rs->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td class="text-muted xs-kapat"><?php echo date('d/m/Y', strtotime($makale['tarih']));?></td>
                                        <td><a href="?sayfa=makale&id=<?php echo $makale['id'];?>" class="liste-uzun-metin" title="Düzenle"><?php echo $makale['baslik']?></a></td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="?sayfa=makaleler">
                        <i class="fa fa-cog"></i>
                        Tüm Makaleleri Göster
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">En Çok Ziyaret Alan Etiketler</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <?php
                                //$sql = "SELECT etiketler.*, IFNULL(sayi.sayi, 0) as sayi FROM etiketler LEFT JOIN (SELECT eid, COUNT(eid) as sayi FROM etiketgruplari INNER JOIN makaleler ON makaleler.id = etiketgruplari.`mid` AND makaleler.kullanici = ".$_SESSION['user']['id']." GROUP BY eid)  as sayi ON sayi.eid = etiketler.id ORDER BY sayi.sayi DESC LIMIT 10";
                                $sql = "
                                    SELECT 
                                        etiketler.*, IFNULL(sayi.sayi, 0) as sayi, ziyaret.ziyaret
                                    FROM 
                                        etiketler 
                                        LEFT JOIN (
                                            SELECT IFNULL(COUNT(id), 0) as ziyaret, terim, sayfa
                                            FROM
                                                log
                                            GROUP BY terim
                                        ) as ziyaret ON ziyaret.sayfa = 'etiket' AND ziyaret.terim = etiketler.isim
                                        LEFT JOIN (
                                            SELECT 
                                                eid, COUNT(eid) as sayi 
                                            FROM 
                                                etiketgruplari 
                                                INNER JOIN makaleler ON makaleler.id = etiketgruplari.`mid` AND makaleler.kullanici = ".$_SESSION['user']['id']." 
                                            GROUP BY eid
                                        )  as sayi ON sayi.eid = etiketler.id 
                                    ORDER BY ziyaret.ziyaret DESC LIMIT 10";
                                $rs = $db->query($sql);
                                while($etiket = $rs->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td class="text-muted xs-kapat"><?php echo $etiket['ziyaret'];?></td>
                                        <td><a href="?sayfa=makaleler&etiket=<?php echo $etiket['isim']?>" class="liste-uzun-metin" title="İlgili Makaleleri Aç"><?php echo $etiket['isim']?></a></td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <?php
                        if($_SESSION['user']['duzey']) {
                    ?>
                            <a href="?sayfa=etiketler">
                                <i class="fa fa-cog"></i>
                                Tüm Etiketleri Göster
                            </a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Onay Bekleyen Yorumlar</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <?php
                                $sql = "SELECT yorumlar.* FROM yorumlar INNER JOIN makaleler ON makaleler.id = yorumlar.`mid` AND makaleler.kullanici = ".$_SESSION['user']['id']." WHERE NOT yorumlar.aktif ORDER BY yorumlar.id DESC";
                                $rs = $db->query($sql);
                                while($yorum = $rs->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td class="text-muted xs-kapat"><?php echo date('d/m/Y', strtotime($yorum['tarih']));?></td>
                                        <td><a href="?sayfa=makale&id=<?php echo $yorum['mid']?>&acilis=yorumlar" class="liste-uzun-metin" title="İlgili Makaleyi Aç"><?php echo $yorum['yorum']?></a></td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="?sayfa=yorumlar">
                        <i class="fa fa-cog"></i>
                        Tüm Yorumları Göster
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>