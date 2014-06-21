
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
-- Table structure for table `tbl_hospital`
--

CREATE TABLE IF NOT EXISTS `tbl_hospital` (
  `IMEI` varchar(15) NOT NULL COMMENT 'Идентификатор устройства',
  `HOSPITAL_ID` int(11) NOT NULL COMMENT 'Идентификатор ЛПУ уникальный для конкретного устройства',
  `NAME` varchar(255) DEFAULT NULL COMMENT 'Наименование ЛПУ',
  `ADRESS` varchar(255) DEFAULT NULL COMMENT 'Адресс ЛПУ',
  `NEAREST_METRO` varchar(50) DEFAULT NULL COMMENT 'Ближайшее метро',
  `REG_PHONE` varchar(15) DEFAULT NULL COMMENT 'Телефон регестратуры',
  `FILE_ID` int(11) NOT NULL COMMENT 'Ссылка на загруженный файл из которого была взята информация по ЛПУ',
  `EXT_LATITUDE` double DEFAULT NULL COMMENT 'Extension: широта ЛПУ заданная руками',
  `EXT_LONGTITUDE` double DEFAULT NULL COMMENT 'Extension: долгота ЛПУ заданная руками',
  PRIMARY KEY (`IMEI`,`HOSPITAL_ID`),
  KEY `FK_tbl_hospital_tbl_upload_files_ID` (`FILE_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ЛПУ';
