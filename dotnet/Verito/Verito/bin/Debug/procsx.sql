
-- ----------------------------
-- Procedure structure for `deluseryetki`
-- ----------------------------
DROP PROCEDURE IF EXISTS `deluseryetki`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `deluseryetki`(IN `_userid` int)
BEGIN

delete from `user` where id=_userid;

delete from useryetki  where userid=_userid;

END;



-- ----------------------------
-- Procedure structure for `getfield`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getfield`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `getfield`(IN `id` int)
BEGIN
	SELECT * from gridfield where gridid=`id`;

END;



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
	END if;
END;



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

END if;
if _type="ntos" then

	
  insert into stockproduct (productid,stockcode,pcount) values (_oldid,_newid,_count);

 

END if;
END;





-- ----------------------------
-- Procedure structure for `updatefield`
-- ----------------------------
DROP PROCEDURE IF EXISTS `updatefield`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatefield`(IN `vctext` varchar(20),IN `vcshow` tinyint,IN `vid` int)
BEGIN
	update gridfield set ctext=vctext,cshow=vcshow where id=vid;

END;


