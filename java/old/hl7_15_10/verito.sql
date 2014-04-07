/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : verito

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2012-08-12 07:16:42
*/
CREATE DATABASE IF NOT EXISTS veritor CHARACTER SET utf8 COLLATE utf8_general_ci;

use veritor;

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
  `code` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `len` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of category
-- ----------------------------
-- ----------------------------
-- Table structure for `currency`
-- ----------------------------
DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `symbol` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of currency
-- ----------------------------
INSERT INTO `currency` VALUES ('1', 'Dolar', '$');
INSERT INTO `currency` VALUES ('2', 'Türk Lirası', 'TL');
INSERT INTO `currency` VALUES ('3', 'Euro', '€');


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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of customer
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
INSERT INTO `gridfield` VALUES ('14', '3', 'cid', 'müşteri id', '0');
INSERT INTO `gridfield` VALUES ('17', '5', 'id', 'id', '0');
INSERT INTO `gridfield` VALUES ('18', '5', 'pcount', 'Adet', '1');
INSERT INTO `gridfield` VALUES ('19', '5', 'pname', 'Ürün Adı', '1');
INSERT INTO `gridfield` VALUES ('20', '6', 'pname', 'Ürün Adı', '1');
INSERT INTO `gridfield` VALUES ('21', '6', 'ptext', 'Ürün Özelliği', '1');
INSERT INTO `gridfield` VALUES ('22', '6', 'price', 'Fiyat', '1');
INSERT INTO `gridfield` VALUES ('23', '6', 'cname', 'Para Birimi', '1');
INSERT INTO `gridfield` VALUES ('24', '6', 'uname', 'Birim Cinsi', '1');
INSERT INTO `gridfield` VALUES ('25', '7', 'uname', 'Kullanıcı Adı', '1');
INSERT INTO `gridfield` VALUES ('26', '7', 'password', 'Şifre', '1');
INSERT INTO `gridfield` VALUES ('27', '8', 'yname', 'Yetki Adı', '1');
INSERT INTO `gridfield` VALUES ('28', '8', 'id', 'No', '0');

-- ----------------------------
-- Table structure for `konum`
-- ----------------------------
DROP TABLE IF EXISTS `konum`;
CREATE TABLE `konum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kname` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of order
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of orderproduct
-- ----------------------------

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of product
-- ----------------------------

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of provider
-- ----------------------------

-- ----------------------------
-- Table structure for `stock`
-- ----------------------------
DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `code` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `len` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of stock
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of stockproduct
-- ----------------------------

-- ----------------------------
-- Table structure for `unittype`
-- ----------------------------
DROP TABLE IF EXISTS `unittype`;
CREATE TABLE `unittype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of unittype
-- ----------------------------
INSERT INTO `unittype` VALUES ('1', 'Kg');
INSERT INTO `unittype` VALUES ('2', 'Litre');
INSERT INTO `unittype` VALUES ('3', 'Adet');
INSERT INTO `unittype` VALUES ('4', 'Metre');
INSERT INTO `unittype` VALUES ('5', 'KB');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('4', 'admin', 'verito', '0');


-- ----------------------------
-- Table structure for `useryetki`
-- ----------------------------
DROP TABLE IF EXISTS `useryetki`;
CREATE TABLE `useryetki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `yetkiid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of useryetki
-- ----------------------------

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
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vproduct` AS select `product`.`pname` AS `pname`,`product`.`ptext` AS `ptext`,`product`.`unittypeid` AS `unittypeid`,`product`.`categoryid` AS `categoryid`,`product`.`price` AS `price`,`product`.`currencyid` AS `currencyid`,`currency`.`cname` AS `cname`,`unittype`.`uname` AS `uname`,`product`.`id` AS `id` from ((`product` left join `currency` on((`product`.`currencyid` = `currency`.`id`))) left join `unittype` on((`product`.`unittypeid` = `unittype`.`id`))) ;

-- ----------------------------
-- Procedure structure for `deluseryetki`
-- ----------------------------
DROP PROCEDURE IF EXISTS `deluseryetki`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `deluseryetki`(IN `_userid` int)
BEGIN

delete from `user` where id=_userid;

delete from useryetki  where userid=_userid;

END
;


-- ----------------------------
-- Procedure structure for `getfield`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getfield`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `getfield`(IN `id` int)
BEGIN
	SELECT * from gridfield where gridid=`id`;

END
;


-- ----------------------------
-- Procedure structure for `moveorder`
-- ----------------------------
DROP PROCEDURE IF EXISTS `moveorder`;

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
;


-- ----------------------------
-- Procedure structure for `moveproduct`
-- ----------------------------
DROP PROCEDURE IF EXISTS `moveproduct`;

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
;


-- ----------------------------
-- Procedure structure for `p2`
-- ----------------------------
DROP PROCEDURE IF EXISTS `p2`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `p2`()
    DETERMINISTIC
    COMMENT 'A procedure'
BEGIN  
    SELECT 'Hello World !';  
END
;


-- ----------------------------
-- Procedure structure for `proc_OUT`
-- ----------------------------
DROP PROCEDURE IF EXISTS `proc_OUT`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_OUT`(OUT var1 VARCHAR(100))
BEGIN  
    SET var1 = 'This is a test'; 
select var1; 
END
;


-- ----------------------------
-- Procedure structure for `split_string`
-- ----------------------------
DROP PROCEDURE IF EXISTS `split_string`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `split_string`(
IN input TEXT
, IN `delimiter` VARCHAR(10)
)
    SQL SECURITY INVOKER
    COMMENT 'Splits a supplied string using using the given delimiter,\r\nplacing values in a temporary table'
BEGIN
DECLARE cur_position INT DEFAULT 1 ;
DECLARE remainder TEXT;
DECLARE cur_string VARCHAR(1000);
DECLARE delimiter_length TINYINT UNSIGNED;
 
DROP TEMPORARY TABLE IF EXISTS SplitValues;
CREATE TEMPORARY TABLE SplitValues (
value VARCHAR(1000) NOT NULL PRIMARY KEY
) ENGINE=MyISAM;
 
SET remainder = input;
SET delimiter_length = CHAR_LENGTH(delimiter);
 
WHILE CHAR_LENGTH(remainder) > 0 AND cur_position > 0 DO
SET cur_position = INSTR(remainder, `delimiter`);
IF cur_position = 0 THEN
SET cur_string = remainder;
ELSE
SET cur_string = LEFT(remainder, cur_position - 1);
END IF;
IF TRIM(cur_string) != '' THEN
INSERT INTO SplitValues VALUES (cur_string);
END IF;
SET remainder = SUBSTRING(remainder, cur_position + delimiter_length);
END WHILE;
 
END
;


-- ----------------------------
-- Procedure structure for `test`
-- ----------------------------
DROP PROCEDURE IF EXISTS `test`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `test`(IN `pid` int,OUT `oid` int)
BEGIN
set oid=pid+1;
END
;


-- ----------------------------
-- Procedure structure for `updatefield`
-- ----------------------------
DROP PROCEDURE IF EXISTS `updatefield`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatefield`(IN `vctext` varchar(20),IN `vcshow` tinyint,IN `vid` int)
BEGIN
	update gridfield set ctext=vctext,cshow=vcshow where id=vid;

END
;

