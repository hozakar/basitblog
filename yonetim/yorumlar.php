<div class="container yorumlar">
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
                <li class="active"><a href="#pasif" data-toggle="tab">Onaysız Yorumlar</a></li>
                <li><a href="#aktif" data-toggle="tab">Onaylı Yorumlar</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="pasif">

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
                            <tr>
                                <td class="text-muted xs-kapat">14/06/2014 13:35</td>
                                <td><a href="#" class="liste-uzun-metin" title="Düzenle">İyi ama bir tren bunu yapabilir mi?</a></td>
                                <td class="xs-kapat">Hakan Özakar</td>
                                <td class="text-right">
                                    <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil"><i class="fa fa-trash-o"></i></a>
                                    <a href="#" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Aktif/Pasif"><i class="fa fa-circle"></i></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-right">
                                <ul class="pagination">
                                    <li class="disabled"><a href="#">&laquo;</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="aktif">

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
                            <tr>
                                <td class="text-muted xs-kapat">14/06/2014 13:35</td>
                                <td><a href="#" class="liste-uzun-metin" title="Düzenle">İyi ama bir tren bunu yapabilir mi?</a></td>
                                <td class="xs-kapat">Hakan Özakar</td>
                                <td class="text-right">
                                    <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil"><i class="fa fa-trash-o"></i></a>
                                    <a href="#" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Aktif/Pasif"><i class="fa fa-circle"></i></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-right">
                                <ul class="pagination">
                                    <li class="disabled"><a href="#">&laquo;</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>