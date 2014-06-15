<?php if(!$_SESSION['user']['duzey']) return;?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1>KULLANICILAR</h1>
        </div>
    </div>

    <div class="ayrac"></div>
    
    <div class="row">
        <div class="col-xs-12">
            <a href="javascript:;" class="btn btn-xs btn-success kullanicikayit" data-toggle="modal" data-target="#kullanici" data-kullanici-id="0">Yeni Kullanıcı Oluştur</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kullanıcı Adı</th>
                        <th class="xs-kapat">E-Posta</th>
                        <th class="xs-kapat">Düzey</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $rs = $db->query("SELECT * FROM kullanicilar WHERE sid = $_SESSION[sid]");
                        while($row = $rs->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $row['id']?></td>
                                <td><a href="javascript:;" class="liste-uzun-metin kullanicikayit" data-toggle="modal" data-target="#kullanici" data-kullanici-id="<?php echo $row['id']?>" data-kullanici-isim="<?php echo $row['isim']?>" data-kullanici-eposta="<?php echo $row['eposta']?>" data-kullanici-duzey="<?php echo $row['duzey']?>" title="Düzenle"><?php echo $row['isim']?></a></td>
                                <td class="xs-kapat"><?php echo $row['eposta']?></td>
                                <td class="xs-kapat"><?php echo $row['duzey'] ? 'Yönetici' : 'Kullanıcı'?></td>
                                <td class="text-right">
                                    <a href="javascript:;" class="btn btn-xs btn-info kullanicikayit" data-kullanici-id="<?php echo $row['id']?>" data-kullanici-isim="<?php echo $row['isim']?>" data-kullanici-eposta="<?php echo $row['eposta']?>" data-kullanici-duzey="<?php echo $row['duzey']?>" data-toggle="modal" data-target="#kullanici"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Düzenle"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-danger kullanicisil" <?php if(current($db->query("SELECT COUNT(*) FROM makaleler WHERE kullanici = $row[id]")->fetch_row()) > 0) echo 'disabled';?> data-kullanici-id="<?php echo $row['id']?>" data-toggle="tooltip" data-placement="top" title="Sil"><i class="fa fa-trash-o"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-<?php echo $row['aktif'] ? 'success' : 'default'?> aktifdegistir" data-kullanici-id="<?php echo $row['id']?>" data-toggle="tooltip" data-placement="top" title="Aktif/Pasif"><i class="fa fa-circle"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="inc/js/app-kullanicilar.min.js"></script>