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

function seo($s, $id){
    /* ************************************************ **
    ** Neden bilmiyorum, regex'ten hiç hazzetmiyorum... **
    ** ************************************************ */

    $tr = array('ş','Ş','ı','İ','ğ','Ğ','ü','Ü','ö','Ö','ç','Ç');
    $en = array('s','s','i','i','g','g','u','u','o','o','c','c');
    $s = str_replace($tr,$en,$s);
    $s = strtolower($s);

    $s = charReplace($s);
    $s = lCase($s);
    $s = str_replace("--","-",$s);
    $s = trim($s, '-');

    /* Belirlenen URL kullanımda mı? */
    global $db;
    $kntr = 0;
    while($hoy = current($db->query("SELECT id FROM makaleler WHERE url = '".$s.($kntr ? '-'.$kntr : '')."' AND id <> $id")->fetch_row())) $kntr++; // Ürkütücü

    return $s.($kntr ? '-'.$kntr : '');
}

function lCase($gelen) {
    /* Biraz pirimitif bir yöntem, aslında mb_strtolower kullansam daha modern görünür :( */
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

function sql_filtre($gelen, $reverse = FALSE) {
    $filtre = explode(',', '*,SELECT,UPDATE,DELETE,INSERT,INTO,VALUE,FROM,LEFT,RIGHT,INNER,JOIN,WHERE,LIMIT,ORDER,CREATE');
    $son = explode(',', '*|,S|ELECT,U|PDATE,D|ELETE,I|NSERT,I|NTO,V|ALUE,F|ROM,L|EFT,R|IGHT,I|NNER,J|OIN,W|HERE,L|IMIT,O|RDER,C|REATE');
    $gelen = $reverse ? str_ireplace($son, $filtre, $gelen) : str_ireplace($filtre, $son, $gelen);
    return $gelen;
}
?>