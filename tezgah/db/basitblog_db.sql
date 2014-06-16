SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `etiketgruplari`;
CREATE TABLE `etiketgruplari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `eid_2` (`eid`,`mid`),
  KEY `eid` (`eid`),
  KEY `mid` (`mid`),
  CONSTRAINT `etiketgruplari_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `etiketler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `etiketgruplari_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `etiketler`;
CREATE TABLE `etiketler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(255) NOT NULL,
  `menu` tinyint(4) NOT NULL DEFAULT '0',
  `renk` varchar(10) NOT NULL DEFAULT '#ccc',
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `isim` (`isim`),
  KEY `menu` (`menu`),
  KEY `sid` (`sid`),
  CONSTRAINT `etiketler_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sitebilgi` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `foto`;
CREATE TABLE `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL,
  `uzanti` varchar(5) NOT NULL,
  `aciklama` varchar(255) DEFAULT NULL,
  `sira` int(11) NOT NULL DEFAULT '999999',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`),
  KEY `uzanti` (`uzanti`),
  KEY `sira` (`sira`),
  CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(255) NOT NULL,
  `eposta` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `duzey` tinyint(4) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '1',
  `aktif` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `eposta` (`eposta`),
  KEY `sid` (`sid`),
  CONSTRAINT `kullanicilar_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sitebilgi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `makaleler`;
CREATE TABLE `makaleler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` varchar(255) NOT NULL,
  `altbaslik` varchar(255) DEFAULT NULL,
  `icerik` text,
  `aciklama` varchar(1000) DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `kullanici` int(11) NOT NULL,
  `yapiskan` tinyint(4) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `sablon` varchar(255) NOT NULL DEFAULT 'makale.html',
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `baslik` (`baslik`),
  KEY `altbaslik` (`altbaslik`),
  KEY `tarih` (`tarih`),
  KEY `aktif` (`aktif`),
  KEY `kullanici` (`kullanici`),
  KEY `sid` (`sid`),
  CONSTRAINT `makaleler_ibfk_1` FOREIGN KEY (`kullanici`) REFERENCES `kullanicilar` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `makaleler_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `sitebilgi` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `sitebilgi`;
CREATE TABLE `sitebilgi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dil` varchar(5) NOT NULL DEFAULT 'tr',
  `charset` varchar(255) NOT NULL DEFAULT 'utf-8',
  `zamandilimi` varchar(255) NOT NULL DEFAULT 'Asia/Istanbul',
  `aciklama` varchar(1000) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `isim` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `baslik` varchar(255) DEFAULT NULL,
  `asbaslik` varchar(255) DEFAULT NULL,
  `asaltbaslik` varchar(255) DEFAULT NULL,
  `tarihformat` varchar(24) NOT NULL DEFAULT 'd/m/Y',
  `tarihsaatformat` varchar(24) NOT NULL DEFAULT 'd/m/Y H:i',
  `kisametin` smallint(6) NOT NULL DEFAULT '25',
  `ortametin` smallint(6) NOT NULL DEFAULT '60',
  `uzunmetin` smallint(6) NOT NULL DEFAULT '120',
  `satirsayi` tinyint(4) NOT NULL DEFAULT '10',
  `yazar` varchar(255) DEFAULT NULL,
  `yazarposta` varchar(255) DEFAULT NULL,
  `anadizin` varchar(255) NOT NULL DEFAULT '/',
  `postaadres` varchar(255) DEFAULT NULL,
  `postasunucu` varchar(255) DEFAULT NULL,
  `postakullanici` varchar(255) DEFAULT NULL,
  `postasifre` varchar(255) DEFAULT NULL,
  `postaport` varchar(255) DEFAULT NULL,
  `postaauth` tinyint(4) NOT NULL DEFAULT '1',
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `sosyal`;
CREATE TABLE `sosyal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ikon` varchar(255) NOT NULL DEFAULT 'fa-circle',
  `renk` varchar(10) NOT NULL DEFAULT 'black',
  `hoverrenk` varchar(10) NOT NULL DEFAULT 'white',
  `sid` int(11) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT '999999',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`),
  CONSTRAINT `sosyal_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sitebilgi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `yorumlar`;
CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `yid` int(11) DEFAULT NULL,
  `yorum` varchar(1000) DEFAULT NULL,
  `isim` varchar(255) DEFAULT NULL,
  `eposta` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`),
  KEY `yid` (`yid`),
  KEY `tarih` (`tarih`),
  CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `yorumlar_ibfk_2` FOREIGN KEY (`yid`) REFERENCES `yorumlar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
