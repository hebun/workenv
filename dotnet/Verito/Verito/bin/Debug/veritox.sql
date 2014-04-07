/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : veritor

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2012-10-13 00:48:42
*/
drop database if exists veritoa;

create database veritoa;

use veritoa;

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cargo`
-- ----------------------------
DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firma` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ctext` varchar(2000) COLLATE utf8_bin DEFAULT NULL,
  `authorized` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `col1` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `col2` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `col3` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of cargo
-- ----------------------------

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `code` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `len` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('41', 'telefon', '001', '3');
INSERT INTO `category` VALUES ('44', 'zzzz', '003', '3');
INSERT INTO `category` VALUES ('45', 'yyy', '004', '3');
INSERT INTO `category` VALUES ('46', 'ggg', '005', '3');
INSERT INTO `category` VALUES ('47', 'asd', '006', '3');
INSERT INTO `category` VALUES ('48', 'asdg', '007', '3');
INSERT INTO `category` VALUES ('49', 'rr', '008', '3');
INSERT INTO `category` VALUES ('50', 'sdf', '009', '3');
INSERT INTO `category` VALUES ('51', '234', '010', '3');
INSERT INTO `category` VALUES ('52', 'fff', '011', '3');

-- ----------------------------
-- Table structure for `currency`
-- ----------------------------
DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `symbol` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of currency
-- ----------------------------
INSERT INTO `currency` VALUES ('1', 'Dolar', '$');
INSERT INTO `currency` VALUES ('2', 'Türk Lirası', 'TL');
INSERT INTO `currency` VALUES ('3', 'Euro', '?');
INSERT INTO `currency` VALUES ('4', 'japon yeni', 'yen');

-- ----------------------------
-- Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firma` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `ctext` varchar(2000) COLLATE utf8_bin DEFAULT NULL,
  `authorized` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `col1` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `col2` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `col3` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `tel` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ccode` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('3', '23', '234', '234234', '234', '234', null, null, null, null, null, null);
INSERT INTO `customer` VALUES ('4', 'adı', 'bilgiler', 'yetkili', 'asdf', 'asdf', null, 'adres', 'telefon', 'email', 'website', null);
INSERT INTO `customer` VALUES ('5', 'asdf', 'asdfsdf', '23r4wer', '', '', null, '', '', '', '', 'asdf');
INSERT INTO `customer` VALUES ('6', 'asdf', 'asdf', 'asdf', '', '', null, '', '', '', '', 'ccode');

-- ----------------------------
-- Table structure for `form`
-- ----------------------------
DROP TABLE IF EXISTS `form`;
CREATE TABLE `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of form
-- ----------------------------

