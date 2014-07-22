<?php
    if(!$_SESSION['user']['id']) return;
    $makale = '';
    if($_GET['sayfa'] == 'makale') {
        $makale = "makaleler.id = $id AND";
    }
    $aktifssayi = max($_GET['aktifssayi'], 1); //Aktif Sayfa Sayi
    $pasifssayi = max($_GET['pasifssayi'], 1); //Pasif Sayfa Sayi
    
    $toplamaktifkayit = current($db->query("SELECT COUNT(*) FROM yorumlar INNER JOIN makaleler ON makaleler.id = yorumlar.mid AND makaleler.kullanici = ".$_SESSION['user']['id']." WHERE $makale yorumlar.aktif")->fetch_row());
    $toplampasifkayit = current($db->query("SELECT COUNT(*) FROM yorumlar INNER JOIN makaleler ON makaleler.id = yorumlar.mid AND makaleler.kullanici = ".$_SESSION['user']['id']." WHERE $makale NOT yorumlar.aktif")->fetch_row());

    $toplamaktifsayfa = ceil($toplamaktifkayit / $satirsayi);
    $toplampasifsayfa = ceil($toplampasifkayit / $satirsayi);

    $atab = ($_SESSION['atab'] != '' ? $_SESSION['atab'] : $_GET['atab']);
    $_SESSION['atab'] = '';
?>
<div <?php if($_GET['acilis']=='yorumlar') { echo 'id="acilis"'; }?> class="container yorumlar">
    <div class="row">
        <div class="col-xs-12">
            <?php   $baslik = ($_GET['sayfa'] == 'yorumlar' ? 'h1' : 'h3');?>
            <<?php echo $baslik?>>YORUMLAR</<?php echo $baslik?>>
        </div>
    </div>

    <div class="ayrac"></div>
    
    <div class="row">
        <div class="col-xs-12">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="<?php echo $atab ? '' : 'active';?>"><a href="#pasif" data-toggle="tab">Onaysız Yorumlar</a></li>
                <li class="<?php echo $atab ? 'active' : '';?>"><a href="#aktif" data-toggle="tab">Onaylı Yorumlar</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane <?php echo $atab ? '' : 'active';?>" id="pasif">
                    <?php tabyaz(false);?>
                </div>
                <div class="tab-pane <?php echo $atab ? 'active' : '';?>" id="aktif">
                    <?php tabyaz(true);?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="inc/js/app-yorumlar.min.js"></script>

<?php
    function tabyaz($aktif) {
        global $sb;
        global $db;
        global $satirsayi;
        global $aktifssayi;
        global $pasifssayi;
        global $toplamaktifkayit;
        global $toplampasifkayit;
        global $toplamaktifsayfa;
        global $toplampasifsayfa;
        global $makale;

        $ssayi = $pasifssayi;
        $toplamkayit = $toplampasifkayit;
        $toplamsayfa = $toplampasifsayfa;

        if($aktif) {
            $ssayi = $aktifssayi;
            $toplamkayit = $toplamaktifkayit;
            $toplamsayfa = $toplamaktifsayfa;
        }

        $sql = "SELECT yorumlar.* FROM yorumlar INNER JOIN makaleler ON makaleler.id = yorumlar.mid AND makaleler.kullanici = ".$_SESSION['user']['id']." WHERE $makale ".($aktif ? 'yorumlar.aktif' : 'NOT yorumlar.aktif')." ORDER BY yorumlar.tarih ".($aktif ? 'DESC' : '')." LIMIT ".(($aktifssayi - 1) * $satirsayi).", ".$satirsayi;
        $rs = $db->query($sql);
?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="xs-kapat">Tarih</th>
                    <th>Yorum</th>
                    <th class="xs-kapat">Yazar</th>
                    <th class="text-right"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = $rs->fetch_assoc()) {
                ?>
                        <tr>
                            <td class="text-muted xs-kapat"><?php echo date($sb['tarihsaatformat'], strtotime($row['tarih']));?></td>
                            <td><span class="liste-uzun-metin"><?php echo sql_filtre(htmlspecialchars($row['yorum']), TRUE);?></span></td>
                            <td class="xs-kapat"><?php echo sql_filtre(htmlspecialchars($row['isim']));?></td>
                            <td class="text-right">
                                <?php   if($_GET['sayfa'] == 'yorumlar') {?>
                                            <a href="?sayfa=makale&id=<?php echo $row['mid'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="İlgili Makaleyi Aç"><i class="fa fa-link"></i></a>
                                <?php   }?>
                                <a href="javascript:;" class="btn btn-xs btn-info yorumdetay" data-toggle="modal" data-target="#yorumdetay"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Tamamını Oku"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-danger yorumsil" data-toggle="tooltip" data-placement="top" title="Sil" data-yorum-id="<?php echo $row['id'];?>" data-tab="<?php echo $aktif ? 1 : 0;?>"><i class="fa fa-trash-o"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-<?php echo $aktif ? 'success' : 'default';?> aktifdegistir" data-toggle="tooltip" data-placement="top" title="Aktif/Pasif" data-yorum-id="<?php echo $row['id'];?>" data-tab="<?php echo $aktif ? 1 : 0;?>"><i class="fa fa-circle"></i></a>
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        
        <?php   if($toplamsayfa > 1) {?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-right">
                                <ul class="pagination">
                                    <li class="<?php echo $ssayi == 1 ? 'disabled' : '';?>"><a href="?sayfa=<?php echo $_GET['sayfa'];?>&id=<?php echo $_GET['id'];?>&atab=<?php echo $aktif ? 1 : 0;?>&aktifssayi=<?php echo $aktifssayi - ($aktif ?  1 : 0);?>&pasifssayi=<?php echo $pasifssayi - ($aktif ?  0 : 1);?>">&laquo;</a></li>
                                    <?php   for($i = 1; $i <= $toplamsayfa; $i++) {?>
                                                <li class="<?php echo $ssayi == $i ? 'active' : '';?>"><a href="?sayfa=<?php echo $_GET['sayfa'];?>&id=<?php echo $_GET['id'];?>&atab=<?php echo $aktif ? 1 : 0;?>&aktifssayi=<?php echo !$aktif ?  $aktifssayi : $i;?>&pasifssayi=<?php echo !$aktif ?  $i : $pasifssayi;?>"><?php echo $i;?></a></li>
                                    <?php   }?>
                                    <li class="<?php echo $ssayi == $toplamsayfa ? 'disabled' : '';?>"><a href="?sayfa=<?php echo $_GET['sayfa'];?>&id=<?php echo $_GET['id'];?>&atab=<?php echo $aktif ? 1 : 0;?>&aktifssayi=<?php echo $aktifssayi + ($aktif ?  1 : 0);?>&pasifssayi=<?php echo $pasifssayi + ($aktif ?  0 : 1);?>">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
<?php
                }
    }
?>