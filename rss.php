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
        ?>

        <item>
            <title><?php echo $makale['baslik'];?></title>
            <link><?php echo $site->sb['url'].'/'.$makale['url'].'.html';?></link>
            <description>
                <![CDATA[
                <img src="<?php echo $site->sb['url'].'/upload/foto/normal/'.$makale['foto'];?>"/><br>
                <?php echo htmlspecialchars(strip_tags($makale['aciklama']));?><br>
                <?php echo htmlspecialchars(strip_tags($makale['icerik']));?><br>
                <a href="<?php echo $site->sb['url'].'/'.$makale['url'].'.html';?>">Tümü &raquo;</a>
                ]]>            
            </description>
            <?php
                $tarih = date('D, d M Y', strtotime($makale['tarih']));
            ?><pubDate><?php echo $tarih;?></pubDate>
        </item>
        <?php
            }
        ?>
    
    </channel>
</rss>