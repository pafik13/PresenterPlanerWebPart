
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
-- Table structure for table `tbl_d_show`
--

CREATE TABLE IF NOT EXISTS `tbl_d_show` (
  `SHOW_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NUMBER` int(11) NOT NULL,
  `TIME` float NOT NULL,
  `LATITUDE` float NOT NULL,
  `LONGTITUDE` float NOT NULL,
  `DEMO_ID` int(11) NOT NULL,
  PRIMARY KEY (`SHOW_ID`),
  KEY `IDX_d_show_DEMO_ID` (`DEMO_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
