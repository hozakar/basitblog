<?php
    if(!$_SESSION['user']['duzey']) return;
?>
<div class="container ayarlar">
    <div class="row">
        <div class="col-xs-12">
            <h1>Site Ayarları</h1>
        </div>
    </div>

    <div class="ayrac"></div>

    <form class="form-horizontal" role="form" method="post">
        <input type="hidden" name="id" value="<?php $site->sbyaz('id');?>" />
        <div class="row">
            <h3 class="col-xs-12">Genel Bilgiler</h3>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2">İsim</label>
                    <div class="col-xs-12 col-sm-10">
                        <input class="form-control" name="isim" maxlength="255" placeholder="Site İsmi" value="<?php $site->sbyaz('isim');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Ana Dizin</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="anadizin" maxlength="255" placeholder="Ana Dizin" value="<?php $site->sbyaz('anadizin');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">URL</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="url" maxlength="255" placeholder="http://" value="<?php $site->sbyaz('url');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Foto</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="foto" maxlength="255" placeholder="Foto URL" value="<?php $site->sbyaz('foto');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Dil</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="dil" maxlength="5" placeholder="Dil (tr)" value="<?php $site->sbyaz('dil');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Karakter Set</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="charset" maxlength="255" placeholder="Karakter Set (utf-8)" value="<?php $site->sbyaz('charset');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Zaman Dilimi</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="zamandilimi" maxlength="255" placeholder="Zaman Dilimi (Asia/Istanbul" value="<?php $site->sbyaz('zamandilimi');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="ayrac"></div>

        <div class="row">
            <h3 class="col-xs-12">Ana Sayfa</h3>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Başlık</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="asbaslik" maxlength="255" placeholder="Ana Sayfa Başlığı" value="<?php $site->sbyaz('asbaslik');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Alt Başlık</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="asaltbaslik" maxlength="255" placeholder="Ana Sayfa Alt Başlık" value="<?php $site->sbyaz('asaltbaslik');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Kısa Metin</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="kisametin" placeholder="Kısa Metin Kelime Sayısı" value="<?php $site->sbyaz('kisametin');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Orta Metin</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="ortametin" placeholder="Orta Metin Kelime Sayısı" value="<?php $site->sbyaz('ortametin');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Uzun Metin</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="uzunmetin" placeholder="Uzun Metin Kelime Sayısı" value="<?php $site->sbyaz('uzunmetin');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Satır Sayısı</label>
                    <div class="col-xs-12 col-sm-8">
                        <select class="form-control" name="satirsayi">
                            <option <?php echo $sb['satirsayi'] == 5 ? 'selected' : ''?>>5</option>
                            <option <?php echo $sb['satirsayi'] == 10 ? 'selected' : ''?>>10</option>
                            <option <?php echo $sb['satirsayi'] == 15 ? 'selected' : ''?>>15</option>
                            <option <?php echo $sb['satirsayi'] == 20 ? 'selected' : ''?>>20</option>
                            <option <?php echo $sb['satirsayi'] == 25 ? 'selected' : ''?>>25</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="ayrac"></div>

        <div class="row">
            <h3 class="col-xs-12">SEO</h3>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Başlık</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="baslik" maxlength="255" placeholder="Site Başlığı" value="<?php $site->sbyaz('baslik');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Anahtar Kelimeler</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="keywords" maxlength="255" placeholder="Anahtar Kelimeler" value="<?php $site->sbyaz('keywords');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2">Açıklama</label>
                    <div class="col-xs-12 col-sm-10">
                        <input class="form-control" name="aciklama" maxlength="1000" placeholder="Site Açıklaması" value="<?php $site->sbyaz('aciklama');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Yazar</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="yazar" maxlength="255" placeholder="Yazar" value="<?php $site->sbyaz('yazar');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Yazar E-Posta</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" type="email" name="yazarposta" maxlength="255" placeholder="Yazar E-Posta" value="<?php $site->sbyaz('yazarposta');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="ayrac"></div>

        <div class="row">
            <h3 class="col-xs-12">Biçim</h3>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Tarih</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="tarihformat" maxlength="24" placeholder="d/m/Y" value="<?php $site->sbyaz('tarihformat');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Tarih Saat</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="tarihsaatformat" maxlength="24" placeholder="d/m/Y H:i" value="<?php $site->sbyaz('tarihsaatformat');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="ayrac"></div>

        <div class="row">
            <h3 class="col-xs-12">Posta</h3>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Adres</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="postaadres" maxlength="255" placeholder="Posta Adresi" value="<?php $site->sbyaz('postaadres');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Sunucu</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="postasunucu" maxlength="255" placeholder="Posta Sunucusu" value="<?php $site->sbyaz('postasunucu');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Kullanıcı</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="postakullanici" maxlength="255" placeholder="Posta Kullanıcı Adı" value="<?php $site->sbyaz('postakullanici');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Şifresi</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="postasifre" maxlength="255" placeholder="Posta Şifresi" value="<?php $site->sbyaz('postasifre');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Port</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" name="postaport" maxlength="255" placeholder="Posta Port" value="<?php $site->sbyaz('postaport');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Auth</label>
                    <div class="col-xs-12 col-sm-8">
                        <select class="form-control" name="postaauth">
                            <option value="1" <?php echo $sb['postaauth'] ? 'selected' : ''?>>Gerekli</option>
                            <option value="0" <?php echo $sb['postaauth'] ? '' : 'selected'?>>Gereksiz</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <div class="col-xs-12 text-right">
                        <button class="btn btn-success">GÜNCELLE</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
