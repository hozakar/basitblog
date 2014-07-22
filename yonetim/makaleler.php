<?php   if(!$_SESSION['user']['id']) return;?>
<div class="container makaleler">
    <div class="row">
        <div class="col-xs-12">
            <h1>MAKALELER</h1>
        </div>
    </div>

    <div class="ayrac"></div>
    
    <div class="row">
        <div class="col-xs-12">
            <a href="?sayfa=makale&id=0" class="btn btn-xs btn-success">Yeni Makale Oluştur</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="xs-kapat">#</th>
                        <th class="xs-kapat">Tarih</th>
                        <th>Makale Adı</th>
                        <th class="xs-kapat">Etiketler</th>
                        <th class="text-right">
                            <a href="#" class="btn btn-xs btn-info" data-toggle="modal" data-target="#filtre">Filtrele</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $eksql = $_GET['isim'] ? " AND makaleler.baslik LIKE '%".$_GET['isim']."%'" : "";
                        $eksql .= $_GET['etiket'] ? " AND etiketler.isim LIKE '".$_GET['etiket']."%'" : "";
                        $eksql .= $_GET['durum'] ? " AND makaleler.aktif" : ($_GET['durum'] == '0' ? " AND NOT makaleler.aktif" : "");

                        $ssayi = max($_GET['ssayi'], 1);
                        $toplamkayit = $db->query("SELECT makaleler.* FROM makaleler LEFT JOIN etiketgruplari ON etiketgruplari.mid = makaleler.id LEFT JOIN etiketler ON etiketler.id = etiketgruplari.eid WHERE makaleler.kullanici = ".$_SESSION['user']['id'].$eksql." GROUP BY makaleler.id")->num_rows;
                        $toplamsayfa = ceil($toplamkayit / $satirsayi);

                        $rs = $db->query("SELECT makaleler.* FROM makaleler LEFT JOIN etiketgruplari ON etiketgruplari.mid = makaleler.id LEFT JOIN etiketler ON etiketler.id = etiketgruplari.eid WHERE makaleler.kullanici = ".$_SESSION['user']['id'].$eksql." GROUP BY makaleler.id ORDER BY makaleler.tarih DESC LIMIT ".(($ssayi - 1) * $satirsayi).", ".$satirsayi);
                        while($makale = $rs->fetch_assoc()) {
                    ?>
                            <tr>
                                <td class="xs-kapat"><?php echo $makale['id'];?></td>
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
                                    <a href="<?php echo $sb['anadizin'].$makale['url'];?>.html" target="_blank" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Görüntüle"><i class="fa fa-eye"></i></a>
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