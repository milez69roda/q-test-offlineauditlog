/*
SQLyog Enterprise - MySQL GUI v8.05 RC 
MySQL - 5.5.8-log : Database - offlineauditlog_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `cases` */

DROP TABLE IF EXISTS `cases`;

CREATE TABLE `cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_date_start` datetime DEFAULT NULL,
  `review_date_end` datetime DEFAULT NULL,
  `agent_id` varchar(50) DEFAULT NULL,
  `audit_identifier` varchar(25) DEFAULT NULL COMMENT 'Case ID #',
  `question1` int(11) DEFAULT '0' COMMENT '30,0',
  `question2` int(11) DEFAULT '0' COMMENT '25,0',
  `question3` int(11) DEFAULT '0' COMMENT '25,0',
  `question4` int(11) DEFAULT '0' COMMENT '10,0',
  `question5` int(11) DEFAULT '0' COMMENT '10,0',
  `question6` char(10) DEFAULT NULL COMMENT 'YES, AUTO-FAIL',
  `score` int(11) DEFAULT NULL,
  `comments` text,
  `suggestion` text,
  `feedback` text,
  `audit_code` varchar(25) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(20) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `feedback_by` varchar(20) DEFAULT NULL,
  `feedback_date` datetime DEFAULT NULL,
  `reopened` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`audit_code`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `cdr` */

DROP TABLE IF EXISTS `cdr`;

CREATE TABLE `cdr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_date_start` datetime DEFAULT NULL,
  `review_date_end` datetime DEFAULT NULL,
  `agent_id` varchar(30) DEFAULT NULL,
  `kana_case_id` varchar(25) DEFAULT NULL,
  `audit_identifier` varchar(25) DEFAULT NULL COMMENT 'CA Ticket #',
  `question1` int(11) DEFAULT '0',
  `question2` int(11) DEFAULT '0',
  `question3` int(11) DEFAULT '0',
  `question4` int(11) DEFAULT '0',
  `question5` char(10) DEFAULT NULL COMMENT 'YES, AUTO-FAIL',
  `score` int(11) DEFAULT '0',
  `comments` text,
  `suggestion` text,
  `feedback` text,
  `audit_code` varchar(50) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(20) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `feedback_by` varchar(20) DEFAULT NULL,
  `feedback_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`audit_code`)
) ENGINE=MyISAM AUTO_INCREMENT=2064 DEFAULT CHARSET=latin1;

/*Table structure for table `center` */

DROP TABLE IF EXISTS `center`;

CREATE TABLE `center` (
  `centerid` int(11) NOT NULL AUTO_INCREMENT,
  `centerdesc` varchar(100) DEFAULT NULL,
  `centeraddress` varchar(255) DEFAULT NULL,
  `centerdisabled` tinyint(4) DEFAULT '0',
  `centeracronym` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`centerid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `channels` */

DROP TABLE IF EXISTS `channels`;

CREATE TABLE `channels` (
  `ch_id` int(11) NOT NULL AUTO_INCREMENT,
  `ch_name` varchar(30) DEFAULT NULL,
  `ch_status` smallint(6) DEFAULT '1',
  `ch_link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `kana_chat` */

DROP TABLE IF EXISTS `kana_chat`;

CREATE TABLE `kana_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_date_start` datetime DEFAULT NULL,
  `review_date_end` datetime DEFAULT NULL,
  `agent_id` varchar(50) DEFAULT NULL,
  `audit_identifier` varchar(25) DEFAULT NULL COMMENT 'KANA Chat ID #',
  `question1` int(11) DEFAULT '0' COMMENT '30,0',
  `question2` int(11) DEFAULT '0' COMMENT '25,0',
  `question3` int(11) DEFAULT '0' COMMENT '25,0',
  `question4` int(11) DEFAULT '0' COMMENT '10,0',
  `question5` varchar(11) DEFAULT '0' COMMENT '10,0, N/A',
  `question6` int(11) DEFAULT '0' COMMENT '10,0',
  `question7` varchar(11) DEFAULT NULL COMMENT 'Yes/No',
  `score` int(11) DEFAULT NULL,
  `score_interaction` int(11) DEFAULT NULL,
  `comments` text,
  `suggestion` text,
  `feedback` text,
  `audit_code` varchar(25) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(20) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `feedback_by` varchar(20) DEFAULT NULL,
  `feedback_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`audit_code`)
) ENGINE=MyISAM AUTO_INCREMENT=7093 DEFAULT CHARSET=latin1;

/*Table structure for table `kana_email` */

DROP TABLE IF EXISTS `kana_email`;

CREATE TABLE `kana_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_date_start` datetime DEFAULT NULL,
  `review_date_end` datetime DEFAULT NULL,
  `agent_id` varchar(30) DEFAULT NULL,
  `audit_identifier` varchar(25) DEFAULT NULL COMMENT 'KANA Email ID #',
  `question1` int(11) DEFAULT '0' COMMENT '30,0',
  `question2` int(11) DEFAULT '0' COMMENT '25,0',
  `question3` int(11) DEFAULT '0' COMMENT '25,0',
  `question4` varchar(11) DEFAULT '0' COMMENT '10,0,N/A',
  `question5` int(11) DEFAULT NULL COMMENT '10,0',
  `question6` varchar(11) DEFAULT NULL COMMENT 'Yes / Autofail / NA',
  `question7` varchar(11) DEFAULT NULL COMMENT 'Yes / Autofail / NA',
  `score` int(11) DEFAULT '0',
  `score_interaction` int(11) DEFAULT NULL,
  `comments` text,
  `suggestion` text,
  `feedback` text,
  `audit_code` varchar(50) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(35) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `feedback_by` varchar(20) DEFAULT NULL,
  `feedback_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `AuditCodeIndex1` (`audit_code`)
) ENGINE=MyISAM AUTO_INCREMENT=20677 DEFAULT CHARSET=latin1;

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `social_media` */

DROP TABLE IF EXISTS `social_media`;

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_date_start` datetime DEFAULT NULL,
  `review_date_end` datetime DEFAULT NULL,
  `agent_id` varchar(50) DEFAULT NULL,
  `audit_identifier` varchar(25) DEFAULT NULL COMMENT 'Parature Ticket #',
  `question1` int(11) DEFAULT '0',
  `question2` int(11) DEFAULT '0',
  `question3` int(11) DEFAULT '0',
  `question4` int(11) DEFAULT '0',
  `question5` int(11) DEFAULT '0',
  `question6` char(10) DEFAULT NULL COMMENT 'YES, AUTO-FAIL',
  `question7` char(10) DEFAULT NULL COMMENT 'YES, AUTO-FAIL',
  `score` int(11) DEFAULT NULL,
  `comments` text,
  `suggestion` text,
  `feedback` text,
  `audit_code` varchar(60) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(20) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `feedback_by` varchar(20) DEFAULT NULL,
  `feedback_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`audit_code`)
) ENGINE=MyISAM AUTO_INCREMENT=6747 DEFAULT CHARSET=latin1;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '4',
  `centerid` int(11) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(34) NOT NULL,
  `fullname` varchar(60) DEFAULT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `access` varchar(100) DEFAULT NULL,
  `isVisible` smallint(6) DEFAULT '1',
  `isSuper` smallint(6) DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) DEFAULT NULL,
  `newpass` varchar(34) DEFAULT NULL,
  `newpass_key` varchar(32) DEFAULT NULL,
  `newpass_time` datetime DEFAULT NULL,
  `last_ip` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT '0000-00-00 00:00:00',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;