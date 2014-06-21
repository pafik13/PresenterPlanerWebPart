
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2014 at 07:45 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a7548780_sbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_demonstration`
--

CREATE TABLE IF NOT EXISTS `tbl_demonstration` (
  `DEMONSTRATION_ID` int(11) NOT NULL AUTO_INCREMENT,
  `IMEI` varchar(15) NOT NULL,
  `DOCTOR_ID` int(11) NOT NULL,
  `VISIT_DATE` date NOT NULL,
  `VISIT_TIME` time NOT NULL,
  `VISIT_ANALYZE` text,
  `INSERT_TIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FILE_ID` int(11) NOT NULL COMMENT 'Ссылка на загруженный файл из которого была взята информация по врачу',
  PRIMARY KEY (`DEMONSTRATION_ID`),
  UNIQUE KEY `UK_o_demonstration` (`DOCTOR_ID`,`IMEI`,`VISIT_DATE`),
  KEY `IDX_o_demonstration` (`IMEI`,`DOCTOR_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;
