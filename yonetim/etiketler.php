<?php
    if(!$_SESSION['user']['duzey']) return;
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
                <li>
                    PHP
                    <span class="badge">12</span>
                    <input type="text" class="renksec" value="#f00" />
                    <a href="#" class="renkseclink" style="color: #f00;" data-toggle="tooltip" data-placement="top" title="Renk Seç">
                        <i class="fa fa-circle"></i>
                    </a>
                    <a href="#" class="kaldir text-danger" data-toggle="tooltip" data-placement="top" title="Menüden Kaldır">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </li>

                <li>
                    HTML5
                    <span class="badge">5</span>
                    <input type="text" class="renksec" value="#f00" />
                    <a href="#" class="renkseclink" style="color: #f00;" data-toggle="tooltip" data-placement="top" title="Renk Seç">
                        <i class="fa fa-circle"></i>
                    </a>
                    <a href="#" class="kaldir text-danger" data-toggle="tooltip" data-placement="top" title="Menüden Kaldır">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </li>

                <li>
                    CSS3
                    <span class="badge">9</span>
                    <input type="text" class="renksec" value="#f00" />
                    <a href="#" class="renkseclink" style="color: #f00;" data-toggle="tooltip" data-placement="top" title="Renk Seç">
                        <i class="fa fa-circle"></i>
                    </a>
                    <a href="#" class="kaldir text-danger" data-toggle="tooltip" data-placement="top" title="Menüden Kaldır">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h2>Diğer Etiketler</h2>
            <ul>
                <li>
                    JavaScript
                    <span class="badge">18</span>
                    <input type="text" class="renksec" value="#f00" />
                    <a href="#" class="renkseclink" style="color: #f00;" data-toggle="tooltip" data-placement="top" title="Renk Seç">
                        <i class="fa fa-circle"></i>
                    </a>
                    <a href="#" class="kaldir text-success" data-toggle="tooltip" data-placement="top" title="Menüye Ekle">
                        <i class="fa fa-anchor"></i>
                    </a>
                </li>

                <li>
                    SQL
                    <span class="badge">17</span>
                    <input type="text" class="renksec" value="#f00" />
                    <a href="#" class="renkseclink" style="color: #f00;" data-toggle="tooltip" data-placement="top" title="Renk Seç">
                        <i class="fa fa-circle"></i>
                    </a>
                    <a href="#" class="kaldir text-success" data-toggle="tooltip" data-placement="top" title="Menüye Ekle">
                        <i class="fa fa-anchor"></i>
                    </a>
                </li>

                <li>
                    Diğer
                    <span class="badge">3</span>
                    <input type="text" class="renksec" value="#f00" />
                    <a href="#" class="renkseclink" style="color: #f00;" data-toggle="tooltip" data-placement="top" title="Renk Seç">
                        <i class="fa fa-circle"></i>
                    </a>
                    <a href="#" class="kaldir text-success" data-toggle="tooltip" data-placement="top" title="Menüye Ekle">
                        <i class="fa fa-anchor"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>