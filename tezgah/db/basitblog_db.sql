/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : basitblog_db

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2014-06-07 21:59:39
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
  PRIMARY KEY (`id`)
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of etiketler
-- ----------------------------

-- ----------------------------
-- Table structure for `foto`
-- ----------------------------
DROP TABLE IF EXISTS `foto`;
CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `isim` varchar(255) NOT NULL,
  `uzanti` varchar(5) NOT NULL,
  `aciklama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
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
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kullanicilar
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
  `tarih` datetime DEFAULT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `kullanici` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of makaleler
-- ----------------------------

-- ----------------------------
-- Table structure for `sitebilgi`
-- ----------------------------
DROP TABLE IF EXISTS `sitebilgi`;
CREATE TABLE `sitebilgi` (
  `id` int(11) NOT NULL,
  `dil` varchar(5) NOT NULL,
  `charset` varchar(255) NOT NULL DEFAULT 'utf-8',
  `aciklama` varchar(1000) DEFAULT NULL,
  `isim` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `baslik` varchar(255) DEFAULT NULL,
  `eposta` varchar(255) DEFAULT NULL,
  `sifre` varchar(255) DEFAULT NULL,
  `server` varchar(255) DEFAULT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sitebilgi
-- ----------------------------

-- ----------------------------
-- Table structure for `yorumlar`
-- ----------------------------
DROP TABLE IF EXISTS `yorumlar`;
CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `yid` int(11) DEFAULT NULL,
  `yorum` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yorumlar
-- ----------------------------