-- ----------------------------
-- Table structure for `formfield`
-- ----------------------------
DROP TABLE IF EXISTS `formfield`;
CREATE TABLE `formfield` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formid` int(11) DEFAULT NULL,
  `fieldid` int(11) DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `required` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of formfield
-- ----------------------------
INSERT INTO `formfield` VALUES ('1', '1', '1', 'txt', '1');
INSERT INTO `formfield` VALUES ('2', '1', '2', 'txt', '0');
INSERT INTO `formfield` VALUES ('3', '1', '3', 'combo', '1');
INSERT INTO `formfield` VALUES ('4', '1', '4', 'txt', '1');
INSERT INTO `formfield` VALUES ('5', '1', '5', 'txt', '0');
INSERT INTO `formfield` VALUES ('6', '1', '6', 'combo', '0');
INSERT INTO `formfield` VALUES ('7', '1', '7', 'combo', '0');
INSERT INTO `formfield` VALUES ('8', '1', '8', 'combo', '0');
INSERT INTO `formfield` VALUES ('9', '1', '9', 'txt', '0');
INSERT INTO `formfield` VALUES ('10', '1', '10', 'txt', '0');
INSERT INTO `formfield` VALUES ('11', '1', '11', 'txt', '0');

-- ----------------------------
-- Table structure for `grid`
-- ----------------------------
DROP TABLE IF EXISTS `grid`;
CREATE TABLE `grid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gridname` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of grid
-- ----------------------------
INSERT INTO `grid` VALUES ('1', 'test');
INSERT INTO `grid` VALUES ('2', 'safha');

-- ----------------------------
-- Table structure for `gridfield`
-- ----------------------------
DROP TABLE IF EXISTS `gridfield`;
CREATE TABLE `gridfield` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gridid` int(11) DEFAULT NULL,
  `cname` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `ctext` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cshow` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of gridfield
-- ----------------------------
INSERT INTO `gridfield` VALUES ('1', '1', 'name', 'isim', '1');
INSERT INTO `gridfield` VALUES ('2', '1', 'len', 'uzunluk', '1');
INSERT INTO `gridfield` VALUES ('3', '1', 'code', 'fromcodetoolx', '1');
INSERT INTO `gridfield` VALUES ('4', '1', 'id', 'No', '1');
INSERT INTO `gridfield` VALUES ('5', '2', 'id', 'No', '1');
INSERT INTO `gridfield` VALUES ('6', '2', 'kname', 'Safha Adı', '1');
INSERT INTO `gridfield` VALUES ('7', '3', 'orderNo', 'Sipariş No', '1');
INSERT INTO `gridfield` VALUES ('8', '3', 'odate', 'Tarih', '1');
INSERT INTO `gridfield` VALUES ('9', '3', 'customer', 'Müşteri', '1');
INSERT INTO `gridfield` VALUES ('10', '3', 'provider', 'Tedarikçi', '1');
INSERT INTO `gridfield` VALUES ('11', '3', 'id', 'id', '0');
INSERT INTO `gridfield` VALUES ('12', '4', 'kname', 'Safha Adı', '1');
INSERT INTO `gridfield` VALUES ('13', '3', 'pid', 'ürün id', '0');
INSERT INTO `gridfield` VALUES ('14', '3', 'cid', 'müşteri id', '1');
INSERT INTO `gridfield` VALUES ('17', '5', 'id', 'id', '0');
INSERT INTO `gridfield` VALUES ('18', '5', 'pcount', 'Adet', '1');
INSERT INTO `gridfield` VALUES ('19', '5', 'pname', 'Ürün Adı', '1');
INSERT INTO `gridfield` VALUES ('20', '6', 'pname', 'Ürün Adı', '1');
INSERT INTO `gridfield` VALUES ('21', '6', 'ptext', 'Ürün Özelliği', '1');
INSERT INTO `gridfield` VALUES ('22', '6', 'price', 'Fiyat', '1');
INSERT INTO `gridfield` VALUES ('23', '6', 'cname', 'Para Birimi', '1');
INSERT INTO `gridfield` VALUES ('24', '6', 'uname', 'Birim Cinsi', '1');
INSERT INTO `gridfield` VALUES ('25', '7', 'uname', 'Kullanıcı Adı', '1');
INSERT INTO `gridfield` VALUES ('26', '7', 'password', 'Şifre', '0');
INSERT INTO `gridfield` VALUES ('27', '8', 'yname', 'Yetki Adı', '1');
INSERT INTO `gridfield` VALUES ('28', '8', 'id', 'No', '0');
INSERT INTO `gridfield` VALUES ('29', '9', 'firma', 'Firma Adı', '1');
INSERT INTO `gridfield` VALUES ('30', '9', 'ctext', 'Firma Bilgileri', '1');
INSERT INTO `gridfield` VALUES ('31', '9', 'authorized', 'Yetkili', '1');
INSERT INTO `gridfield` VALUES ('33', '10', 'firma', 'Firma Adı', '1');
INSERT INTO `gridfield` VALUES ('34', '10', 'ptext', 'Firma Bilgileri', '1');
INSERT INTO `gridfield` VALUES ('35', '10', 'authorized', 'Yetkili', '1');
INSERT INTO `gridfield` VALUES ('36', '10', 'address', 'Adres', '1');
INSERT INTO `gridfield` VALUES ('37', '10', 'tel', 'Telefon', '1');

-- ----------------------------
-- Table structure for `konum`
-- ----------------------------
DROP TABLE IF EXISTS `konum`;
CREATE TABLE `konum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kname` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of konum
-- ----------------------------

-- ----------------------------
-- Table structure for `konumproduct`
-- ----------------------------
DROP TABLE IF EXISTS `konumproduct`;
CREATE TABLE `konumproduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `konumid` int(11) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `pcount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of konumproduct
-- ----------------------------

-- ----------------------------
-- Table structure for `location`
-- ----------------------------
DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `int` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`int`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of location
-- ----------------------------

-- ----------------------------
-- Table structure for `option`
-- ----------------------------
DROP TABLE IF EXISTS `option`;
CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oname` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ovalue` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of option
-- ----------------------------

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `odate` datetime DEFAULT NULL,
  `providerid` int(11) DEFAULT NULL,
  `customerid` int(11) DEFAULT NULL,
  `orderNo` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `state` int(11) DEFAULT '0' COMMENT '0:bekleme,1:sevk,2:iptal',
  `konum` int(11) DEFAULT '0' COMMENT 'if state =1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('16', '2012-08-12 00:00:00', '0', '3', '23', '1', '0');
INSERT INTO `order` VALUES ('17', '2012-09-17 00:00:00', '1', '0', '234234', '1', '0');

-- ----------------------------
-- Table structure for `orderproduct`
-- ----------------------------
DROP TABLE IF EXISTS `orderproduct`;
CREATE TABLE `orderproduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `pcount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of orderproduct
-- ----------------------------
INSERT INTO `orderproduct` VALUES ('34', '16', '13', '43');
INSERT INTO `orderproduct` VALUES ('35', '17', '13', '323');

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ptext` varchar(2000) COLLATE utf8_bin DEFAULT NULL,
  `unittypeid` int(11) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `currencyid` int(11) DEFAULT NULL,
  `providerid` int(11) DEFAULT NULL,
  `provider2id` int(11) DEFAULT NULL,
  `minstock` int(11) DEFAULT '-1',
  `col1` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `col2` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `col3` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `provider3id` int(11) DEFAULT NULL,
  `pcode` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `catcode` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('16', 'samsung galaxy', 'bilmem ne bilmem nbe ', '3', '41', '1000', '1', '2', '0', '5', '', '', null, '0', 'asd', '001');

