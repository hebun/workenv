-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2013 at 05:18 AM
-- Server version: 5.5.30-log
-- PHP Version: 5.4.13

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `addkeyword`(IN `_tarih` INT(11), IN `_campaign` VARCHAR(100), IN `_account` VARCHAR(100), IN `_keywordState` VARCHAR(50), IN `_keyword` VARCHAR(100), IN `_adGroup` VARCHAR(100), IN `_status` VARCHAR(100), IN `_maxCPC` FLOAT(3,2), IN `_clicks` INT(10), IN `_impressions` INT(10), IN `_ctr` VARCHAR(10), IN `_avgCPC` FLOAT(3,2), IN `_cost` FLOAT(10), IN `_avgPosition` FLOAT(3,2), IN `_labels` VARCHAR(100))
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

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adwords`
--

CREATE TABLE IF NOT EXISTS `adwords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Dumping data for table `adwords`
--

INSERT INTO `adwords` (`id`, `campaign`, `account`, `tarih`, `keywordState`, `keyword`, `adGroup`, `status`, `maxCPC`, `clicks`, `impressions`, `ctr`, `avgCPC`, `cost`, `avgPosition`, `labels`) VALUES
(16, 'www.tel-bant.com', '00 www.tel-bant.com', 20130410, 'etkin', '"telbant"', NULL, NULL, 0.00, 3, 16, '%18,75', 0.00, 1.43, 1.00, NULL);
