<form class="container makale form-horizontal" role="form" method="post">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                MAKALE<br>
                <small>
                    Hakan Özakar
                </small>
            </h1>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-xs-12 text-right">
            <label class="text-muted">
                Aktif&nbsp;
                <input type="checkbox" />
            </label>
        </div>
    </div>

    <div class="row form-group">
        <label class="baslik col-xs-12 col-sm-3 col-md-2 col-sm-offset-6">Şablon</label>
        <div class="col-xs-12 col-sm-3 col-md-4">
            <select class="form-control">
                <?php
                $sablon = dir("sablon/");
                while (false !== ($dosya = $sablon->read())) {
                    if(substr($dosya, -5)=='.html') echo '<option value="'.$dosya.'" '.($dosya == 'makale.html' ? 'selected' : '').'>'.$dosya.'</option>';
                }
                $sablon->close();
                ?>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <label class="baslik col-xs-12 col-sm-3 col-md-2">Başlık</label>
        <div class="col-xs-12 col-sm-9 col-md-10">
            <input type="text" class="form-control" placeholder="Başlık" maxlength="255" />
        </div>
    </div>

    <div class="row form-group">
        <label class="baslik col-xs-12 col-sm-3 col-md-2">Alt Başlık</label>
        <div class="col-xs-12 col-sm-9 col-md-10">
            <input type="text" class="form-control" placeholder="Alt Başlık" maxlength="255" />
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="row form-group">
                <label class="baslik col-xs-12 col-sm-6 col-md-4">Tarih</label>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control tarih" data-date-format="yyyy-mm-dd" readonly placeholder="Tarih" maxlength="10" />
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
                    <select class="form-control">
                        <option value="0">Normal</option>
                        <option value="1">Her Zaman Üstte</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-xs-12">
            <textarea name="icerik" class="icerik">
                <h2>
                    BAŞLIK
                </h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
            </textarea>
        </div>
    </div>

    <div class="row form-group">
        <label class="baslik col-xs-12 col-sm-3 col-md-2">Açıklama</label>
        <div class="col-xs-12 col-sm-9 col-md-10">
            <input type="text" class="form-control" placeholder="Açıklama" maxlength="1000" />
        </div>
    </div>

    <div class="row form-group">
        <label class="baslik col-xs-12 col-sm-3 col-md-2">Etiketler</label>
        <div class="col-xs-12 col-sm-9 col-md-10">
            <input type="hidden" class="form-control select2-etiket" value="PHP,Hakan" data-liste="PHP,HTML5,CSS3,JavaScript,Hakan,Özakar" />
        </div>
    </div>

    <div class="row form-group">
        <div class="col-xs-12 text-right">
            <button class="btn btn-success">KAYDET</button>
        </div>
    </div>
</form>

<div class="container makale">
    <div class="row form-group">
        <div class="col-xs-12">
            <h3>Fotoğraflar</h3>

            <form id="fileupload" action="" method="POST" enctype="multipart/form-data" data-ng-app="demo" data-ng-controller="DemoFileUploadController" data-file-upload="options" data-ng-class="{'fileupload-processing': processing() || loadingFiles}">
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-7">
                        <span class="btn btn-success fileinput-button" ng-class="{disabled: disabled}">
                            <i class="fa fa-plus"></i>
                            <span>Dosya Seç...</span>
                            <input type="file" name="files[]" multiple ng-disabled="disabled">
                        </span>
                        <button type="button" class="btn btn-primary start" data-ng-click="submit()">
                            <i class="fa fa-upload"></i>
                            <span>Yükle</span>
                        </button>
                        <button type="button" class="btn btn-warning cancel" data-ng-click="cancel()">
                            <i class="fa fa-times-circle"></i>
                            <span>İptal</span>
                        </button>
                        <span class="fileupload-process"></span>
                    </div>
                    <div class="col-lg-5 fade" data-ng-class="{in: active()}">
                        <div class="progress progress-striped active" data-file-upload-progress="progress()"><div class="progress-bar progress-bar-success" data-ng-style="{width: num + '%'}"></div></div>
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>
                <table class="table table-striped files ng-cloak">
                    <tr data-ng-repeat="file in queue" data-ng-class="{'processing': file.$processing()}">
                        <td data-ng-switch data-on="!!file.thumbnailUrl">
                            <div class="preview" data-ng-switch-when="true">
                                <a data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery><img data-ng-src="{{file.thumbnailUrl}}" alt=""></a>
                            </div>
                            <div class="preview" data-ng-switch-default data-file-upload-preview="file"></div>
                        </td>
                        <td>
                            <p class="name" data-ng-switch data-on="!!file.url">
                                <span data-ng-switch-when="true" data-ng-switch data-on="!!file.thumbnailUrl">
                                    <a data-ng-switch-when="true" data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery>{{file.name}}</a>
                                    <a data-ng-switch-default data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}">{{file.name}}</a>
                                </span>
                                <span data-ng-switch-default>{{file.name}}</span>
                            </p>
                            <strong data-ng-show="file.error" class="error text-danger">{{file.error}}</strong>
                        </td>
                        <td>
                            <p class="size">{{file.size | formatFileSize}}</p>
                            <div class="progress progress-striped active fade" data-ng-class="{pending: 'in'}[file.$state()]" data-file-upload-progress="file.$progress()"><div class="progress-bar progress-bar-success" data-ng-style="{width: num + '%'}"></div></div>
                        </td>
                        <td>
                            <!--
                            <button type="button" class="btn btn-primary start" data-ng-click="file.$submit()" data-ng-hide="!file.$submit || options.autoUpload" data-ng-disabled="file.$state() == 'pending' || file.$state() == 'rejected'">
                                <i class="fa fa-upload"></i>
                                <span>Yükle</span>
                            </button>
                            -->
                            <button type="button" class="btn btn-warning cancel" data-ng-click="file.$cancel()" data-ng-hide="!file.$cancel">
                                <i class="fa fa-times-circle"></i>
                                <span>İptal</span>
                            </button>
                            <!--
                            <button data-ng-controller="FileDestroyController" type="button" class="btn btn-danger destroy" data-ng-click="file.$destroy()" data-ng-hide="!file.$destroy">
                                <i class="fa fa-trash"></i>
                                <span>Sil</span>
                            </button>
                            -->
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
</div>

<div class="container makale foto">
    <div class="row form-group">
        <div class="col-xs-12">
            <ul class="sirala">
                <li>
                    <div class="makalefoto" data-fix-img="/upload/foto/minik/1.png">
                        <div class="cover">
                            <a href="#">
                                <i class="fa fa-2x fa-trash-o"></i>
                            </a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="makalefoto" data-fix-img="/upload/foto/minik/2.png">
                        <div class="cover">
                            <a href="#">
                                <i class="fa fa-2x fa-trash-o"></i>
                            </a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="makalefoto" data-fix-img="/upload/foto/minik/3.png">
                        <div class="cover">
                            <a href="#">
                                <i class="fa fa-2x fa-trash-o"></i>
                            </a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="makalefoto" data-fix-img="/upload/foto/minik/4.png">
                        <div class="cover">
                            <a href="#">
                                <i class="fa fa-2x fa-trash-o"></i>
                            </a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="makalefoto" data-fix-img="/upload/foto/minik/5.png">
                        <div class="cover">
                            <a href="#">
                                <i class="fa fa-2x fa-trash-o"></i>
                            </a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="makalefoto" data-fix-img="/upload/foto/minik/6.png">
                        <div class="cover">
                            <a href="#">
                                <i class="fa fa-2x fa-trash-o"></i>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php   include('yorumlar.php');?>