-- ----------------------------
-- Table structure for `provider`
-- ----------------------------
DROP TABLE IF EXISTS `provider`;
CREATE TABLE `provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firma` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `ptext` varchar(2000) COLLATE utf8_bin DEFAULT NULL,
  `authorized` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `col1` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `col2` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `col3` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `tel` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pcode` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of provider
-- ----------------------------
INSERT INTO `provider` VALUES ('1', 'asdf', '', '', '', '', null, '', '', '', '', null);
INSERT INTO `provider` VALUES ('2', 'werer', 'werwerwer', '', '', '', null, 'werwer', '', '', '', 'tcode');

-- ----------------------------
-- Table structure for `stock`
-- ----------------------------
DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `code` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `len` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of stock
-- ----------------------------
INSERT INTO `stock` VALUES ('79', 'zzz', '003', '3');
INSERT INTO `stock` VALUES ('80', 'rrr', '004', '3');
INSERT INTO `stock` VALUES ('81', 'ggg', '005', '3');
INSERT INTO `stock` VALUES ('94', 'telefon bölümü', '006', '3');
INSERT INTO `stock` VALUES ('95', 'iphonelar', '006001', '6');

-- ----------------------------
-- Table structure for `stockproduct`
-- ----------------------------
DROP TABLE IF EXISTS `stockproduct`;
CREATE TABLE `stockproduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) DEFAULT NULL,
  `stockcode` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `pcount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of stockproduct
-- ----------------------------
INSERT INTO `stockproduct` VALUES ('6', '13', '01', '9');
INSERT INTO `stockproduct` VALUES ('7', '13', '02', '3');
INSERT INTO `stockproduct` VALUES ('8', '13', '02', '33');
INSERT INTO `stockproduct` VALUES ('9', '13', '01', '10');
INSERT INTO `stockproduct` VALUES ('10', '13', '02', '323');
INSERT INTO `stockproduct` VALUES ('11', '14', '01', '9');
INSERT INTO `stockproduct` VALUES ('12', '14', '0101', '33');
INSERT INTO `stockproduct` VALUES ('14', '16', '006', '50');
INSERT INTO `stockproduct` VALUES ('15', '16', '006', '50');
INSERT INTO `stockproduct` VALUES ('16', '16', '003', '50');

-- ----------------------------
-- Table structure for `unittype`
-- ----------------------------
DROP TABLE IF EXISTS `unittype`;
CREATE TABLE `unittype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of unittype
-- ----------------------------
INSERT INTO `unittype` VALUES ('1', 'Kg');
INSERT INTO `unittype` VALUES ('2', 'Litre');
INSERT INTO `unittype` VALUES ('3', 'Adet');
INSERT INTO `unittype` VALUES ('4', 'Metre');
INSERT INTO `unittype` VALUES ('5', 'KB');
INSERT INTO `unittype` VALUES ('6', 'yeni birim cinsi');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `type` int(11) DEFAULT '1' COMMENT '0:admin,1:user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('4', 'admin', 'verito', '0');
INSERT INTO `user` VALUES ('8', '2342', '234', '1');

