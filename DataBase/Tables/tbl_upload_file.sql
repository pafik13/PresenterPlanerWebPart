
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
-- Table structure for table `tbl_upload_file`
--

CREATE TABLE IF NOT EXISTS `tbl_upload_file` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ключ файла',
  `IMEI` varchar(15) NOT NULL COMMENT 'Идентификатор устройства, с которого был прислан файл',
  `APP_VER` varchar(5) DEFAULT '0.0',
  `TYPE` varchar(255) NOT NULL COMMENT 'Тип записанного файла (прим. Тип передается с устройства)',
  `HASH` varchar(32) NOT NULL COMMENT 'md5 хэш файла, для быстрого определения изменений в файле',
  `TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время загрузки файла',
  `FILE` mediumblob NOT NULL COMMENT 'Файл загруженный из устройства',
  `ERR` text COMMENT 'Ошибки, которые возникли в процессе обработки файла',
  PRIMARY KEY (`ID`),
  KEY `IDX_IMEI_TYPE_HASH` (`IMEI`,`TYPE`,`HASH`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Загруженные файлы на сервер' AUTO_INCREMENT=58 ;
