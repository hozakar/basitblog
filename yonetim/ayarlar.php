<?php
    if(!$_SESSION['user']['id']) return;
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
            <div class="col-xs-12">
                <div class="form-group text-right">
                    <label class="col-xs-12">
                        Site Aktif
                        &nbsp;
                        <input type="checkbox" name="aktif" value="1" <?php echo $sb['aktif'] ? 'checked' : '';?> />
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <h3 class="col-xs-12">Genel Bilgiler</h3>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2">İsim</label>
                    <div class="col-xs-12 col-sm-10">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Site İsmi" name="isim" maxlength="255" placeholder="Site İsmi" value="<?php $site->sbyaz('isim');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Ana Dizin</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Site Ana Dizini" name="anadizin" maxlength="255" placeholder="Ana Dizin" value="<?php $site->sbyaz('anadizin');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">URL</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="url" class="form-control" data-toggle="tooltip" data-placement="left" title="Sitenin Internet Adresi" name="url" maxlength="255" placeholder="http://" value="<?php $site->sbyaz('url');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Foto</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Varsayılan İmaj" name="foto" maxlength="255" placeholder="Foto URL" value="<?php $site->sbyaz('foto');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Dil</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Site Dili" name="dil" maxlength="5" placeholder="Dil (tr)" value="<?php $site->sbyaz('dil');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Karakter Set</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Sitede Kullanılacak Karakter Seti (Emin değilseniz &quot;utf-8&quot; tercih ediniz)" name="charset" maxlength="255" placeholder="Karakter Set (utf-8)" value="<?php $site->sbyaz('charset');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Zaman Dilimi</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Zaman Dilimi (Emin değilseniz &quot;Asia/Istanbul&quot; kullanınız)" name="zamandilimi" maxlength="255" placeholder="Zaman Dilimi (Asia/Istanbul)" value="<?php $site->sbyaz('zamandilimi');?>" />
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
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Ana Sayfada Kullanılacak Başlık" name="asbaslik" maxlength="255" placeholder="Ana Sayfa Başlığı" value="<?php $site->sbyaz('asbaslik');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Alt Başlık</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Ana Sayfada Kullanılacak Alt Başlık" name="asaltbaslik" maxlength="255" placeholder="Ana Sayfa Alt Başlık" value="<?php $site->sbyaz('asaltbaslik');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Kısa Metin</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Kısa Metinler İçin Kelime Sayısı" name="kisametin" placeholder="Kısa Metin Kelime Sayısı" value="<?php $site->sbyaz('kisametin');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Orta Metin</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Orta Metinler İçin Kelime Sayısı" name="ortametin" placeholder="Orta Metin Kelime Sayısı" value="<?php $site->sbyaz('ortametin');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Uzun Metin</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Uzun Metinler İçin Kelime Sayısı" name="uzunmetin" placeholder="Uzun Metin Kelime Sayısı" value="<?php $site->sbyaz('uzunmetin');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Satır Sayısı</label>
                    <div class="col-xs-12 col-sm-8">
                        <select class="form-control" name="satirsayi" data-toggle="tooltip" data-placement="left" title="Ana Sayfada Listelenecek Makale Sayısı">
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
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Başlık (title) Bilgisi" name="baslik" maxlength="255" placeholder="Site Başlığı" value="<?php $site->sbyaz('baslik');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Anahtar Kelimeler</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Ana Sayfada Kullanılacak Anahtar Kelimeler (keywords). Virgül ile ayırarak Yazınız." name="keywords" maxlength="255" placeholder="Anahtar Kelimeler" value="<?php $site->sbyaz('keywords');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2">Açıklama</label>
                    <div class="col-xs-12 col-sm-10">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Site Açıklaması (description)" name="aciklama" maxlength="1000" placeholder="Site Açıklaması" value="<?php $site->sbyaz('aciklama');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Yazar</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Yazar İsmi (author)" name="yazar" maxlength="255" placeholder="Yazar" value="<?php $site->sbyaz('yazar');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Yazar E-Posta</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" type="email" data-toggle="tooltip" data-placement="left" title="Yazar E-Posta Adresi" name="yazarposta" maxlength="255" placeholder="Yazar E-Posta" value="<?php $site->sbyaz('yazarposta');?>" />
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
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Sitede Kullanılacak Tarih Biçimi (d/m/Y = Gün/Ay/Yıl)" name="tarihformat" maxlength="24" placeholder="d/m/Y" value="<?php $site->sbyaz('tarihformat');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Tarih Saat</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Sitede Kullanılacak Tarih - Saat Biçimi (d/m/Y H:i = Gün/Ay/Yıl Saat:Dakika)" name="tarihsaatformat" maxlength="24" placeholder="d/m/Y H:i" value="<?php $site->sbyaz('tarihsaatformat');?>" />
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
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="Sitede Kullanılacak E-Posta Adresi" name="postaadres" maxlength="255" placeholder="Posta Adresi" value="<?php $site->sbyaz('postaadres');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Sunucu</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="E-Posta Sunucusu" title="E-Posta Sunucusu" name="postasunucu" maxlength="255" placeholder="Posta Sunucusu" value="<?php $site->sbyaz('postasunucu');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Kullanıcı</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="E-Posta Kullanıcı Adı" name="postakullanici" maxlength="255" placeholder="Posta Kullanıcı Adı" value="<?php $site->sbyaz('postakullanici');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Şifresi</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="E-Posta Şifresi" name="postasifre" maxlength="255" placeholder="Posta Şifresi" value="<?php $site->sbyaz('postasifre');?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Port</label>
                    <div class="col-xs-12 col-sm-8">
                        <input class="form-control" data-toggle="tooltip" data-placement="left" title="E-Posta Portu" name="postaport" maxlength="255" placeholder="Posta Port" value="<?php $site->sbyaz('postaport');?>" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4">Auth</label>
                    <div class="col-xs-12 col-sm-8">
                        <select class="form-control" name="postaauth" data-toggle="tooltip" data-placement="left" title="E-Posta Gönderimi İçin Doğrulama (Kullanıcı Adı - Şifre) Gerekiyor mu?">
                            <option value="1" <?php echo $sb['postaauth'] ? 'selected' : ''?>>Gerekli</option>
                            <option value="0" <?php echo $sb['postaauth'] ? '' : 'selected'?>>Gereksiz</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="ayrac"></div>

        <div class="row">
            <h3 class="col-xs-12">Analytics</h3>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2">Analytics Kodu</label>
                    <div class="col-xs-12 col-sm-10">
                        <textarea class="form-control" data-toggle="tooltip" data-placement="left" title="Analiz sisteminin verdiği kod bloğu" name="g_analytics" placeholder="Analytics Kodu"><?php $site->sbyaz('g_analytics');?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <div class="col-xs-12">
                        <select id="sosyal_sablon" class="hidden">
                            <?php   ikonliste();?>
                        </select>

                        <h3>Bağlantılar</h3>
                        <button type="button" class="btn btn-xs btn-info sosyalekle">YENİ EKLE</button>
                        <ul class="baglantilar">
                            <?php
                                $sq = $db->query("SELECT * FROM sosyal WHERE sid = $_SESSION[sid] ORDER BY sira");
                                while($srs = $sq->fetch_assoc()) {
                            ?>
                                    <li>
                                        <span class="ikon">
                                            <select name="sosyal_<?php echo $srs['id'];?>" class="form-control">
                                                <?php   ikonliste($srs['ikon']);?>
                                            </select>
                                        </span>
                                        <span class="adres">
                                            <input type="text" class="form-control" name="sadres_<?php echo $srs['id'];?>" placeholder="http://" value="<?php echo $srs['url']?>" />
                                        </span>
                                        <span class="renk">
                                            <label class="md-kapat">İkon Rengi</label><input type="text" class="renksec" name="renk_<?php echo $srs['id'];?>" value="<?php echo $srs['renk'];?>" />
                                            <a href="javascript:;" class="renkseclink" style="color: <?php echo $srs['renk'];?>;" data-toggle="tooltip" data-placement="top" title="İkon Rengi">
                                                <i class="fa fa-circle"></i>
                                            </a>
                                        </span>
                                        <span class="renk">
                                            <label class="md-kapat">Alt. Renk</label><input type="text" class="renksec" name="hoverrenk_<?php echo $srs['id'];?>" value="<?php echo $srs['hoverrenk'];?>" />
                                            <a href="javascript:;" class="renkseclink" style="color: <?php echo $srs['hoverrenk'];?>;" data-toggle="tooltip" data-placement="top" title="Arka Plan Rengi">
                                                <i class="fa fa-circle"></i>
                                            </a>
                                        </span>
                                        <span class="buton">
                                            <button type="button" class="btn btn-xs btn-danger sosyalsil"><i class="fa fa-trash-o"></i></button>
                                        </span>
                                        <input type="hidden" name="sira_<?php echo $srs['id'];?>" class="siralama" value="<?php echo $srs['sira'];?>" />
                                        <input type="hidden" name="sil_<?php echo $srs['id'];?>" class="sil" value="0" />
                                    </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <div class="col-xs-12 text-right">
                        <button type="submit" class="btn btn-success">GÜNCELLE</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
<script src="inc/js/app-ayarlar.min.js"></script>
<?php
    function ikonliste($secim) {
        $xml=simplexml_load_file("ikonsablon.xml");
        foreach($xml->ikon as $ikon) {
            echo '<option value="'.$ikon->isim.'||'.$ikon->sablon.'" '.($secim == $ikon->isim ? 'selected' : '').'>'.$ikon->sablon.'</option>';
        }
    }
?>