-- ----------------------------
-- Table structure for `useryetki`
-- ----------------------------
DROP TABLE IF EXISTS `useryetki`;
CREATE TABLE `useryetki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `yetkiid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of useryetki
-- ----------------------------
INSERT INTO `useryetki` VALUES ('10', '8', '2');

-- ----------------------------
-- Table structure for `yetki`
-- ----------------------------
DROP TABLE IF EXISTS `yetki`;
CREATE TABLE `yetki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yname` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of yetki
-- ----------------------------
INSERT INTO `yetki` VALUES ('1', 'Yeni Sipariş Oluşturma');
INSERT INTO `yetki` VALUES ('2', 'Ürün Tanımlama');

-- ----------------------------
-- View structure for `orders`
-- ----------------------------
DROP VIEW IF EXISTS `orders`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orders` AS select `o`.`id` AS `id`,`o`.`orderNo` AS `orderNo`,`o`.`odate` AS `odate`,`c`.`firma` AS `customer`,`p`.`firma` AS `provider`,`o`.`state` AS `state`,`c`.`id` AS `cid`,`p`.`id` AS `pid` from ((`order` `o` left join `customer` `c` on((`c`.`id` = `o`.`customerid`))) left join `provider` `p` on((`p`.`id` = `o`.`providerid`))) ;

-- ----------------------------
-- View structure for `vproduct`
-- ----------------------------
DROP VIEW IF EXISTS `vproduct`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vproduct` AS select `product`.`pname` AS `pname`,`product`.`ptext` AS `ptext`,`product`.`unittypeid` AS `unittypeid`,`product`.`categoryid` AS `categoryid`,`product`.`price` AS `price`,`product`.`currencyid` AS `currencyid`,`currency`.`cname` AS `cname`,`unittype`.`uname` AS `uname`,`product`.`id` AS `id`,`product`.`pcode` AS `pcode` from ((`product` left join `currency` on((`product`.`currencyid` = `currency`.`id`))) left join `unittype` on((`product`.`unittypeid` = `unittype`.`id`))) ;

-- ----------------------------
-- Procedure structure for `deluseryetki`
-- ----------------------------
DROP PROCEDURE IF EXISTS `deluseryetki`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `deluseryetki`(IN `_userid` int)
BEGIN

delete from `user` where id=_userid;

delete from useryetki  where userid=_userid;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `getfield`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getfield`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getfield`(IN `id` int)
BEGIN
	SELECT * from gridfield where gridid=`id`;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `moveorder`
-- ----------------------------
DROP PROCEDURE IF EXISTS `moveorder`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `moveorder`(IN `_orderid` integer,IN `_type`  varchar(20) , IN  `_mastercode`  varchar(50))
BEGIN

update `order` set state=1 where id=_orderid;

	if _type="stock" then 
		insert into stockproduct(productid,pcount,stockcode) 
		select productid,pcount,_mastercode from orderproduct where orderid=_orderid;
	else 
		insert into konumproduct(productid,pcount,konumid) 
		select productid,pcount,_mastercode from orderproduct where orderid=_orderid;
	end if;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `moveproduct`
-- ----------------------------
DROP PROCEDURE IF EXISTS `moveproduct`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `moveproduct`(IN `_type` varchar(50),IN `_oldid` varchar(50),IN `_newid` varchar(50),IN _count integer)
BEGIN

DECLARE oldpcount INTEGER;
DECLARE pid INTEGER;
DECLARE _konumid INTEGER;



if _type="stos" then

	set oldpcount=(select pcount from stockproduct where id=_oldid);

	update stockproduct set pcount=pcount-_count where id=_oldid;

  set pid=(select productid from stockproduct where id=_oldid);
	
  insert into stockproduct (productid,stockcode,pcount) values (pid,_newid,_count);

  delete from stockproduct where id=_oldid and pcount=0; 

end if;
if _type="ntos" then

	
  insert into stockproduct (productid,stockcode,pcount) values (_oldid,_newid,_count);

 

end if;
END
;;
DELIMITER ;



-- ----------------------------
-- Procedure structure for `updatefield`
-- ----------------------------
DROP PROCEDURE IF EXISTS `updatefield`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `updatefield`(IN `vctext` varchar(20),IN `vcshow` tinyint,IN `vid` int)
BEGIN
	update gridfield set ctext=vctext,cshow=vcshow where id=vid;

END
;;
DELIMITER ;
