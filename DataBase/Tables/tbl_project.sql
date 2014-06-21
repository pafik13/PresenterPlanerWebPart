
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
-- Table structure for table `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `PROJECT_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный ключ проекта',
  `NAME` varchar(255) NOT NULL COMMENT 'Название проекта',
  PRIMARY KEY (`PROJECT_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Проекты' AUTO_INCREMENT=2 ;
