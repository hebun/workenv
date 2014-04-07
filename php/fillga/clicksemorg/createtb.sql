
CREATE DEFINER=`root`@`localhost` PROCEDURE `addkeyword`(IN `_tarih` INT(11), IN `_campaign` VARCHAR(100), IN `_account` VARCHAR(100), IN `_keywordState` VARCHAR(50), IN `_keyword` VARCHAR(100), IN `_adGroup` VARCHAR(100), IN `_status` VARCHAR(100), IN `_maxCPC` FLOAT(3,2), IN `_clicks` INT(10), IN `_impressions` INT(10), IN `_ctr` VARCHAR(10), IN `_avgCPC` FLOAT(3,2), IN `_cost` FLOAT(3,2), IN `_avgPosition` FLOAT(3,2), IN `_labels` VARCHAR(100))
BEGIN
	IF not EXISTS (SELECT 1 FROM adwords WHERE tarih=_tarih and keyword=_keyword and campaign=_campaign LIMIT 1) THEN
		insert into adwords set keyword=_keyword,
		tarih=_tarih,
		adGroup=_adGroup
		,status=_status
		,keywordState=_keywordState
		,maxCPC=_maxCPC
		,clicks=_clicks
		,impressions=_impressions
		,ctr=_ctr
		,avgCPC=_avgCPC
		,cost=_cost
		,avgPosition=_avgPosition
		,labels=_labels
		,campaign=_campaign
		,account=_account;
	end if ;

END
CREATE TABLE adwords (
	`id` INT(11) not null ,
	`campaign` varchar (100),
	`account` varchar (100), 
	`tarih` INT(11) null,
	`keywordState` varchar(50),
	`keyword` varchar(100) null ,
	`adGroup` varchar(100) null ,
	`status` varchar(100) null ,
	`maxCPC` float(3,2) null ,
	`clicks` INT(10) null ,
	`impressions` INT(10) null ,
	`ctr` float(3,2) null ,
	`avgCPC` float(3,2) null ,
	`cost` float(3,2) null ,
	`avgPosition` float(3,2) null ,
	`labels` varchar(100) null ,
	PRIMARY KEY (`id`)
)ENGINE=InnoDB;
DELIMITER $$

CREATE PROCEDURE `addkeyword`(
	IN _tarih INT(11) ,
	in _campaign varchar (100),
	in _account varchar (100), 
	IN _keywordState varchar(50),
	IN _keyword varchar(100) ,
	IN _adGroup varchar(100)  ,
	IN _status varchar(100)  ,
	IN _maxCPC float(3,2)  ,
	IN _clicks INT(10)  ,
	IN _impressions INT(10)  ,
	IN _ctr float(3,2)  ,
	IN _avgCPC float(3,2)  ,
	IN _cost float(3,2)  ,
	IN _avgPosition float(3,2)  ,
	IN _labels varchar(100) ) 
BEGIN
	IF not EXISTS (SELECT * FROM adwords WHERE tarih=_tarih and keyword=_keyword and LIMIT 1) THEN
		insert into adwords set keyword=_keyword,
		tarih=_tarih
		adGroup=_adGroup
		,status=_status
		,keywordState=_keywordState
		,maxCPC=_maxCPC
		,clicks=_clicks
		,impressions=_impressions
		,ctr=_ctr
		,avgCPC=_avgCPC
		,cost=_cost
		,avgPosition=_avgPosition
		,labels=_labels
		,campaign=_campaign
		,account=_account;

	end if ;

END
IN _tarih INT(11) ,
IN _keywordState varchar(50),
IN _keyword varchar(100) ,
IN _adGroup varchar(100)  ,
IN _status varchar(100)  ,
IN _maxCPC float(3,2)  ,
IN _clicks INT(10)  ,
IN _impressions INT(10)  ,
IN _ctr float(3,2)  ,
IN _avgCPC float(3,2)  ,
IN _cost float(3,2)  ,
IN _avgPosition float(3,2)  ,
IN _labels varchar(100)  ,

SET @p0 =  '123132';

SET @p1 =  '';

SET @p2 =  '';

SET @p3 =  '';

SET @p4 =  '';

SET @p5 =  '';

SET @p6 =  '';

SET @p7 =  '';

SET @p8 =  '';

SET @p9 =  '';

SET @p10 =  '';

SET @p11 =  '';

SET @p12 =  '';

SET @p13 =  '';

SET @p14 =  '';

CALL `addkeyword` (
	@p0 , @p1 , @p2 , @p3 , @p4 , @p5 , @p6 , @p7 , @p8 , @p9 , @p10 , @p11 , @p12 , @p13 , @p14
);
