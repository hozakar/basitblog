<?php

/*
**  Image Browser 1.0.0
**  Plugin for TinyMCE
**  https://github.com/hozakar/imagebrowser-for-tinymce
**
**  Copyright 2014, Hakan Özakar
**  http://beltslib.net
**
**  Licensed under CC0 1.0 Universal Licence:
**  https://creativecommons.org/publicdomain/zero/1.0/
*/

    session_start();
	error_reporting(0);
	
	if(count(explode('/'.$_SERVER['HTTP_HOST'], $_SERVER['HTTP_REFERER'])) < 2) return;
	
    $ow = $_REQUEST['ow'];
    $lang = $_REQUEST['lang'];

    if($lang) include("lang-".$lang.".php");

    $root = clearSlashes($_REQUEST['root'], FALSE);
    $docRoot = clearSlashes($_SERVER['DOCUMENT_ROOT'], FALSE);
    $fullRoot = clearSlashes($docRoot.$root,FALSE);

    if(!$_SESSION['toplimit'] || $_GET['settoplimit'] == 'true') {
        $_SESSION['toplimit'] = $fullRoot;
        $_SESSION['initialroot'] = $root;
    }

    $top = $_SESSION['toplimit'];
    $ir = $_SESSION['initialroot'];

    $up = explode('/', $fullRoot);
    
    $cont = '';
    while(!$cont && count($up)) {
        $cont = array_pop($up);
    }
    $up = clearSlashes(implode('/', $up), FALSE);
        
    if(strpos($up, $top) === FALSE) {
        $up = 'none';
    } else {
        $up = clearSlashes($ir.end(explode($top, $up)));
    }

    if($_GET['optype'] == 'movefile') {
        if(!$_GET['filename']) return;
        
        $file = $_GET['filename'];
        $currentFile = $file;
        if($ow == 'false' || $ow == '0') {
            $count = 0;
            while($found = file_exists(clearSlashes($docRoot.$root.$currentFile, FALSE, FALSE))) {
                $count++;
                $ext = '.'.end(explode('.', $file));
                $fbody = substr($file,0,(strlen($file) - strlen($ext)));
                $currentFile = $fbody." (".$count.")".$ext;
            }
        }

        rename(clearSlashes(getDir().'/fileupload/images/php/files/'.$file, FALSE, FALSE), clearSlashes($docRoot.$root.$currentFile, FALSE, FALSE));

        return;
    }

    if($_GET['optype'] == 'newdir') {
        if($_GET['newdir']) mkdir($fullRoot.$_GET['newdir']);
        header('location: ?lang='.$lang.'&ow='.$ow.'&root='.$root);
        return;
    }

    if($_GET['optype'] == 'deldir') {
        if($_GET['deldir']) {
            $delerror = rmdir($fullRoot.$_GET['deldir']) ? 0 : 1;
        }
        header('location: ?lang='.$lang.'&ow='.$ow.'&root='.$root.'&delerror='.$delerror);
        return;
    }

    if($_POST['optype'] == 'delete') {
        if($_POST['opdir'] == $_POST['root']) {
            $files = explode(',', $_POST['files']);
            foreach($files as $file) {
                unlink($fullRoot.$file);
            }
            header('location: ?lang='.$lang.'&ow='.$ow.'&root='.$root);
            return;
        }
    }

    if($_POST['paste'] && clearSlashes($_SESSION['buffer']['opdir'], FALSE) != $root) {
        $opdir = clearSlashes($_SESSION['buffer']['opdir'], FALSE);
        $files = explode(',', $_SESSION['buffer']['files']);
        $optype = $_SESSION['buffer']['optype'];
        foreach($files as $file) {
            $currentFile = $file;
            if($ow == 'false' || $ow == '0') {
                $count = 0;
                while($found = file_exists(clearSlashes($docRoot.$root.$currentFile, FALSE, FALSE))) {
                    $count++;
                    $ext = '.'.end(explode('.', $file));
                    $fbody = substr($file,0,(strlen($file) - strlen($ext)));
                    $currentFile = $fbody." (".$count.")".$ext;
                }
            }

            copy(clearSlashes($docRoot.$opdir.$file, FALSE, FALSE), clearSlashes($docRoot.$root.$currentFile, FALSE, FALSE));
            
            if($optype == 'cut') {
                unlink(clearSlashes($docRoot.$opdir.$file, FALSE, FALSE));
            }
        }

        $_SESSION['buffer']['opdir'] = '';
        $_SESSION['buffer']['files'] = '';
        $_SESSION['buffer']['optype'] = '';

        return;
    }

    if($_POST['optype'] == 'cut' || $_POST['optype'] == 'copy') {
        $_SESSION['buffer']['opdir'] = clearSlashes($_POST['opdir'], FALSE);
        $_SESSION['buffer']['files'] = $_POST['files'];
        $_SESSION['buffer']['optype'] = $_POST['optype'];
    }
    
    $opdir = $_SESSION['buffer']['opdir'];
    $files = $_SESSION['buffer']['files'];
    $optype = $_SESSION['buffer']['optype'];


    $list = getList($fullRoot);

    /* Functions */
    function etrans($phrase) {
        global $translate;
        echo $translate[$phrase] ? $translate[$phrase] : $phrase;
        return;
    }

    function trans($phrase) {
        global $translate;
        return $translate[$phrase] ? $translate[$phrase] : $phrase;
    }

    function getDir($dosya = 'fops.php') {
        $hoy = get_included_files();
        foreach ($hoy as $f) {
		    if(strpos($f, $dosya)>-1) {
			    $h = $f;
			    break;
		    }
	    }
	    if($h) {
		    $h = explode($dosya, $h);
		    $h = $h[0];
	    } else {
		    $h = '';
	    }

	    /*
	    ** Sunucuyu yapılandıran kişinin o anda ne içtiğine bağlı olarak
	    ** document_root bilgisini ayrıca ayıklamak gerekebilir
	    ** Teşekkürler isimtescil
	    */
		$h = str_replace('\\', '/', $h);
		$dr =  str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
		$h = $dr.end(explode($dr, $h));

	    return $h;
    }

    function getList($root) {
        $d = dir($root);
        $dir = array();
        $img = array();
        while (false !== ($entry = $d->read())) {
            if($entry != '.' && $entry != '..') {
                if(!findHandle($root.$entry)) {
                    $type = strtolower(end(explode('.', $entry)));
                    if(
                        $type == 'jpg' ||
                        $type == 'png' ||
                        $type == 'gif' ||
                        $type == 'jpeg'
                    ) {
                        $img[] = $entry;
                    }
                } else {
                    $dir[] = $entry;
                }
            }
        }
        $d->close();
        return array (
            'dir' => $dir,
            'img' => $img
        );
    }

    function findHandle($path) {
        $d = dir($path);
        $answer = FALSE;
        if($d->handle) $answer = TRUE;
        $d->close;
        return $answer;
    }

    function clearSlashes($path, $beginsWithSlash = TRUE, $endsWithSlash = TRUE) {
        while(strpos($path, '\\') !== FALSE) $path = str_replace('\\', '/', $path); //Bugfix
		if(strpos($path, ':/') === FALSE) $beginsWithSlash = TRUE; //Bugfix
		$path = '/'.$path.'/';
        while(strpos($path, '//') > -1) {
            $path = str_replace('//', '/', $path);
        }
        $path = ($beginsWithSlash ? '/' : '').substr($path, 1, strlen($path) - 2).($endsWithSlash ? '/' : '');
        return $path;
    }
    /* End: Functions */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">        <link rel="stylesheet" href="fops.css" />
    </head>
    <body>
        <?php if($_GET['delerror']) echo '<script>alert("'.trans("Directory could not be deleted!").'");</script>';?>
        <input type="hidden" id="updir" value="<?php echo $up;?>" />
        <input type="hidden" id="conf_directory_delete" value="<?php etrans("Are You Sure You Want To Delete This Directory?");?>" />
        <input type="hidden" id="conf_file_delete" value="<?php etrans("Are You Sure You Want To Delete This File?");?>" />
        <input type="hidden" id="conf_sel_file_delete" value="<?php etrans("Are You Sure You Want To Delete Selected File(s)?");?>" />
        <form id="fileopform" method="post">
            <input type="hidden" name="ow" value="<?php echo $ow;?>" />
            <input type="hidden" name="lang" value="<?php echo $lang;?>" />
            <input type="hidden" name="root" value="<?php echo $root;?>" />
            <input type="hidden" name="opdir" value="<?php echo $opdir;?>" />
            <input type="hidden" name="files" value="<?php echo $files;?>" />
            <input type="hidden" name="optype" value="<?php echo $optype;?>" />
        </form>

        <?php
            if($root == $opdir && $optype == 'cut') {
                $cutlist = ','.$files.',';
            }
        ?>
        
        <div class="topcontrols">
            <div class="selblock">
                <input type="hidden" name="float" value="none" />
                <input class="fileuploadbtn" type="file" data-root="<?php echo $root;?>" name="files[]" multiple>

                <div class="group m-right12">
                    <label><?php etrans("Image");?>:</label>
                    <input type="text" name="selfile" />
                </div>

                <div class="group m-right12">
                    <label><?php etrans("Float");?>:</label>
                    <button class="float-btn grey selected" data-float="none"><?php etrans("None");?></button>
                    <button class="float-btn grey" data-float="left"><?php etrans("Left");?></button>
                    <button class="float-btn grey" data-float="right"><?php etrans("Right");?></button>
                </div>

                <div class="group m-right12">
                    <label><?php etrans("Width");?>:</label>
                    <select id="selwidth">
                        <option value="auto">auto</option>
                        <option value="25%">25%</option>
                        <option value="25%">33%</option>
                        <option value="50%">50%</option>
                        <option value="25%">67%</option>
                        <option value="75%">75%</option>
                        <option value="100%">100%</option>
                        <option value="1"><?php etrans("Free");?></option>
                    </select>
                    <input type="text" class="hidden" name="width" value="auto" />
                </div>

                <div class="clear"></div>

                <div class="group">
                    <label><?php etrans("Alt");?>:</label>
                    <input type="text" name="alt" />
                </div>
            </div>
        </div>

        <table style="width: 100%;">
            <tr>
                <td class="dirblock">
                    <span class="currentdir"><?php echo end(explode('/', clearSlashes($root, FALSE, FALSE)));?></span>
                    <ul class="directories">
                        <?php   if($up != 'none') {?><li><a href="?lang=<?php echo $lang;?>&ow=<?php echo $ow;?>&root=<?php echo $up;?>">..</a></li><?php }?>
                        <li>
                            <a href="javascript:;" data-root="<?php echo $root;?>" class="adddir"><span class="adddir">+</span><input type="text" name="adddir" placeholder="<?php etrans("Add Directory");?>" /></a>
                        </li>
                        <?php   foreach($list['dir'] as $dir) {?>
                                    <li><a href="javascript:;" class="deldir" data-root="<?php echo $root;?>" data-dir="<?php echo $dir;?>" title="Delete Directory">x</a><a href="?lang=<?php echo $lang;?>&ow=<?php echo $ow;?>&root=<?php echo $root.$dir;?>"><?php echo $dir;?></a></li>
                        <?php   }?>
                    </ul>
                </td>
                <td class="fileblock">
                    <div class="buttonblock">
                        <button class="btn-add green"><?php etrans("UPLOAD");?></button>
                        <button class="btn-del red m-right"><?php etrans("DELETE");?></button>
                        <button class="btn-cut orange"><?php etrans("CUT");?></button>
                        <button class="btn-copy orange"><?php etrans("COPY");?></button>
                        <button class="btn-paste blue"><?php etrans("PASTE");?></button>
                    </div>
                    <ul class="images">
                        <?php   foreach($list['img'] as $img) {?>
                                    <li title="<?php echo $img;?>" data-root="<?php echo clearSlashes($root);?>" class="<?php echo strpos($cutlist, ','.$img.',') > -1 ? 'cut' : ''?> <?php echo (strpos(','.$_GET['files'].',', ','.$img.',') > -1 ? 'selected' : '');?>">
                                        <div class="imgfile" style="background-image: url('<?php echo clearSlashes($root.$img, TRUE, FALSE);?>');"></div>
                                        <span class="filename"><?php echo $img;?></span>
                                        <span class="fileops">
                                            <a href="javascript:;" class="delpic" title="<?php etrans("Delete");?>">X</a>
                                        </span>
                                    </li>
                        <?php   }?>
                    </ul>
                </td>
            </tr>
        </table>
        <div class="cover"></div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <script src="fileupload/jquery.iframe-transport.js"></script>
        <script src="fileupload/jquery.fileupload.js"></script>
        <script src="fops.min.js"></script>
    </body>
</html>