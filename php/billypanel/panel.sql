-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 15 Şub 2014, 09:33:30
-- Sunucu sürümü: 5.6.12-log
-- PHP Sürümü: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `panel`
--
USE `clicks_billypanel`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `password` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `first_name` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `email` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `status` enum('main admin','admin') COLLATE utf8_bin NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `last_name`, `first_name`, `email`, `status`) VALUES
(1, 'admin', 'test', 'John', 'Smith', 'admin@domain.com', 'main admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bolge`
--

CREATE TABLE IF NOT EXISTS `bolge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `bolge`
--

INSERT INTO `bolge` (`id`, `name`, `userId`) VALUES
(1, '34-1-avcilar', 4),
(2, '34-1-avcılar', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `control`
--

CREATE TABLE IF NOT EXISTS `control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `pointId` int(11) NOT NULL,
  `tarih` date DEFAULT NULL,
  `file` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `bolgeId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

--
-- Tablo döküm verisi `control`
--

INSERT INTO `control` (`id`, `userId`, `pointId`, `tarih`, `file`, `bolgeId`) VALUES
(1, 1, 1, '2014-01-14', NULL, NULL),
(2, 1, 1, NULL, '$newfile', NULL),
(3, 1, 1, NULL, '52f082004f116.gif', NULL),
(4, 1, 1, NULL, '52f0824a186f2.gif', NULL),
(5, 1, 1, NULL, '52f082fdaabdb.gif', NULL),
(6, 1, 1, NULL, '52f08302d412a.gif', NULL),
(7, 1, 1, NULL, '52f0833245e9b.gif', NULL),
(8, 1, 1, '0000-00-00', '52f08513c30b7.gif', NULL),
(9, 1, 2, '2014-01-12', '52f0860d83e1c.gif', NULL),
(11, 1, 1, '2014-01-15', '52f0874420371.gif', NULL),
(12, 2, 3, '2014-01-10', '52f088496b65b.gif', NULL),
(13, 1, 2, '2014-01-22', '52f8db42357f2.png', NULL),
(14, 1, 2, '2014-01-25', '52f8db7d67f3f.png', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `eleman`
--

CREATE TABLE IF NOT EXISTS `eleman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  `adm_status` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Tablo döküm verisi `eleman`
--

INSERT INTO `eleman` (`id`, `name`, `username`, `password`, `state`, `adm_status`) VALUES
(1, 'ismet tungö', 'ismet', '2882dc', 0, NULL),
(2, 'asdf', 'asdf', 'asdf', 0, NULL),
(3, 'admin', 'admin', 'test', 1, 'main admin'),
(4, 'özden', 'ozden', '123', 0, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mailday`
--

CREATE TABLE IF NOT EXISTS `mailday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `days` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Tablo döküm verisi `mailday`
--

INSERT INTO `mailday` (`id`, `days`) VALUES
(9, 44);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_name` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_menu_group` tinyint(1) NOT NULL DEFAULT '0',
  `is_removable` tinyint(1) NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order_index` tinyint(3) NOT NULL DEFAULT '0',
  `icon` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `is_dashboard_icon` tinyint(1) DEFAULT '1',
  `is_menu_item` tinyint(1) NOT NULL DEFAULT '1',
  `file_type_id` tinyint(3) NOT NULL DEFAULT '2',
  `isAdm` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `is_menu_name` (`is_menu_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=100 ;

--
-- Tablo döküm verisi `menu`
--

INSERT INTO `menu` (`id`, `name`, `page_name`, `is_menu_group`, `is_removable`, `is_hidden`, `parent_id`, `order_index`, `icon`, `is_dashboard_icon`, `is_menu_item`, `file_type_id`, `isAdm`) VALUES
(1, 'General', '', 1, 0, 0, 0, 0, '', 1, 1, 2, 0),
(5, 'Menu Manager', 'pages/menu_manager.php', 0, 0, 0, 1, 10, 'menu_manager.png', 1, 1, 2, 1),
(6, 'Main', 'home.php', 0, 0, 0, 1, 0, '', 0, 1, 2, 0),
(7, 'My Account', 'pages/my_account.php', 0, 0, 0, 2, 0, 'my_account.png', 1, 1, 2, 0),
(8, 'Admins', 'pages/admins.php', 0, 0, 0, 2, 0, 'admins.png', 1, 1, 2, 0),
(9, 'Users', 'pages/users.php', 0, 0, 0, 2, 5, '', 1, 1, 2, 0),
(10, 'News', 'pages/news.php', 0, 0, 0, 3, 0, '', 1, 1, 2, 0),
(11, 'Mass Mail', 'pages/mass_mail.php', 0, 0, 0, 3, 5, '', 1, 1, 2, 0),
(12, 'Events', 'pages/events.php', 0, 0, 0, 3, 10, '', 1, 1, 2, 0),
(13, 'Logs', 'pages/logs.php', 0, 0, 0, 4, 0, '', 1, 1, 2, 0),
(14, 'Statistics', 'pages/statistics.php', 0, 0, 0, 4, 5, '', 1, 1, 2, 0),
(15, 'Sayfalar', '', 1, 0, 0, 0, 7, NULL, 0, 1, 2, 0),
(16, 'Elemanlar', 'pages/addUser.php', 0, 0, 0, 15, 0, '', 0, 1, 2, 1),
(95, 'Satis Noktalari', 'pages/points.php', 0, 0, 0, 15, 0, NULL, 0, 1, 2, 0),
(97, 'xxxxx', 'xxxx.php', 0, 0, 0, 96, 0, NULL, 0, 1, 2, 0),
(98, 'Kontroller', 'pages/control.php', 0, 0, 0, 15, 0, NULL, 1, 1, 2, 0),
(99, 'Bölgeler', 'pages/bolge.php', 0, 0, 0, 15, 0, NULL, 0, 1, 2, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `point`
--

CREATE TABLE IF NOT EXISTS `point` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cno` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `semt` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `il` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `telno` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mudur` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `mudurtel` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `sef` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `seftel` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `bolgeId` int(11) DEFAULT NULL,
  `warnday` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Tablo döküm verisi `point`
--

INSERT INTO `point` (`id`, `cno`, `address`, `userId`, `name`, `semt`, `il`, `telno`, `mudur`, `mudurtel`, `sef`, `seftel`, `bolgeId`, `warnday`) VALUES
(1, '1673hx', 'bilmem neresi maslak', 1, '34-1-maslak', 'xxxx', 'zzzzz', '', '', '', '', '', 1, 10),
(2, 'blab', 'bsdfsdf', 1, 'blablb', '', '', '', '', '', '', '', 1, 21),
(3, '76yt', 'avlar merkez mah.', 2, '34-2-avcilarö', '', '', '', '', '', '', '', 2, 10),
(4, 'ismet', 'avclar belediye bloks', 1, '34-avcilar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10),
(5, 'dddd', 'xxxx', 4, '34-1-xxxx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 10),
(6, '', 'aa', 2, 'aaaa', '', '', '', 'xxx', 'xxx', 'xx', 'xx', 2, 100);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(125) COLLATE utf8_bin NOT NULL DEFAULT '',
  `site_address` varchar(125) COLLATE utf8_bin NOT NULL DEFAULT '',
  `css_style` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `header_text` varchar(125) COLLATE utf8_bin NOT NULL DEFAULT '',
  `site_language` char(2) COLLATE utf8_bin NOT NULL DEFAULT 'en',
  `datagrid_css_style` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'default',
  `menu_style` enum('left','top') COLLATE utf8_bin NOT NULL DEFAULT 'left',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_address`, `css_style`, `header_text`, `site_language`, `datagrid_css_style`, `menu_style`) VALUES
(1, 'Satış Noktaları Kontrolü', 'domain.com', 'blue', 'Admin Panel', 'tr', 'blue', 'top');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
