<?php
    include("yonetim/inc/sistem/functions.php");
?><?php echo "<?";?>xml version="1.0" encoding="UTF-8"<?php echo "?>"; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

    <url>
        <loc><?php echo $site->sb['url'].'/';?></loc>
        <?php
            $tarih = date('Y-m-d', strtotime(current($db->query("SELECT tarih FROM makaleler WHERE sid = $_SESSION[sid] AND akis AND aktif ORDER BY tarih DESC LIMIT 1")->fetch_row())));
        ?><lastmod><?php echo $tarih;?></lastmod>
        <priority>1</priority>
        <image:image>
            <image:loc><?php echo (strpos($site->sb['foto'], "://") > -1 ? '' : $site->sb['url']).$site->sb['foto'];?></image:loc>
        </image:image>
    </url>
    <?php
        $etiketler = $db->query("SELECT etiketler.*, makaleler.tarih, CONCAT(foto.id, foto.uzanti) as foto FROM etiketler INNER JOIN etiketgruplari ON etiketgruplari.eid = etiketler.id INNER JOIN makaleler ON makaleler.id = etiketgruplari.mid AND makaleler.aktif AND makaleler.sid = $_SESSION[sid] INNER JOIN foto ON foto.mid = makaleler.id WHERE etiketler.menu GROUP BY etiketler.id ORDER BY makaleler.tarih DESC, foto.sira");
        while($etiket = $etiketler->fetch_assoc()) {
    ?>

    <url>
        <loc><?php echo $site->sb['url'].'/etiket/'.$etiket['isim'];?></loc>
        <?php
            $tarih = date('Y-m-d', strtotime($etiket['tarih']));
        ?><lastmod><?php echo $tarih;?></lastmod>
        <priority>0.8</priority>
        <image:image>
            <image:loc><?php echo $site->sb['url'].'/upload/foto/normal/'.$etiket['foto'];?></image:loc>
        </image:image>
    </url>
    <?php
        }
        $makaleler = $db->query("SELECT makaleler.*, CONCAT(foto.id, foto.uzanti) as foto FROM makaleler INNER JOIN foto ON foto.mid = makaleler.id WHERE makaleler.sid = $_SESSION[sid] AND makaleler.aktif GROUP BY makaleler.id ORDER BY makaleler.yapiskan DESC, makaleler.tarih DESC, foto.sira");
        while($makale = $makaleler->fetch_assoc()) {
    ?>

    <url>
        <loc><?php echo $site->sb['url'].'/'.$makale['url'].'.html';?></loc>
        <?php
            $tarih = date('Y-m-d', strtotime($makale['tarih']));
        ?><lastmod><?php echo $tarih;?></lastmod>
        <priority><?php echo $makale['yapiskan'] ? '0.6' : '0.5';?></priority>
        <image:image>
            <image:loc><?php echo $site->sb['url'].'/upload/foto/normal/'.$makale['foto'];?></image:loc>
        </image:image>
    </url>
    <?php
        }
    ?>

</urlset>