<?php
    if(!$_SESSION['user']['id']) return;
    switch ($_GET['sayfa']) {
        case 'makaleler':?>
            <!-- Filtre Modal -->
            <div class="modal fade" id="filtre" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content form-horizontal" role="form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="modalLabel">Filtreleme Seçenekleri</h4>
                        </div>
                        <div class="modal-body">
                                <input type="hidden" name="sayfa" value="makaleler" />
                                <div class="row form-group">
                                    <div class="col-xs-12">
                                        <label class="control-label col-xs-3">İsim</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" name="isim" value="<?php echo $_GET['isim'];?>" placeholder="İsim" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-xs-12">
                                        <label class="control-label col-xs-3">Etiket</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" name="etiket" value="<?php echo $_GET['etiket'];?>" placeholder="Etiket" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-xs-12">
                                        <label class="control-label col-xs-3">Durum</label>
                                        <div class="col-xs-9">
                                            <select class="form-control" name="durum">
                                                <option value="" <?php echo $_GET['durum'] == '' ? 'selected' : '';?>>Tümü</option>
                                                <option value="1" <?php echo $_GET['durum'] == '1' ? 'selected' : '';?>>Aktif Makaleler</option>
                                                <option value="0" <?php echo $_GET['durum'] == '0' ? 'selected' : '';?>>Pasif Makaleler</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                            <button type="submit" class="btn btn-primary">Uygula</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Son: Filtre Modal -->

<?php
            break;
        case 'makale':
        case 'yorumlar':?>
            <!-- Yorum Modal -->
            <div class="modal fade" id="yorumdetay" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="modalLabel">Yorum Detayı</h4>
                        </div>
                        <div class="modal-body">
                            Lorem ipsum dolor sit amet...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Son: Yorum Modal -->
<?php
            break;
        case 'kullanicilar':?>
            <!-- Kullanıcı Modal -->
            <div class="modal fade" id="kullanici" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content form-horizontal" role="form" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="modalLabel">Kullanıcı Güncelle</h4>
                        </div>
                        <div class="modal-body">
                                <input type="hidden" name="id" value="" />
                                <input type="hidden" name="islem" value="duzenle" />
                                <div class="row form-group">
                                    <div class="col-xs-12">
                                        <label class="control-label col-xs-3">İsim</label>
                                        <div class="col-xs-9">
                                            <input type="text" name="isim" class="form-control" placeholder="İsim" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-xs-12">
                                        <label class="control-label col-xs-3">E-Posta</label>
                                        <div class="col-xs-9">
                                            <input type="email" name="eposta" class="form-control" placeholder="E-Posta" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-xs-12">
                                        <label class="control-label col-xs-3">Şifre</label>
                                        <div class="col-xs-9">
                                            <input type="text" name="sifre" class="form-control" placeholder="Şifre" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-xs-12">
                                        <label class="control-label col-xs-3">Düzey</label>
                                        <div class="col-xs-9">
                                            <select class="form-control" name="duzey">
                                                <option value="0">Kullanıcı</option>
                                                <option value="1">Yönetici</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                            <button type="submit" class="btn btn-primary">Uygula</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Son: Kullanıcı Modal -->
<?php
            break;
    }
?>