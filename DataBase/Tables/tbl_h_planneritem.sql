
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2014 at 07:46 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a7548780_sbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_h_planneritem`
--

CREATE TABLE IF NOT EXISTS `tbl_h_planneritem` (
  `IMEI` varchar(15) NOT NULL COMMENT 'Идентификатор устройства',
  `HOSPITAL_ID` int(11) NOT NULL COMMENT 'Идентификатор ЛПУ уникальный для конкретного устройства',
  `WEEKNUM` int(2) NOT NULL COMMENT 'Номер недели',
  `DAY_OF_WEEK` varchar(9) NOT NULL COMMENT 'День недели',
  `FILE_ID` int(11) NOT NULL COMMENT 'Ссылка на загруженный файл из которого была взята информация по ЛПУ',
  UNIQUE KEY `UK_tbl_h_planneritem` (`HOSPITAL_ID`,`IMEI`,`DAY_OF_WEEK`,`WEEKNUM`),
  KEY `IDX_tbl_h_planneritem` (`HOSPITAL_ID`,`IMEI`),
  KEY `FK_tbl_h_planneritem_tbl_upload_files_ID` (`FILE_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Значения в планнировщике';
