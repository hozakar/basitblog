/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : basitblog_db

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2014-07-02 22:13:49
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `etiketgruplari`
-- ----------------------------
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of etiketgruplari
-- ----------------------------

-- ----------------------------
-- Table structure for `etiketler`
-- ----------------------------
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of etiketler
-- ----------------------------

-- ----------------------------
-- Table structure for `foto`
-- ----------------------------
DROP TABLE IF EXISTS `foto`;
CREATE TABLE `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL,
  `uzanti` varchar(5) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT '999999',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`),
  KEY `uzanti` (`uzanti`),
  KEY `sira` (`sira`),
  CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of foto
-- ----------------------------

-- ----------------------------
-- Table structure for `kullanicilar`
-- ----------------------------
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kullanicilar
-- ----------------------------

-- ----------------------------
-- Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sayfa` varchar(255) DEFAULT NULL,
  `terim` varchar(1000) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tekil` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sayfa` (`sayfa`),
  KEY `terim` (`terim`(255)),
  KEY `mid` (`mid`),
  KEY `tarih` (`tarih`),
  KEY `tekil` (`tekil`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log
-- ----------------------------

-- ----------------------------
-- Table structure for `makaleler`
-- ----------------------------
DROP TABLE IF EXISTS `makaleler`;
CREATE TABLE `makaleler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` varchar(255) NOT NULL,
  `altbaslik` varchar(255) DEFAULT NULL,
  `icerik` text,
  `aciklama` varchar(1000) DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `kullanici` int(11) NOT NULL,
  `yapiskan` tinyint(4) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `sablon` varchar(255) NOT NULL DEFAULT 'makale.html',
  `akis` tinyint(4) NOT NULL DEFAULT '1',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of makaleler
-- ----------------------------

-- ----------------------------
-- Table structure for `sitebilgi`
-- ----------------------------
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
  `g_analytics` text,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sitebilgi
-- ----------------------------
INSERT INTO `sitebilgi` VALUES ('1', 'tr', 'utf-8', 'Asia/Istanbul', null, null, 'localhost', 'http://localhost', '/inc/images/varsayilan.png', 'localhost', 'localhost', null, 'd/m/Y', 'd/m/Y H:i', '25', '60', '120', '10', null, null, '/', null, null, null, null, null, '1', null, '1');

-- ----------------------------
-- Table structure for `sosyal`
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sosyal
-- ----------------------------
INSERT INTO `sosyal` VALUES ('1', 'Twitter', 'http://twitter.com/', 'twitter', '#00abf0', '#ffffff', '1', '0');
INSERT INTO `sosyal` VALUES ('2', 'Facebook', 'http://facebook.com/', 'facebook', '#3c599f', '#ffffff', '1', '1');
INSERT INTO `sosyal` VALUES ('3', 'Google+', 'http://plus.google.com/', 'google-plus', '#f03f27', '#ffffff', '1', '2');
INSERT INTO `sosyal` VALUES ('4', 'RSS', '/rss.xml', 'rss', '#fea501', '#ffffff', '1', '3');

-- ----------------------------
-- Table structure for `yorumlar`
-- ----------------------------
DROP TABLE IF EXISTS `yorumlar`;
CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `yorum` varchar(1000) DEFAULT NULL,
  `isim` varchar(255) DEFAULT NULL,
  `eposta` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`),
  KEY `tarih` (`tarih`),
  CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yorumlar
-- ----------------------------
