
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2014 at 07:48 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a7548780_sbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SECOND_NAME` varchar(50) DEFAULT NULL,
  `FIRST_NAME` varchar(50) DEFAULT NULL,
  `THIRD_NAME` varchar(50) DEFAULT NULL,
  `IMEI` varchar(15) DEFAULT NULL,
  `LOGIN` varchar(255) NOT NULL,
  `BIRTH_DATE` date NOT NULL,
  `MANAGER_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`USER_ID`),
  UNIQUE KEY `UK_o_users_LOGIN` (`LOGIN`),
  KEY `IDX_o_user_MANAGER_ID` (`MANAGER_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;
