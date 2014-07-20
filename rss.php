<?php
    include("yonetim/inc/sistem/functions.php");
?><?php echo "<?";?>xml version="1.0" encoding="UTF-8"<?php echo "?>";?>

<rss version="2.0">
    <channel>
        <title><?php echo $site->sb['isim'];?></title>
        <link><?php echo $site->sb['url'].'/';?></link>
        <description><?php echo $site->sb['aciklama'];?></description>
        <?php
            $makaleler = $db->query("SELECT makaleler.*, CONCAT(foto.id, foto.uzanti) as foto FROM makaleler INNER JOIN foto ON foto.mid = makaleler.id WHERE makaleler.sid = $_SESSION[sid] AND makaleler.aktif GROUP BY makaleler.id ORDER BY makaleler.yapiskan DESC, makaleler.tarih DESC, foto.sira LIMIT 10");
            while($makale = $makaleler->fetch_assoc()) {
				$url = $site->sb['url'].'/'.$makale['url'].'.html';
				$tarih = date('D, d M Y', strtotime($makale['tarih']));
        ?>

        <item>
            <title><?php echo $makale['baslik'];?></title>
            <link><?php echo $url;?></link>
            <description>
                <![CDATA[
                <img src="<?php echo $site->sb['url'].'/upload/foto/normal/'.$makale['foto'];?>"/><br><br>
                <?php echo htmlspecialchars(strip_tags($makale['aciklama']));?><br><br>
                <?php
					$makale = explode(' ', strip_tags($makale['icerik']), 26);
					array_pop($makale);
					echo implode(' ', $makale)."...";
				?><br>
                <a href="<?php echo $url;?>">Tümü &raquo;</a>
                ]]>            
            </description>
            <pubDate><?php echo $tarih;?></pubDate>
        </item>
        <?php
            }
        ?>
    
    </channel>
</rss>