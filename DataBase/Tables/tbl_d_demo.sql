
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
-- Table structure for table `tbl_d_demo`
--

CREATE TABLE IF NOT EXISTS `tbl_d_demo` (
  `DEMO_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный ключ',
  `SLIDE_KEY` varchar(255) NOT NULL COMMENT 'Ключ слайда',
  `DEMONSTRATION_ID` int(11) NOT NULL COMMENT 'Ссылка на показ',
  PRIMARY KEY (`DEMO_ID`),
  KEY `IDX_d_demo_DEMONSTRATION_ID` (`DEMONSTRATION_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=993 ;
