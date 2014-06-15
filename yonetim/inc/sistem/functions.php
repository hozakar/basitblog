<?php
include(getDir().'config.php');
include(getDir().'commonclasses.php');
$site = new site;

function getDir($dosya = 'functions.php') {
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
	return $h;
}

function seo($s){
    /* bu preg işlerinden hiç hazzetmiyorum...
    $tr = array('ş','Ş','ı','İ','ğ','Ğ','ü','Ü','ö','Ö','ç','Ç');
    // Türkçe karakterlerin çevirlecegi karakterler
    $en = array('s','s','i','i','g','g','u','u','o','o','c','c');
    $s = str_replace($tr,$en,$s);
    $s = strtolower($s);
    $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '-', $s);
    $s = preg_replace('/[^%a-z0-9 _-]/', '-', $s);
    $s = preg_replace('/\s+/', '-', $s);
    $s = preg_replace('|-+|', '-', $s);
    $s = str_replace("--","-",$s);
    $s = trim($s, '-');
    */

    $s = charReplace($s);
    $s = lCase($s);
    $s = str_replace("--","-",$s);
    $s = trim($s, '-');

    /* buraya url satirinin çiftlemesini engelleyecek birşeyler yaz */

    return $s;
}

function lCase($gelen) {
    $first = explode(',', 'A,B,C,Ç,D,E,F,G,Ğ,H,I,İ,J,K,L,M,N,O,Ö,P,Q,R,S,Ş,T,U,Ü,V,W,X,Y,Z');
    $last = explode(',', 'a,b,c,ç,d,e,f,g,ğ,h,i,i,j,k,l,m,n,o,ö,p,q,r,s,ş,t,u,ü,v,w,x,y,z');
    $answer = str_replace($first,$last,$gelen);
    return $answer;
}

function charReplace($gelen) {
    $first = explode(',', '",é,!,\',^,#,+,$,%,&,/,{,(,[,),],=,},?,*,\\,_,+,@,€,¨,~,´,;,\,,`,.,:,<,>,|, ');
    $first[] = ',';
    $answer = str_replace($first,'-',$gelen);
    return $answer;
}

function filtre($gelen){
    $yasak = explode(",", "SELECT,INSERT,CREATE,UPDATE,JOIN,CONCAT,DELETE");
    $filtre = str_replace($yasak, '', $gelen);
    return $filtre;
}

function s_addslashes($gelen) {
    global $slashkullan;
    if($slashkullan) $gelen = addslashes($gelen);
    return $gelen;
}
?>

