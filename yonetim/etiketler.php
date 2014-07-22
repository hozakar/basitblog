<?php
    if(!$_SESSION['user']['id']) return;
?>
<div class="container etiketler">
    <div class="row">
        <div class="col-xs-12">
            <h1>Etiketler</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h2>Menu Başlıkları</h2>
            <ul>
                <?php
                    $rs = $db->query("SELECT * FROM etiketler WHERE sid = $sb[id] AND menu ORDER BY isim");
                    while($etiket = $rs->fetch_assoc()) {
                ?>
                        <li>
                            <?php echo $etiket['isim'];?>
                            <span class="badge"><?php echo current($db->query("SELECT COUNT(*) FROM etiketgruplari WHERE eid = $etiket[id]")->fetch_row());?></span>
                            <?php   if($_SESSION['user']['duzey']) {?>
                                        <input type="text" class="renksec" data-id="<?php echo $etiket['id'];?>" value="<?php echo $etiket['renk'];?>" />
                                        <a href="javascript:;" class="renkseclink" style="color: <?php echo $etiket['renk'];?>;" data-toggle="tooltip" data-placement="top" title="Renk Seç">
                                            <i class="fa fa-circle"></i>
                                        </a>
                                        <a href="javascript:;" class="kaldir text-warning" data-id="<?php echo $etiket['id'];?>" data-toggle="tooltip" data-placement="top" title="Menüden Kaldır">
                                            <i class="fa fa-thumbs-o-down"></i>
                                        </a>
                            <?php   } else {?>
                                        <a class="renkseclink" style="color: <?php echo $etiket['renk'];?>;">
                                            <i class="fa fa-circle"></i>
                                        </a>
                            <?php   }?>
                        </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h2>Diğer Etiketler</h2>
            <ul>
                <?php
                    $rs = $db->query("SELECT * FROM etiketler WHERE sid = $sb[id] AND NOT menu ORDER BY isim");
                    while($etiket = $rs->fetch_assoc()) {
                ?>
                        <li>
                            <?php echo $etiket['isim'];?>
                            <span class="badge"><?php echo current($db->query("SELECT COUNT(*) FROM etiketgruplari WHERE eid = $etiket[id]")->fetch_row());?></span>
                            <?php   if($_SESSION['user']['duzey']) {?>
                                        <input type="text" class="renksec" data-id="<?php echo $etiket['id'];?>" value="<?php echo $etiket['renk'];?>" />
                                        <a href="javascript:;" class="renkseclink" style="color: <?php echo $etiket['renk'];?>;" data-toggle="tooltip" data-placement="top" title="Renk Seç">
                                            <i class="fa fa-circle"></i>
                                        </a>
                                        <a href="javascript:;" class="kaldir text-success" data-id="<?php echo $etiket['id'];?>" data-toggle="tooltip" data-placement="top" title="Menüye Ekle">
                                            <i class="fa fa-thumbs-o-up"></i>
                                        </a>
                                        <a href="javascript:;" class="sil text-danger" data-id="<?php echo $etiket['id'];?>" data-toggle="tooltip" data-placement="top" title="Sil">
                                            <i class="fa fa-times-circle"></i>
                                        </a>
                            <?php   } else {?>
                                        <a class="renkseclink" style="color: <?php echo $etiket['renk'];?>;">
                                            <i class="fa fa-circle"></i>
                                        </a>
                            <?php   }?>
                        </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
<script src="inc/js/app-etiketler.min.js"></script>