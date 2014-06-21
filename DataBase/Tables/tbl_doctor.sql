
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
-- Table structure for table `tbl_doctor`
--

CREATE TABLE IF NOT EXISTS `tbl_doctor` (
  `IMEI` varchar(15) NOT NULL COMMENT 'Идентификатор устройства',
  `DOCTOR_ID` int(11) NOT NULL COMMENT 'Идентификатор врача уникальный для конкретного устройства',
  `SNCHAR` char(1) DEFAULT NULL COMMENT 'Первая буква фамилии (прим. Для создания списков иди сортировки)',
  `SECOND_NAME` varchar(255) DEFAULT NULL COMMENT 'Фамилия врача',
  `FIRST_NAME` varchar(255) DEFAULT NULL COMMENT 'Имя врача',
  `THIRD_NAME` varchar(255) DEFAULT NULL COMMENT 'Отчество врача',
  `HOSPITAL_ID` int(11) DEFAULT NULL COMMENT 'Идентификатор ЛПУ уникальный для конкретного устройства',
  `TEL` varchar(50) DEFAULT NULL COMMENT 'Телефон',
  `EMAIL` varchar(50) DEFAULT NULL COMMENT 'Электронная почта',
  `POSITION_` varchar(50) DEFAULT NULL COMMENT 'Должность',
  `SPECIALITY` varchar(50) DEFAULT NULL COMMENT 'Специальность',
  `FILE_ID` int(11) NOT NULL COMMENT 'Ссылка на загруженный файл из которого была взята информация по врачу',
  PRIMARY KEY (`IMEI`,`DOCTOR_ID`),
  KEY `FK_tbl_doctor_tbl_upload_files_ID` (`FILE_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Доктора и врачи';
