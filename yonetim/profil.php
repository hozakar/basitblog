<?php   if(!$_SESSION['user']['id']) return;?>
<form class="container form-horizontal" role="form" method="post">
    <input type="hidden" name="id" value="<?php echo $_SESSION['user']['id']?>" />
    <div class="row">
        <div class="col-xs-12">
            <h1>
                PROFİL&nbsp;
                <small><?php echo $_SESSION['user']['isim']?></small>
            </h1>
        </div>
    </div>

    <div class="ayrac"></div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="col-xs-12 col-sm-4">İsim</label>
                <div class="col-xs-12 col-sm-8">
                    <input class="form-control" name="isim" placeholder="İsim" value="<?php echo $_SESSION['user']['isim']?>" />
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="col-xs-12 col-sm-4">Adres</label>
                <div class="col-xs-12 col-sm-8">
                    <input type="email" class="form-control" name="eposta" placeholder="E-Posta" value="<?php echo $_SESSION['user']['eposta']?>" />
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="col-xs-12 col-sm-4">Şifre</label>
                <div class="col-xs-12 col-sm-8">
                    <input class="form-control" name="sifre" placeholder="Şifre" value="" />
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