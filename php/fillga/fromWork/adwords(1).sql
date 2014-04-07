-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2013 at 10:40 AM
-- Server version: 5.5.30-log
-- PHP Version: 5.4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adwords`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `addGorsel`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addGorsel`(IN `_tarih` INT(11), IN `_account` VARCHAR(100), IN `_clicks` INT(10), IN `_impressions` INT(10), IN `_ctr` VARCHAR(10), IN `_avgCPC` FLOAT(3,2), IN `_cost` FLOAT(10), IN `_customerId` INT(11), IN `_domain` VARCHAR(100))
BEGIN
	  IF not EXISTS (SELECT 1 FROM gorsel WHERE tarih=_tarih and domain=_domain and account=_account LIMIT 1) THEN
		     insert into gorsel set 
	       	tarih=_tarih
		,clicks=_clicks
		,impressions=_impressions
		,ctr=_ctr
		,avgCPC=_avgCPC
		,cost=_cost
                ,customerId=_customerId
                ,domain=_domain
		,account=_account;
	end if ;

END$$

DROP PROCEDURE IF EXISTS `addkeyword`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addkeyword`(IN `_tarih` INT(11), IN `_campaign` VARCHAR(100), IN `_account` VARCHAR(100), IN `_keywordState` VARCHAR(50), IN `_keyword` VARCHAR(100), IN `_adGroup` VARCHAR(100), IN `_status` VARCHAR(100), IN `_maxCPC` FLOAT(3,2), IN `_clicks` INT(10), IN `_impressions` INT(10), IN `_ctr` VARCHAR(10), IN `_avgCPC` FLOAT(3,2), IN `_cost` FLOAT(10), IN `_avgPosition` FLOAT(3,2), IN `_labels` VARCHAR(100), IN `_customerId` INT(11))
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
                ,customerId=_customerId
		,account=_account;
	end if ;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adwords`
--

DROP TABLE IF EXISTS `adwords`;
CREATE TABLE IF NOT EXISTS `adwords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerId` int(11) DEFAULT NULL,
  `campaign` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `account` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `tarih` int(11) DEFAULT NULL,
  `keywordState` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `keyword` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `adGroup` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `maxCPC` float(3,2) DEFAULT NULL,
  `clicks` int(10) DEFAULT NULL,
  `impressions` int(10) DEFAULT NULL,
  `ctr` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `avgCPC` float(3,2) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `avgPosition` float(3,2) DEFAULT NULL,
  `labels` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=766 ;

-- --------------------------------------------------------

--
-- Table structure for table `gorsel`
--

DROP TABLE IF EXISTS `gorsel`;
CREATE TABLE IF NOT EXISTS `gorsel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerId` int(11) DEFAULT NULL,
  `campaign` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `account` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `domain` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `tarih` int(11) DEFAULT NULL,
  `clicks` int(10) DEFAULT NULL,
  `impressions` int(10) DEFAULT NULL,
  `ctr` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `avgCPC` float(3,2) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=533 ;
