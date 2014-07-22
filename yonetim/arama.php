<?php   if(!$_SESSION['user']['id']) return;?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1>ARAMA SONUÇLARI</h1>
        </div>
    </div>

    <div class="ayrac"></div>
    
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="xs-kapat">Tarih</th>
                        <th>Makale Adı</th>
                        <th class="xs-kapat">Etiketler</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "
                            SELECT makaleler.* 
                            FROM 
                                makaleler 
                                LEFT JOIN etiketgruplari ON etiketgruplari.mid = makaleler.id 
                                LEFT JOIN etiketler ON etiketler.id = etiketgruplari.eid 
                                LEFT JOIN yorumlar ON yorumlar.mid = makaleler.id
                            WHERE 
                                makaleler.kullanici = ".$_SESSION['user']['id']." 
                                AND (
                                    makaleler.baslik LIKE '%".$_GET['hizliara']."%'
                                    OR makaleler.altbaslik LIKE '%".$_GET['hizliara']."%'
                                    OR makaleler.icerik LIKE '%".$_GET['hizliara']."%'
                                    OR makaleler.aciklama LIKE '%".$_GET['hizliara']."%'
                                    OR etiketler.isim LIKE '%".$_GET['hizliara']."%'
                                    OR yorumlar.yorum LIKE '%".$_GET['hizliara']."%'
                                    OR yorumlar.isim LIKE '%".$_GET['hizliara']."%'
                                    OR yorumlar.eposta LIKE '%".$_GET['hizliara']."%'
                                    OR yorumlar.web LIKE '%".$_GET['hizliara']."%'
                                )
                            GROUP BY makaleler.id
                        ";

                        $ssayi = max($_GET['ssayi'], 1);
                        $toplamkayit = $db->query($sql)->num_rows;
                        $toplamsayfa = ceil($toplamkayit / $satirsayi);

                        $rs = $db->query($sql." ORDER BY makaleler.tarih DESC LIMIT ".(($ssayi - 1) * $satirsayi).", ".$satirsayi);
                        while($makale = $rs->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $makale['id'];?></td>
                                <td class="text-muted xs-kapat"><?php echo date('d/m/Y', strtotime($makale['tarih']));?></td>
                                <td><a href="?sayfa=makale&id=<?php echo $makale['id'];?>" class="liste-uzun-metin" title="Düzenle"><?php echo $makale['baslik']?></a></td>
                                <td class="xs-kapat">
                                    <?php
                                        $etq = $db->query("SELECT etiketler.* FROM etiketler INNER JOIN etiketgruplari ON etiketgruplari.eid = etiketler.id AND etiketgruplari.mid = $makale[id] WHERE etiketler.menu GROUP BY etiketler.id ORDER BY etiketler.isim");
                                        while($etiket = $etq->fetch_assoc()) {
                                    ?>
                                            <i class="fa fa-circle" style="color: <?php echo $etiket['renk'];?>" data-toggle="tooltip" data-placement="top" title="<?php echo $etiket['isim'];?>"></i>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td class="text-right">
                                    <a href="?sayfa=makale&id=<?php echo $makale['id'];?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-danger makalesil" data-makale-id="<?php echo $makale['id'];?>" data-toggle="tooltip" data-placement="top" title="Sil"><i class="fa fa-trash-o"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-<?php echo $makale['aktif'] ? 'success' : 'default';?> aktifdegistir" data-makale-id="<?php echo $makale['id'];?>" data-toggle="tooltip" data-placement="top" title="Aktif/Pasif"><i class="fa fa-circle"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php   if($toplamsayfa > 1) {?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="pull-right">
                            <ul class="pagination">
                                <li class="<?php echo $ssayi == 1 ? 'disabled' : '';?>"><a href="?sayfa=makaleler&ssayi=<?php echo $ssayi - 1;?>">&laquo;</a></li>
                                <?php   for($i = 1; $i <= $toplamsayfa; $i++) {?>
                                            <li class="<?php echo $ssayi == $i ? 'active' : '';?>"><a href="?sayfa=makaleler&ssayi=<?php echo $i;?>"><?php echo $i;?></a></li>
                                <?php   }?>
                                <li class="<?php echo $ssayi == $toplamsayfa ? 'disabled' : '';?>"><a href="?sayfa=makaleler&ssayi=<?php echo $ssayi + 1;?>">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
    <?php
            }
    ?>
</div>
<script src="inc/js/app-makaleler.min.js"></script>