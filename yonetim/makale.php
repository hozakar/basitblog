<?php
    if(!$_SESSION['user']['id']) return;
    $id = max(0, $_GET['id']);
    $makale = $db->query("SELECT * FROM makaleler WHERE kullanici = ".$_SESSION['user']['id']." AND id = ".$id)->fetch_assoc();
?>
<form class="container makale form-horizontal" role="form" method="post">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                MAKALE<br>
                <small>
                    <?php echo $_SESSION['user']['isim'];?>
                </small>
            </h1>
            <input type="hidden" name="id" value="<?php echo $id;?>" data-ana-dizin="<?php echo $sb['anadizin'];?>" />
            <input type="hidden" name="islem" value="degistir" />
        </div>
    </div>

    <div class="row form-group">
        <div class="col-xs-12 text-right">
            <label class="text-muted">
                Aktif&nbsp;
                <input type="checkbox" name="aktif" value="1" <?php echo $makale['aktif'] ? 'checked' : '';?> />
            </label>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="row form-group">
                <label class="baslik col-xs-12 col-sm-6 col-md-4">Akış</label>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <select class="form-control" name="akis">
                        <option value="1" <?php echo $makale['akis'] ? 'selected' : ''?>>Gösterilsin</option>
                        <option value="0" <?php echo !$makale['akis'] && $id > 0 ? 'selected' : ''?>>Gösterilmesin</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6">
            <div class="row form-group">
                <label class="baslik col-xs-12 col-sm-6 col-md-4">Şablon</label>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <select class="form-control" name="sablon">
                        <?php
                        $sablon = dir("sablon/");
                        while (false !== ($dosya = $sablon->read())) {
                            if(substr($dosya, -5)=='.html' && substr($dosya, 0, 5) != 'index') echo '<option value="'.$dosya.'" '.($dosya == $makale['sablon'] || ($id == 0 && $dosya == 'makale.html') ? 'selected' : '').'>'.$dosya.'</option>';
                        }
                        $sablon->close();
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <label class="baslik col-xs-12 col-sm-3 col-md-2">Başlık</label>
        <div class="col-xs-12 col-sm-9 col-md-10">
            <input type="text" class="form-control" name="baslik" placeholder="Başlık" maxlength="255" value="<?php echo htmlspecialchars($makale['baslik'])?>" />
        </div>
    </div>

    <div class="row form-group">
        <label class="baslik col-xs-12 col-sm-3 col-md-2">Alt Başlık</label>
        <div class="col-xs-12 col-sm-9 col-md-10">
            <input type="text" class="form-control" name="altbaslik" placeholder="Alt Başlık" maxlength="255" value="<?php echo htmlspecialchars($makale['altbaslik'])?>" />
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="row form-group">
                <label class="baslik col-xs-12 col-sm-6 col-md-4">Tarih</label>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control tarih" name="tarih" value="<?php echo ($id > 0 ? date('Y-m-d', strtotime($makale['tarih'])) : date('Y-m-d'));?>" data-date-format="yyyy-mm-dd" readonly placeholder="Tarih" maxlength="10" />
                        <span class="input-group-addon tarih">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6">
            <div class="row form-group">
                <label class="baslik col-xs-12 col-sm-6 col-md-4">Sıralama</label>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <select class="form-control" name="yapiskan">
                        <option value="0" <?php echo $makale['yapiskan'] ? '' : 'selected'?>>Normal</option>
                        <option value="1" <?php echo $makale['yapiskan'] ? 'selected' : ''?>>Her Zaman Üstte</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-xs-12">
            <textarea name="icerik" class="icerik" name="icerik"><?php echo htmlspecialchars($makale['icerik']);?></textarea>
        </div>
    </div>

    <div class="row form-group">
        <label class="baslik col-xs-12 col-sm-3 col-md-2">Açıklama</label>
        <div class="col-xs-12 col-sm-9 col-md-10">
            <input type="text" class="form-control" name="aciklama" value="<?php echo htmlspecialchars($makale['aciklama']);?>" placeholder="Açıklama" maxlength="1000" />
        </div>
    </div>

    <div class="row form-group">
        <label class="baslik col-xs-12 col-sm-3 col-md-2">Etiketler</label>
        <div class="col-xs-12 col-sm-9 col-md-10">
            <?php
                $etq = $db->query("SELECT etiketler.isim FROM etiketler INNER JOIN etiketgruplari ON etiketgruplari.eid = etiketler.id AND etiketgruplari.mid = $id ORDER BY etiketler.isim");
                $etqDummy = array();
                while($etiket = current($etq->fetch_row())) array_push($etqDummy, $etiket);
                $etqDummy = implode(',', $etqDummy);

                $etq = $db->query("SELECT isim FROM etiketler WHERE sid = $_SESSION[sid] ORDER BY isim");
                $etqTam = array();
                while($etiket = current($etq->fetch_row())) array_push($etqTam, $etiket);
                $etqTam = implode(',', $etqTam);
            ?>
            <input type="hidden" class="form-control select2-etiket" name="etiket" value="<?php echo $etqDummy;?>" data-liste="<?php echo $etqTam;?>" />
        </div>
    </div>

    <div class="row form-group">
        <div class="col-xs-12 text-right">
            <?php if($id) {?><a href="<?php echo $sb['anadizin'].$makale['url'];?>.html" target="_blank" class="btn btn-info">GÖRÜNTÜLE</a>&nbsp;<?php }?>
            <button id="makalekaydet" class="btn btn-success">KAYDET</button>
        </div>
    </div>
</form>
<?php
    if($id > 0) {
?>
        <div class="container makale">
            <div class="row form-group">
                <div class="col-xs-12">
                    <h3>Fotoğraflar</h3>
                    
                    <span class="btn btn-success fileinput-button">
                        <i class="fa fa-plus"></i>
                        <span>Resim Yükle</span>
                        <input id="fileupload" type="file" name="files[]" multiple>
                    </span>
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>

                </div>
            </div>
        </div>

        <div <?php if($_GET['acilis']=='fotolar') { echo 'id="acilis"'; }?> class="container makale foto">
            <div class="row form-group">
                <div class="col-xs-12">
                    <ul class="sirala">
                        <?php
                            $ftq = $db->query("SELECT id, CONCAT(id, uzanti) as isim FROM foto WHERE mid = $makale[id] ORDER BY sira");
                            while($ftrs = $ftq->fetch_assoc()) {
                        ?>
                                <li data-id="<?php echo $ftrs['id']?>">
                                    <div class="makalefoto" data-fix-img="<?php $site->sbyaz('anadizin')?>upload/foto/minik/<?php echo $ftrs['isim']?>">
                                        <div class="cover">
                                            <a href="javascript:;">
                                                <i class="fa fa-2x fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <script src="inc/js/app-makale.min.js"></script>

        <?php   include('yorumlar.php');?>
<?php
    }
?>
