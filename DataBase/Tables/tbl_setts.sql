
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2014 at 07:47 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a7548780_sbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setts`
--

CREATE TABLE IF NOT EXISTS `tbl_setts` (
  `WEEK_OF_START` tinyint(4) NOT NULL,
  `PACKAGE_NAME` varchar(50) DEFAULT NULL,
  `PHONE` varchar(15) DEFAULT NULL,
  `DL_SITE` varchar(255) DEFAULT NULL,
  `VERSION_FILE_NAME` varchar(50) DEFAULT NULL,
  `IMEI` varchar(15) NOT NULL,
  `FILE_ID` int(11) NOT NULL,
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Настройки';
