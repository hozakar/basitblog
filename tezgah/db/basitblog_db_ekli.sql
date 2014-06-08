/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : basitblog_db

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2014-06-08 23:52:52
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
  CONSTRAINT `etiketgruplari_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `makaleler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `etiketgruplari_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `etiketler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of etiketgruplari
-- ----------------------------
INSERT INTO `etiketgruplari` VALUES ('1', '1', '1');
INSERT INTO `etiketgruplari` VALUES ('4', '3', '2');
INSERT INTO `etiketgruplari` VALUES ('2', '6', '1');
INSERT INTO `etiketgruplari` VALUES ('5', '6', '2');
INSERT INTO `etiketgruplari` VALUES ('3', '7', '1');
INSERT INTO `etiketgruplari` VALUES ('6', '8', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of etiketler
-- ----------------------------
INSERT INTO `etiketler` VALUES ('1', 'PHP', '1', 'red', '1');
INSERT INTO `etiketler` VALUES ('2', 'JavaScript', '1', 'green', '1');
INSERT INTO `etiketler` VALUES ('3', 'HTML5', '1', 'blue', '1');
INSERT INTO `etiketler` VALUES ('4', 'CSS3', '1', 'yellow', '1');
INSERT INTO `etiketler` VALUES ('5', 'SQL', '1', 'white', '1');
INSERT INTO `etiketler` VALUES ('6', 'Basit Blog', '0', '#ccc', '1');
INSERT INTO `etiketler` VALUES ('7', 'Basit', '0', '#ccc', '1');
INSERT INTO `etiketler` VALUES ('8', 'Blog', '0', '#ccc', '1');

-- ----------------------------
-- Table structure for `foto`
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of foto
-- ----------------------------
INSERT INTO `foto` VALUES ('1', '1', '.png', 'hoy', '999999');
INSERT INTO `foto` VALUES ('2', '2', '.png', 'hey', '999999');
INSERT INTO `foto` VALUES ('3', '2', '.png', null, '999999');
INSERT INTO `foto` VALUES ('4', '2', '.png', null, '999999');
INSERT INTO `foto` VALUES ('5', '2', '.png', null, '999999');
INSERT INTO `foto` VALUES ('6', '2', '.png', null, '999999');

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
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `eposta` (`eposta`),
  KEY `sid` (`sid`),
  CONSTRAINT `kullanicilar_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sitebilgi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kullanicilar
-- ----------------------------
INSERT INTO `kullanicilar` VALUES ('1', 'Hakan Özakar', 'hozakar@gmail.com', '4321', '0', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of makaleler
-- ----------------------------
INSERT INTO `makaleler` VALUES ('1', 'İyi ama bir tren bunu yapabilir mi?', 'Yapamaz...', 'Deneme', 'Tren', '2014-06-08 17:34:58', '1', '1', '0', 'iyi-ama-bir-tren-bunu-yapabilir-mi', 'makale.html', '1');
INSERT INTO `makaleler` VALUES ('2', 'Herhangi bir konu hakkında ileri geri birkaç laf edesim var', 'Ufaktan anlatayım bari', '                    <p>\r\n                        There’s a reason I don’t write bad Yelp reviews or comment on shitty YouTube videos: I don’t believe in wasting words on things I don’t like. So why have I spent so much time and so many words on <em>Frozen</em>, a movie I openly loathed?\r\n                    </p>\r\n                    <p>\r\n                        <img src=\"inc/images/space_3.png\" style=\"width: 100%; height: 480px;\" />\r\n                    </p>\r\n                    <h2>\r\n                        Biraz daha yaz\r\n                    </h2>\r\n                    <p>\r\n                        In a recent DGA (Director’s Guild of America) “Women’s Steering Committee” meeting, the DGA resolved to “work diligently” to solve the problem of the gender imbalance in film. Everyone patted themselves on the back, declared the job mostly done and went home, except for the people <a target=\"_blank\" href=\"http://www.lexi-alexander.com/blog/2014/1/13/this-is-me-getting-real\">who pointed out</a> that the EEOC resolved to do exactly the same thing in <a target=\"_blank\" href=\"http://www.law.umaryland.edu/marshall/usccr/documents/cr12em712.pdf\">1978</a> — fourteen years after motion picture studios were found almost uniformly in violation of the Civil Rights Act of 1964. The state of the industry for women is absolutely abysmal, and has been for decades.\r\n                    </p>\r\n                    <h2>\r\n                        Bir daha çal Sam...\r\n                    </h2>\r\n                    <p>\r\n                        <img src=\"inc/images/space_5.png\" style=\"width: 100%;\" />\r\n                    </p>\r\n                    <p>\r\n                        <img src=\"inc/images/space_0.png\" style=\"width: 240px; height: 240px; float: left; margin-right: 12px;\" />\r\n                        There’s a reason I don’t write bad Yelp reviews or comment on shitty YouTube videos: I don’t believe in wasting words on things I don’t like. So why have I spent so much time and so many words on <em>Frozen</em>, a movie I openly loathed?\r\n                    </p>\r\n                    <h3>\r\n                        Bi siktir git Sam...\r\n                    </h3>\r\n                    <p>\r\n                        In a recent DGA (Director’s Guild of America) “Women’s Steering Committee” meeting, the DGA resolved to “work diligently” to solve the problem of the gender imbalance in film. Everyone patted themselves on the back, declared the job mostly done and went home, except for the people <a target=\"_blank\" href=\"http://www.lexi-alexander.com/blog/2014/1/13/this-is-me-getting-real\">who pointed out</a> that the EEOC resolved to do exactly the same thing in <a target=\"_blank\" href=\"http://www.law.umaryland.edu/marshall/usccr/documents/cr12em712.pdf\">1978</a> — fourteen years after motion picture studios were found almost uniformly in violation of the Civil Rights Act of 1964. The state of the industry for women is absolutely abysmal, and has been for decades.\r\n                    </p>\r\n\r', 'Bu da tren', '2014-06-08 17:36:11', '1', '1', '0', 'herhangi-bir-konu-hakkinda-ileri-geri-birkaç-laf-edesim-var', 'makale.html', '1');

-- ----------------------------
-- Table structure for `sitebilgi`
-- ----------------------------
DROP TABLE IF EXISTS `sitebilgi`;
CREATE TABLE `sitebilgi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dil` varchar(5) NOT NULL,
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
  `satirsayi` tinyint(4) DEFAULT '10',
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sitebilgi
-- ----------------------------
INSERT INTO `sitebilgi` VALUES ('1', 'tr', 'utf-8', 'Asia/Istanbul', 'Basit Blog', 'beltslib, blog, basit', 'BELTLIB.NET', 'http://beltslib.net', 'inc/images/space_2.png', 'Basit Blog', 'BELTSLIB.NET', 'Göktaşına nanik yapan dinozor...', 'd/m/Y', 'd/m/Y H:i', '25', '60', '120', '10', 'Hakan Özakar', 'hozakar@gmail.com', '/', 'hozakar@gmail.com', null, null, null, null, '1', '0');

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
INSERT INTO `sosyal` VALUES ('1', 'GitHub', 'http://github.com', 'fa-github', 'black', 'white', '1', '0');
INSERT INTO `sosyal` VALUES ('2', 'Twitter', 'http://twitter.com', 'fa-twitter', '#00ABF0', 'white', '1', '1');
INSERT INTO `sosyal` VALUES ('3', 'Facebook', 'http://facebook.com', 'fa-facebook', '#3C599F', 'white', '1', '2');
INSERT INTO `sosyal` VALUES ('4', 'RSS', 'http://beltslib.net/rss/', 'fa-rss', '#FEA501', 'white', '1', '3');

-- ----------------------------
-- Table structure for `yorumlar`
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yorumlar
-- ----------------------------
INSERT INTO `yorumlar` VALUES ('1', '2', null, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', 'Hakan', 'hakan@beltslib.net', 'http://beltslib.net', '2014-06-08 19:42:48', '1');
INSERT INTO `yorumlar` VALUES ('6', '2', null, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', 'Hakan', 'hozakar@gmail.com', 'http://beltslib.net', '2014-06-08 19:47:29', '1');
INSERT INTO `yorumlar` VALUES ('7', '2', null, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', 'Hakan', 'hozakar@hotmail.com', 'http://beltslib.net', '2014-06-08 20:33:44', '1');
