
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2014 at 07:43 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a7548780_sbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `cross_project_user`
--

CREATE TABLE IF NOT EXISTS `cross_project_user` (
  `PROJECT_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  UNIQUE KEY `UK_cross_project_user` (`PROJECT_ID`,`USER_ID`),
  KEY `IDX_cross_project_user_PROJECT_ID` (`PROJECT_ID`),
  KEY `IDX_cross_project_user_USER_ID` (`USER_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Связь между проектами и персонами';
