-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: hdr
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applicant`
--

DROP TABLE IF EXISTS `applicant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applicant` (
  `App_NO` int(8) NOT NULL DEFAULT '0',
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `salutation` varchar(10) NOT NULL,
  `citizenship` varchar(50) DEFAULT NULL,
  `telephone` int(16) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `eng_lang` int(1) DEFAULT NULL,
  `eng_test_type` int(1) DEFAULT NULL,
  `eng_test_score` decimal(4,2) DEFAULT NULL,
  `eng_test_date` date DEFAULT NULL,
  PRIMARY KEY (`App_NO`),
  KEY `citizenship` (`citizenship`) USING BTREE,
  CONSTRAINT `applicant_ibfk_1` FOREIGN KEY (`citizenship`) REFERENCES `citizenship` (`citizenship`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicant`
--

LOCK TABLES `applicant` WRITE;
/*!40000 ALTER TABLE `applicant` DISABLE KEYS */;
INSERT INTO `applicant` VALUES (12345678,'12345678','password','Xiang','Fang','Mr','CN',405974207,'cheng.cs56@gmail.com',1,2,4.00,'2014-01-14'),(12345679,'12345679','password','Sam','Loius','Mr','CN',89812345,'cheng.cs56@gmail.com',1,2,4.00,'2014-01-14');
/*!40000 ALTER TABLE `applicant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apr_a`
--

DROP TABLE IF EXISTS `apr_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apr_a` (
  `APR_NO` int(8) NOT NULL DEFAULT '0',
  `Std_NO` int(8) DEFAULT NULL,
  `thesis_title` varchar(400) DEFAULT NULL,
  `suspension_date` varchar(100) DEFAULT NULL,
  `enroll_change_date` varchar(100) DEFAULT NULL,
  `enroll_older_status` varchar(10) DEFAULT NULL,
  `personal_leave_date` varchar(100) DEFAULT NULL,
  `personal_leave_type` varchar(100) DEFAULT NULL,
  `change_supervisor` varchar(100) DEFAULT NULL,
  `scholarship_holder` varchar(100) DEFAULT NULL,
  `other_scholarship` varchar(200) DEFAULT NULL,
  `employment` varchar(200) DEFAULT NULL,
  `ethics_number` varchar(50) DEFAULT NULL,
  `ethics_detail` varchar(1000) DEFAULT NULL,
  `change_focus_detail` varchar(1000) DEFAULT NULL,
  `issues_detail` varchar(1000) DEFAULT NULL,
  `submission_thesis` varchar(200) DEFAULT NULL,
  `comunication_with_sup` varchar(2000) DEFAULT NULL,
  `rejected_comment` varchar(2000) DEFAULT NULL,
  `date_submitted` datetime DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`APR_NO`),
  KEY `FK_Std_APR` (`Std_NO`) USING BTREE,
  CONSTRAINT `apr_a_ibfk_1` FOREIGN KEY (`Std_NO`) REFERENCES `hdr_student` (`Stud_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apr_a`
--

LOCK TABLES `apr_a` WRITE;
/*!40000 ALTER TABLE `apr_a` DISABLE KEYS */;
INSERT INTO `apr_a` VALUES (14149100,12345678,'TEst','','','','','','no','','','','','','','','18-06-2014','test',NULL,'2014-04-01 12:56:57','supervisor submitted'),(14149107,12345678,'test','','','','','','no','','','','','','','','30-06-2014','test',NULL,'2014-05-01 13:07:09','dean submitted'),(14149162,12345678,'test','03-06-2014','','','','','no',',MURS,MIPS','','tesg','','','','','09-06-2014','test',NULL,'2014-06-05 14:40:12','dean submitted'),(14152672,12345678,'new Test','','','','','','no','','','','','','','','24-06-2014','test',NULL,'2014-06-09 16:09:39','supervisor submitted'),(14152826,12345678,'123456789','','','','','','no','','','','','','','','18-06-2014','test',NULL,'2014-06-09 20:27:00','supervisor submitted'),(14153371,12345678,'test','','','','','','no','','','','','','','','16-06-2014','test','tstes','2014-06-10 11:34:58','supervisor rejected'),(14239293,12345678,'hgfh','','','','','','no','APA','','12','','','','','01-09-2014','fsda',NULL,'2014-09-14 10:57:29','student submitted'),(14239384,12345678,'C1','','','','','','no','','','','','','','','04-09-2014','aaa',NULL,'2014-09-14 13:29:58','student submitted');
/*!40000 ALTER TABLE `apr_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apr_b`
--

DROP TABLE IF EXISTS `apr_b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apr_b` (
  `APR_NO` int(8) NOT NULL DEFAULT '0',
  `supervisor` int(8) DEFAULT NULL,
  `rate` varchar(16) DEFAULT NULL,
  `inform_gro` varchar(16) DEFAULT NULL,
  `submission_detail` varchar(2000) DEFAULT NULL,
  `fail_deadline` varchar(4) DEFAULT NULL,
  `avoid_contacting` varchar(4) DEFAULT NULL,
  `change_experienced` varchar(4) DEFAULT NULL,
  `interest_diminishing` varchar(4) DEFAULT NULL,
  `clarify_comment1` varchar(2000) DEFAULT NULL,
  `milestone_completed` varchar(4) DEFAULT NULL,
  `sufficient_detail` varchar(4) DEFAULT NULL,
  `paper_produce` varchar(4) DEFAULT NULL,
  `standard_produce` varchar(4) DEFAULT NULL,
  `clarify_comment2` varchar(2000) DEFAULT NULL,
  `leaving_confirm` varchar(4) DEFAULT NULL,
  `overall_comment` varchar(2000) DEFAULT NULL,
  `absent_arrangement` varchar(1000) DEFAULT NULL,
  `none_recommend_reason` varchar(2000) DEFAULT NULL,
  `date_submitted` datetime DEFAULT NULL,
  PRIMARY KEY (`APR_NO`),
  KEY `supervisor` (`supervisor`) USING BTREE,
  CONSTRAINT `apr_b_ibfk_1` FOREIGN KEY (`APR_NO`) REFERENCES `apr_a` (`APR_NO`),
  CONSTRAINT `apr_b_ibfk_2` FOREIGN KEY (`supervisor`) REFERENCES `supervisor` (`Sup_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apr_b`
--

LOCK TABLES `apr_b` WRITE;
/*!40000 ALTER TABLE `apr_b` DISABLE KEYS */;
INSERT INTO `apr_b` VALUES (14149100,333,'Excellent',NULL,'','Yes','No','No','No','test','Yes','Yes','Yes','Yes','test','No','test3','','','2014-04-23 13:01:26'),(14149107,333,'Excellent',NULL,'','Yes','No','No','No','test','Yes','Yes','Yes','Yes','test','Yes','test3','','','2014-05-18 13:08:45'),(14149162,333,'Marginal','Yes','test','No','Yes','No','No','test','Yes','Yes','Yes','Yes',NULL,'No','test3','','','2014-06-05 14:42:26'),(14152672,333,'Excellent','','','No','No','No','No','','Yes','Yes','Yes','Yes','','No','test','','','2014-06-09 21:00:39'),(14152826,333,'Excellent','','','No','No','No','No','','Yes','Yes','Yes','Yes','','No','test','','','2014-06-10 12:18:32'),(14153371,333,'','','','','','','','','','','','','','','','','','2014-09-12 23:10:02');
/*!40000 ALTER TABLE `apr_b` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apr_c`
--

DROP TABLE IF EXISTS `apr_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apr_c` (
  `APR_NO` int(8) NOT NULL DEFAULT '0',
  `discontinue_reason` varchar(4000) DEFAULT NULL,
  `dean` int(8) DEFAULT NULL,
  `date_submitted` datetime DEFAULT NULL,
  PRIMARY KEY (`APR_NO`),
  KEY `dean` (`dean`) USING BTREE,
  CONSTRAINT `apr_c_ibfk_1` FOREIGN KEY (`APR_NO`) REFERENCES `apr_b` (`APR_NO`),
  CONSTRAINT `apr_c_ibfk_2` FOREIGN KEY (`dean`) REFERENCES `staff_account` (`S_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apr_c`
--

LOCK TABLES `apr_c` WRITE;
/*!40000 ALTER TABLE `apr_c` DISABLE KEYS */;
INSERT INTO `apr_c` VALUES (14149100,'test',666,'2014-04-30 13:03:52'),(14149107,'test',666,'2014-06-01 13:17:24'),(14149162,'test',666,'2014-06-05 14:43:52'),(14152672,NULL,666,'2014-06-10 10:35:41');
/*!40000 ALTER TABLE `apr_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apr_d_a`
--

DROP TABLE IF EXISTS `apr_d_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apr_d_a` (
  `APR_NO` int(8) NOT NULL DEFAULT '0',
  `stp_workshop_date` varchar(100) DEFAULT NULL,
  `assignment_date` varchar(100) DEFAULT NULL,
  `p_sup_reporting` varchar(2000) DEFAULT NULL,
  `p_sup_confirm` varchar(5) DEFAULT NULL,
  `td_workshop_date` varchar(100) DEFAULT NULL,
  `dr_odc_date` varchar(100) DEFAULT NULL,
  `op_odc_date` varchar(100) DEFAULT NULL,
  `additional_comment` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`APR_NO`),
  CONSTRAINT `apr_d_a_ibfk_1` FOREIGN KEY (`APR_NO`) REFERENCES `apr_a` (`APR_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apr_d_a`
--

LOCK TABLES `apr_d_a` WRITE;
/*!40000 ALTER TABLE `apr_d_a` DISABLE KEYS */;
INSERT INTO `apr_d_a` VALUES (14239293,'','','fdsa',NULL,'','','','fdsa'),(14239384,'','','aaa',NULL,'','','','');
/*!40000 ALTER TABLE `apr_d_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apr_d_b`
--

DROP TABLE IF EXISTS `apr_d_b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apr_d_b` (
  `APR_NO` int(8) NOT NULL DEFAULT '0',
  `mcs_presentation_date` varchar(100) DEFAULT NULL,
  `mcs_presentation_title` varchar(500) DEFAULT NULL,
  `additional_comment` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`APR_NO`),
  CONSTRAINT `apr_d_b_ibfk_1` FOREIGN KEY (`APR_NO`) REFERENCES `apr_a` (`APR_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apr_d_b`
--

LOCK TABLES `apr_d_b` WRITE;
/*!40000 ALTER TABLE `apr_d_b` DISABLE KEYS */;
/*!40000 ALTER TABLE `apr_d_b` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apr_milestone_c`
--

DROP TABLE IF EXISTS `apr_milestone_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apr_milestone_c` (
  `A_M_C_NO` int(10) NOT NULL DEFAULT '0',
  `APR_NO` int(8) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`A_M_C_NO`),
  KEY `FK_APR_Mc` (`APR_NO`) USING BTREE,
  CONSTRAINT `apr_milestone_c_ibfk_1` FOREIGN KEY (`APR_NO`) REFERENCES `apr_a` (`APR_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apr_milestone_c`
--

LOCK TABLES `apr_milestone_c` WRITE;
/*!40000 ALTER TABLE `apr_milestone_c` DISABLE KEYS */;
INSERT INTO `apr_milestone_c` VALUES (1414910651,14149107,'test','04-06-2014'),(1414916234,14149162,'test','03-06-2014'),(1414916235,14149162,'test','02-06-2014'),(1415267198,14152672,'tse','03-06-2014'),(1415282639,14152826,'TEST','');
/*!40000 ALTER TABLE `apr_milestone_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apr_milestone_n`
--

DROP TABLE IF EXISTS `apr_milestone_n`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apr_milestone_n` (
  `A_M_N_NO` int(10) NOT NULL DEFAULT '0',
  `APR_NO` int(8) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`A_M_N_NO`),
  KEY `FK_APR_Cm` (`APR_NO`) USING BTREE,
  CONSTRAINT `apr_milestone_n_ibfk_1` FOREIGN KEY (`APR_NO`) REFERENCES `apr_a` (`APR_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apr_milestone_n`
--

LOCK TABLES `apr_milestone_n` WRITE;
/*!40000 ALTER TABLE `apr_milestone_n` DISABLE KEYS */;
INSERT INTO `apr_milestone_n` VALUES (1414910039,14149100,'test','10-06-2014'),(1414910651,14149107,'test','26-06-2014'),(1414910652,14149107,'test','19-06-2014'),(1414916234,14149162,'tse','09-06-2014'),(1415267198,14152672,'TEST','18-06-2014');
/*!40000 ALTER TABLE `apr_milestone_n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `apr_processing_time`
--

DROP TABLE IF EXISTS `apr_processing_time`;
/*!50001 DROP VIEW IF EXISTS `apr_processing_time`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `apr_processing_time` (
  `APR_NO` tinyint NOT NULL,
  `date1` tinyint NOT NULL,
  `date2` tinyint NOT NULL,
  `date3` tinyint NOT NULL,
  `name` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `apr_publication`
--

DROP TABLE IF EXISTS `apr_publication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apr_publication` (
  `A_P_NO` int(10) NOT NULL DEFAULT '0',
  `APR_NO` int(8) DEFAULT NULL,
  `detail` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`A_P_NO`),
  KEY `FK_APR_Pub` (`APR_NO`) USING BTREE,
  CONSTRAINT `apr_publication_ibfk_1` FOREIGN KEY (`APR_NO`) REFERENCES `apr_a` (`APR_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apr_publication`
--

LOCK TABLES `apr_publication` WRITE;
/*!40000 ALTER TABLE `apr_publication` DISABLE KEYS */;
/*!40000 ALTER TABLE `apr_publication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citizenship`
--

DROP TABLE IF EXISTS `citizenship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citizenship` (
  `citizenship` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`citizenship`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citizenship`
--

LOCK TABLES `citizenship` WRITE;
/*!40000 ALTER TABLE `citizenship` DISABLE KEYS */;
INSERT INTO `citizenship` VALUES ('AE','United Arab Emirates'),('AF','Afghanistan'),('AG','Antigua and Barbuda'),('AI','Anguilla'),('AL','Albania'),('AM','Armenia'),('AO','Angola'),('AQ','Antarctica'),('AR','Argentina'),('AS','American Samoa'),('AT','Austria'),('AW','Aruba'),('AZ','Azerbaijan'),('BA','Bosnia and Herzegovina'),('BB','Barbados'),('BD','Bangladesh'),('BE','Belgium'),('BF','Burkina Faso'),('BG','Bulgaria'),('BH','Bahrain'),('BI','Burundi'),('BJ','Benin'),('BM','Bermuda'),('BN','Brunei Darussalam'),('BO','Bolivia'),('BQ','Caribbean Netherlands'),('BR','Brazil'),('BS','Bahamas'),('BT','Bhutan'),('BV','Bouvet Island'),('BW','Botswana'),('BY','Belarus'),('BZ','Belize'),('CA','Canada'),('CC','Cocos (Keeling) Islands'),('CD','Congo, Democratic Republic of'),('CF','Central African Republic'),('CG','Congo'),('CH','Switzerland'),('CK','Cook Islands'),('CL','Chile'),('CM','Cameroon'),('CN','China'),('CO','Colombia'),('CR','Costa Rica'),('CU','Cuba'),('CV','Cape Verde'),('CX','Christmas Island'),('CY','Cyprus'),('CZ','Czech Republic'),('DE','Germany'),('DJ','Djibouti'),('DK','Denmark'),('DM','Dominica'),('DO','Dominican Republic'),('DZ','Algeria'),('EC','Ecuador'),('EE','Estonia'),('EG','Egypt'),('EH','Western Sahara'),('ER','Eritrea'),('ES','Spain'),('ET','Ethiopia'),('FI','Finland'),('FJ','Fiji'),('FK','Falkland Islands'),('FM','Micronesia, Federated States of'),('FO','Faroe Islands'),('FR','France'),('GA','Gabon'),('GB','United Kingdom'),('GD','Grenada'),('GE','Georgia'),('GF','French Guiana'),('GG','Guernsey'),('GH','Ghana'),('GI','Gibraltar'),('GL','Greenland'),('GM','Gambia'),('GN','Guinea'),('GP','Guadeloupe'),('GQ','Equatorial Guinea'),('GR','Greece'),('GS','South Georgia and the South Sandwich Islands'),('GT','Guatemala'),('GU','Guam'),('GW','Guinea-Bissau'),('GY','Guyana'),('HK','Hong Kong'),('HM','Heard and McDonald Islands'),('HN','Honduras'),('HR','Croatia'),('HT','Haiti'),('HU','Hungary'),('ID','Indonesia'),('IE','Ireland'),('IL','Israel'),('IM','Isle of Man'),('IN','India'),('IO','British Indian Ocean Territory'),('IQ','Iraq'),('IR','Iran'),('IS','Iceland'),('IT','Italy'),('JE','Jersey'),('JM','Jamaica'),('JO','Jordan'),('JP','Japan'),('KE','Kenya'),('KG','Kyrgyzstan'),('KH','Cambodia'),('KI','Kiribati'),('KM','Comoros'),('KN','Saint Kitts and Nevis'),('KP','North Korea'),('KR','South Korea'),('KW','Kuwait'),('KY','Cayman Islands'),('KZ','Kazakhstan'),('LA','Lao People\'s Democratic Republic'),('LB','Lebanon'),('LC','Saint Lucia'),('LI','Liechtenstein'),('LK','Sri Lanka'),('LR','Liberia'),('LS','Lesotho'),('LT','Lithuania'),('LU','Luxembourg'),('LV','Latvia'),('LY','Libya'),('MA','Morocco'),('MC','Monaco'),('MD','Moldova'),('ME','Montenegro'),('MF','Saint-Martin (France)'),('MG','Madagascar'),('MH','Marshall Islands'),('MK','Macedonia'),('ML','Mali'),('MM','Myanmar'),('MN','Mongolia'),('MO','Macau'),('MP','Northern Mariana Islands'),('MQ','Martinique'),('MR','Mauritania'),('MS','Montserrat'),('MT','Malta'),('MU','Mauritius'),('MV','Maldives'),('MW','Malawi'),('MX','Mexico'),('MY','Malaysia'),('MZ','Mozambique'),('NA','Namibia'),('NC','New Caledonia'),('NE','Niger'),('NF','Norfolk Island'),('NG','Nigeria'),('NI','Nicaragua'),('NL','The Netherlands'),('NO','Norway'),('NP','Nepal'),('NR','Nauru'),('NU','Niue'),('OM','Oman'),('PA','Panama'),('PE','Peru'),('PF','French Polynesia'),('PG','Papua New Guinea'),('PH','Philippines'),('PK','Pakistan'),('PL','Poland'),('PM','St. Pierre and Miquelon'),('PN','Pitcairn'),('PR','Puerto Rico'),('PS','Palestinian Territory, Occupied'),('PT','Portugal'),('PW','Palau'),('PY','Paraguay'),('QA','Qatar'),('RE','Reunion'),('RO','Romania'),('RS','Serbia'),('RU','Russian Federation'),('RW','Rwanda'),('SA','Saudi Arabia'),('SB','Solomon Islands'),('SC','Seychelles'),('SD','Sudan'),('SE','Sweden'),('SG','Singapore'),('SH','Saint Helena'),('SI','Slovenia'),('SJ','Svalbard and Jan Mayen Islands'),('SK','Slovakia (Slovak Republic)'),('SL','Sierra Leone'),('SM','San Marino'),('SN','Senegal'),('SO','Somalia'),('SR','Suriname'),('SS','South Sudan'),('ST','Sao Tome and Principe'),('SV','El Salvador'),('SX','Saint-Martin (Pays-Bas)'),('SY','Syria'),('SZ','Swaziland'),('TC','Turks and Caicos Islands'),('TD','Chad'),('TF','French Southern Territories'),('TG','Togo'),('TH','Thailand'),('TJ','Tajikistan'),('TK','Tokelau'),('TL','Timor-Leste'),('TM','Turkmenistan'),('TN','Tunisia'),('TO','Tonga'),('TR','Turkey'),('TT','Trinidad and Tobago'),('TV','Tuvalu'),('TW','Taiwan'),('TZ','Tanzania'),('UA','Ukraine'),('UG','Uganda'),('UM','United States Minor Outlying Islands'),('US','United States'),('UY','Uruguay'),('UZ','Uzbekistan'),('VA','Vatican'),('VC','Saint Vincent and the Grenadines'),('VE','Venezuela'),('VG','Virgin Islands (British)'),('VI','Virgin Islands (U.S.)'),('VN','Vietnam'),('VU','Vanuatu'),('WF','Wallis and Futuna Islands'),('WS','Samoa'),('YE','Yemen'),('YT','Mayotte'),('ZA','South Africa'),('ZM','Zambia'),('ZW','Zimbabwe');
/*!40000 ALTER TABLE `citizenship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoi`
--

DROP TABLE IF EXISTS `eoi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi` (
  `EOI_NO` int(8) NOT NULL,
  `App_NO` int(8) NOT NULL,
  `Sc_NO` int(8) NOT NULL,
  `proposed_program` varchar(16) DEFAULT NULL,
  `time_candidate` varchar(2) DEFAULT NULL,
  `commence_year` int(4) DEFAULT NULL,
  `commence_month` int(2) DEFAULT NULL,
  `scholarship_sup1` int(1) DEFAULT NULL,
  `scholarship_sup2` int(1) DEFAULT NULL,
  `research_reason` varchar(200) DEFAULT NULL,
  `submit_date` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`EOI_NO`),
  KEY `App_NO` (`App_NO`) USING BTREE,
  KEY `FK_Sc_E` (`Sc_NO`) USING BTREE,
  CONSTRAINT `eoi_ibfk_1` FOREIGN KEY (`App_NO`) REFERENCES `applicant` (`App_NO`),
  CONSTRAINT `eoi_ibfk_2` FOREIGN KEY (`Sc_NO`) REFERENCES `school` (`Sc_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoi`
--

LOCK TABLES `eoi` WRITE;
/*!40000 ALTER TABLE `eoi` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoi_academic`
--

DROP TABLE IF EXISTS `eoi_academic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi_academic` (
  `E_A_NO` int(10) NOT NULL DEFAULT '0',
  `EOI_NO` int(8) DEFAULT NULL,
  `Sc_NO` int(8) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`E_A_NO`),
  KEY `FK_Sc_Ac` (`Sc_NO`) USING BTREE,
  KEY `FK_EOI_Ac` (`EOI_NO`) USING BTREE,
  CONSTRAINT `eoi_academic_ibfk_1` FOREIGN KEY (`EOI_NO`) REFERENCES `eoi` (`EOI_NO`),
  CONSTRAINT `eoi_academic_ibfk_2` FOREIGN KEY (`Sc_NO`) REFERENCES `school` (`Sc_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoi_academic`
--

LOCK TABLES `eoi_academic` WRITE;
/*!40000 ALTER TABLE `eoi_academic` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoi_academic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoi_experience`
--

DROP TABLE IF EXISTS `eoi_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi_experience` (
  `E_E_NO` int(10) NOT NULL DEFAULT '0',
  `EOI_NO` int(8) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `institution` varchar(100) DEFAULT NULL,
  `year` int(5) DEFAULT NULL,
  PRIMARY KEY (`E_E_NO`),
  KEY `FK_EOI_Ex` (`EOI_NO`) USING BTREE,
  CONSTRAINT `eoi_experience_ibfk_1` FOREIGN KEY (`EOI_NO`) REFERENCES `eoi` (`EOI_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoi_experience`
--

LOCK TABLES `eoi_experience` WRITE;
/*!40000 ALTER TABLE `eoi_experience` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoi_experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoi_publication`
--

DROP TABLE IF EXISTS `eoi_publication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi_publication` (
  `E_P_NO` int(10) NOT NULL DEFAULT '0',
  `EOI_NO` int(8) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `year` int(5) DEFAULT NULL,
  PRIMARY KEY (`E_P_NO`),
  KEY `FK_EOI_Pu` (`EOI_NO`) USING BTREE,
  CONSTRAINT `eoi_publication_ibfk_1` FOREIGN KEY (`EOI_NO`) REFERENCES `eoi` (`EOI_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoi_publication`
--

LOCK TABLES `eoi_publication` WRITE;
/*!40000 ALTER TABLE `eoi_publication` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoi_publication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoi_qmap`
--

DROP TABLE IF EXISTS `eoi_qmap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi_qmap` (
  `E_QMAP_NO` int(10) NOT NULL DEFAULT '0',
  `EOI_NO` int(8) DEFAULT NULL,
  `qmap` varchar(200) DEFAULT NULL,
  `inst_nam_loc` varchar(200) DEFAULT NULL,
  `year` int(5) DEFAULT NULL,
  PRIMARY KEY (`E_QMAP_NO`),
  KEY `FK_EOI_Qm` (`EOI_NO`) USING BTREE,
  CONSTRAINT `eoi_qmap_ibfk_1` FOREIGN KEY (`EOI_NO`) REFERENCES `eoi` (`EOI_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoi_qmap`
--

LOCK TABLES `eoi_qmap` WRITE;
/*!40000 ALTER TABLE `eoi_qmap` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoi_qmap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoi_qualification`
--

DROP TABLE IF EXISTS `eoi_qualification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi_qualification` (
  `E_Q_NO` int(10) NOT NULL DEFAULT '0',
  `EOI_NO` int(8) DEFAULT NULL,
  `degree` varchar(50) DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  `year` int(5) DEFAULT NULL,
  `gpa` decimal(2,2) DEFAULT NULL,
  `completed_by_research` decimal(2,2) DEFAULT NULL,
  `institution` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`E_Q_NO`),
  KEY `FK_EOI_Qu` (`EOI_NO`) USING BTREE,
  CONSTRAINT `eoi_qualification_ibfk_1` FOREIGN KEY (`EOI_NO`) REFERENCES `eoi` (`EOI_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoi_qualification`
--

LOCK TABLES `eoi_qualification` WRITE;
/*!40000 ALTER TABLE `eoi_qualification` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoi_qualification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoi_rsh_interested`
--

DROP TABLE IF EXISTS `eoi_rsh_interested`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi_rsh_interested` (
  `Rf_NO` int(8) NOT NULL DEFAULT '0',
  `EOI_NO` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Rf_NO`,`EOI_NO`),
  KEY `FK_EOI_Ri` (`EOI_NO`) USING BTREE,
  CONSTRAINT `eoi_rsh_interested_ibfk_1` FOREIGN KEY (`EOI_NO`) REFERENCES `eoi` (`EOI_NO`),
  CONSTRAINT `eoi_rsh_interested_ibfk_2` FOREIGN KEY (`Rf_NO`) REFERENCES `research` (`Rf_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoi_rsh_interested`
--

LOCK TABLES `eoi_rsh_interested` WRITE;
/*!40000 ALTER TABLE `eoi_rsh_interested` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoi_rsh_interested` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoi_rsh_keyword`
--

DROP TABLE IF EXISTS `eoi_rsh_keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi_rsh_keyword` (
  `E_R_NO` int(10) NOT NULL DEFAULT '0',
  `EOI_NO` int(8) DEFAULT NULL,
  `keyword` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`E_R_NO`),
  KEY `FK_E_Rk` (`EOI_NO`) USING BTREE,
  CONSTRAINT `eoi_rsh_keyword_ibfk_1` FOREIGN KEY (`EOI_NO`) REFERENCES `eoi` (`EOI_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoi_rsh_keyword`
--

LOCK TABLES `eoi_rsh_keyword` WRITE;
/*!40000 ALTER TABLE `eoi_rsh_keyword` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoi_rsh_keyword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoi_scholarship`
--

DROP TABLE IF EXISTS `eoi_scholarship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi_scholarship` (
  `E_S_NO` int(10) NOT NULL DEFAULT '0',
  `EOI_NO` int(8) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `sponser` varchar(50) DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `duration` int(4) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`E_S_NO`),
  KEY `FK_EOI_Sc` (`EOI_NO`) USING BTREE,
  CONSTRAINT `eoi_scholarship_ibfk_1` FOREIGN KEY (`EOI_NO`) REFERENCES `eoi` (`EOI_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoi_scholarship`
--

LOCK TABLES `eoi_scholarship` WRITE;
/*!40000 ALTER TABLE `eoi_scholarship` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoi_scholarship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hdr_student`
--

DROP TABLE IF EXISTS `hdr_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hdr_student` (
  `Stud_NO` int(8) NOT NULL,
  `App_NO` int(8) DEFAULT NULL,
  `Sc_NO` int(8) DEFAULT NULL,
  `sub_school` int(8) DEFAULT NULL,
  `commencement_date` date DEFAULT NULL,
  `enrollment_type` varchar(10) DEFAULT NULL,
  `scholarship_type` varchar(100) DEFAULT NULL,
  `degree_enrolled` varchar(100) DEFAULT NULL,
  `p_supervisor` int(8) DEFAULT NULL,
  `c_supervisor` int(8) DEFAULT NULL,
  PRIMARY KEY (`Stud_NO`),
  KEY `FK_App_Std` (`App_NO`) USING BTREE,
  KEY `FK_SC_Std` (`Sc_NO`) USING BTREE,
  KEY `hdr_student_ibfk_3` (`sub_school`) USING BTREE,
  KEY `p_supervisor` (`p_supervisor`) USING BTREE,
  KEY `c_supervisor` (`c_supervisor`) USING BTREE,
  CONSTRAINT `hdr_student_ibfk_1` FOREIGN KEY (`App_NO`) REFERENCES `applicant` (`App_NO`),
  CONSTRAINT `hdr_student_ibfk_2` FOREIGN KEY (`Sc_NO`) REFERENCES `school` (`Sc_NO`),
  CONSTRAINT `hdr_student_ibfk_3` FOREIGN KEY (`sub_school`) REFERENCES `school` (`Sc_NO`),
  CONSTRAINT `hdr_student_ibfk_4` FOREIGN KEY (`p_supervisor`) REFERENCES `supervisor` (`Sup_NO`),
  CONSTRAINT `hdr_student_ibfk_5` FOREIGN KEY (`c_supervisor`) REFERENCES `supervisor` (`Sup_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hdr_student`
--

LOCK TABLES `hdr_student` WRITE;
/*!40000 ALTER TABLE `hdr_student` DISABLE KEYS */;
INSERT INTO `hdr_student` VALUES (12345678,12345678,6,1,'2014-05-15','full','new type','bachelor',333,12345677),(12345679,12345679,6,1,'2014-09-15','full','new type','bachelor',333,12345677);
/*!40000 ALTER TABLE `hdr_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mls_attendee`
--

DROP TABLE IF EXISTS `mls_attendee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_attendee` (
  `meeting_id` int(11) NOT NULL,
  `account_id` int(8) NOT NULL,
  `attendee_type` enum('candidate','supervisor') DEFAULT NULL,
  PRIMARY KEY (`meeting_id`,`account_id`),
  UNIQUE KEY `uq_ma` (`meeting_id`,`account_id`),
  CONSTRAINT `meeting_id` FOREIGN KEY (`meeting_id`) REFERENCES `mls_meeting` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_attendee`
--

LOCK TABLES `mls_attendee` WRITE;
/*!40000 ALTER TABLE `mls_attendee` DISABLE KEYS */;
INSERT INTO `mls_attendee` VALUES (1,333,'supervisor'),(1,12345678,'candidate'),(2,333,'supervisor'),(2,12345678,'candidate'),(3,333,'supervisor'),(3,12345678,'candidate'),(4,333,'supervisor'),(4,12345678,'candidate'),(5,333,'supervisor'),(5,12345678,'candidate');
/*!40000 ALTER TABLE `mls_attendee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mls_meeting`
--

DROP TABLE IF EXISTS `mls_meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_meeting` (
  `meeting_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `location` varchar(20) NOT NULL DEFAULT 'Murdoch',
  `commenced_time` varchar(10) NOT NULL,
  `adjourned_time` varchar(10) NOT NULL,
  `meeting_minutes` varchar(1000) DEFAULT NULL,
  `attendees` varchar(36) NOT NULL,
  `confirmation_status` enum('pending','confirmed','rejected') NOT NULL DEFAULT 'pending',
  `preparation_time` time NOT NULL DEFAULT '00:00:00',
  `chair` int(8) NOT NULL DEFAULT '0',
  `meeting_type` enum('candidate','panel') NOT NULL,
  `comments` varchar(100) DEFAULT '',
  PRIMARY KEY (`meeting_id`),
  UNIQUE KEY `meeting_id_UNIQUE` (`meeting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_meeting`
--

LOCK TABLES `mls_meeting` WRITE;
/*!40000 ALTER TABLE `mls_meeting` DISABLE KEYS */;
INSERT INTO `mls_meeting` VALUES (1,'2014-09-17','ECL 2.039','12:00','15:00','Today.....\r\n...........\r\n..........\r\n...........','12345678,333','confirmed','00:00:00',0,'candidate',''),(2,'2014-09-17','ECL 2.046','12:00','15:00','','12345678,333','confirmed','00:00:00',0,'candidate',''),(3,'2014-09-17','ECL 2.039','12:00','15:00','','12345678,333','confirmed','00:00:00',0,'candidate',''),(4,'2014-09-17','ECL 2.046','12:00','15:00','','12345678,333','confirmed','00:00:00',0,'candidate',''),(5,'2014-09-17','ECL 2.046','12:00','15:00','','12345678,333','confirmed','00:00:12',0,'candidate','');
/*!40000 ALTER TABLE `mls_meeting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `research`
--

DROP TABLE IF EXISTS `research`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `research` (
  `Rf_NO` int(8) NOT NULL DEFAULT '0',
  `decription` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Rf_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `research`
--

LOCK TABLES `research` WRITE;
/*!40000 ALTER TABLE `research` DISABLE KEYS */;
/*!40000 ALTER TABLE `research` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school` (
  `Sc_NO` int(8) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `decription` varchar(200) DEFAULT NULL,
  `dean` int(8) DEFAULT NULL,
  PRIMARY KEY (`Sc_NO`),
  KEY `dean` (`dean`) USING BTREE,
  CONSTRAINT `school_ibfk_1` FOREIGN KEY (`dean`) REFERENCES `staff_account` (`S_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school`
--

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
INSERT INTO `school` VALUES (1,'Sir Walter Murdoch School of Public Policy and Int','The Sir Walter Murdoch School of Public Policy and International Affairs offers students a unique opportunity to engage with big policy issues, develop high-level skills and build career opportunities',NULL),(2,'School of Engineering and Information Technology','The School of Engineering and Information Technology is an innovative faculty where students can pursue their studies in a stimulating learning environment. Our school features world-class facilities ',NULL),(3,'School of Management and Governance','The Murdoch School of Management & Governance offers courses in the principal areas of commerce and social sciences. The School has over 100 highly qualified and dedicated staff who mentor over 7,250 ',NULL),(4,'School of Psychology and Exercise Science','The School of Psychology and Exercise Science prepares students for careers in the mental and physical health sectors. We offer a range of accredited undergraduate and postgraduate courses in Psycholo',NULL),(5,'School of Health Professions','The School of Health Professions is comprised of Nursing and Midwifery, Chiropractic and Counselling disciplines, with students completing undergraduate and postgraduate courses at both the South Stre',NULL),(6,'School of Arts','The School offers a broad range of courses in creative arts, media and communication, social sciences and humanities at both undergraduate and postgraduate level',666),(7,'School of Education','The School of Education is recognised locally, nationally and internationally as a centre of excellence in its teaching, research and professional services. The School is committed to social justice a',NULL),(8,'School of Law','Murdoch Law School is Western Australia',NULL),(9,'School of Veterinary and Life Sciences','Students in the School can pursue a variety of exciting disciplines that relate to the science of life on our planet, spanning the study of animals, plants, microorganisms, the environment, chemical p',NULL);
/*!40000 ALTER TABLE `school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_account`
--

DROP TABLE IF EXISTS `staff_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_account` (
  `S_NO` int(8) NOT NULL DEFAULT '0',
  `password` varchar(32) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `last_login` date NOT NULL DEFAULT '0000-00-00',
  `salutation` varchar(10) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`S_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_account`
--

LOCK TABLES `staff_account` WRITE;
/*!40000 ALTER TABLE `staff_account` DISABLE KEYS */;
INSERT INTO `staff_account` VALUES (333,'5f4dcc3b5aa765d61d8327deb882cf99','Sup','2014-09-17','Mr','Steven','Spielberg','crsolutions333@gmail.com'),(666,'5f4dcc3b5aa765d61d8327deb882cf99','Dean','2014-06-09','Ms','Angelina','Jolie','crsolutions333@gmail.com'),(12345677,'5f4dcc3b5aa765d61d8327deb882cf99','Sup','2014-06-02','Mr','John','Fang','crsolutions333@gmail.com'),(12345678,'5f4dcc3b5aa765d61d8327deb882cf99','GRO','2014-09-14','Mr','Joseph','Mathias','crsolutions333@gmail.com'),(12345679,'5f4dcc3b5aa765d61d8327deb882cf99','Dean','2014-06-02','Mr','Mark','Fang','crsolutions333@gmail.com');
/*!40000 ALTER TABLE `staff_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sup_rsh_field`
--

DROP TABLE IF EXISTS `sup_rsh_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sup_rsh_field` (
  `Sup_NO` int(8) NOT NULL DEFAULT '0',
  `Rf_NO` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Sup_NO`,`Rf_NO`),
  KEY `FK_Rf_Rf` (`Rf_NO`) USING BTREE,
  CONSTRAINT `sup_rsh_field_ibfk_1` FOREIGN KEY (`Rf_NO`) REFERENCES `research` (`Rf_NO`),
  CONSTRAINT `sup_rsh_field_ibfk_2` FOREIGN KEY (`Sup_NO`) REFERENCES `supervisor` (`Sup_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sup_rsh_field`
--

LOCK TABLES `sup_rsh_field` WRITE;
/*!40000 ALTER TABLE `sup_rsh_field` DISABLE KEYS */;
/*!40000 ALTER TABLE `sup_rsh_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sup_std`
--

DROP TABLE IF EXISTS `sup_std`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sup_std` (
  `Sup_NO` int(8) NOT NULL DEFAULT '0',
  `Std_NO` int(8) NOT NULL DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `sup_percentage` decimal(2,2) DEFAULT NULL,
  PRIMARY KEY (`Sup_NO`,`Std_NO`),
  KEY `FK_Std_Ss` (`Std_NO`) USING BTREE,
  CONSTRAINT `sup_std_ibfk_1` FOREIGN KEY (`Std_NO`) REFERENCES `hdr_student` (`Stud_NO`),
  CONSTRAINT `sup_std_ibfk_2` FOREIGN KEY (`Sup_NO`) REFERENCES `supervisor` (`Sup_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sup_std`
--

LOCK TABLES `sup_std` WRITE;
/*!40000 ALTER TABLE `sup_std` DISABLE KEYS */;
INSERT INTO `sup_std` VALUES (333,12345678,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sup_std` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supervisor`
--

DROP TABLE IF EXISTS `supervisor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supervisor` (
  `Sup_NO` int(8) NOT NULL DEFAULT '0',
  `Sc_NO` int(8) DEFAULT NULL,
  `rsh_keyword1` varchar(20) DEFAULT NULL,
  `rsh_keyword2` varchar(20) DEFAULT NULL,
  `rsh_keyword3` varchar(20) DEFAULT NULL,
  `rsh_keyword4` varchar(20) DEFAULT NULL,
  `rsh_keyword5` varchar(20) DEFAULT NULL,
  `highest_qualification` varchar(200) DEFAULT NULL,
  `available` bit(1) DEFAULT b'1',
  PRIMARY KEY (`Sup_NO`),
  KEY `FK_Sc_Sup` (`Sc_NO`) USING BTREE,
  CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`Sup_NO`) REFERENCES `staff_account` (`S_NO`),
  CONSTRAINT `supervisor_ibfk_2` FOREIGN KEY (`Sc_NO`) REFERENCES `school` (`Sc_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supervisor`
--

LOCK TABLES `supervisor` WRITE;
/*!40000 ALTER TABLE `supervisor` DISABLE KEYS */;
INSERT INTO `supervisor` VALUES (333,6,NULL,NULL,NULL,NULL,NULL,NULL,''),(12345677,2,NULL,NULL,NULL,NULL,NULL,NULL,'');
/*!40000 ALTER TABLE `supervisor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `apr_processing_time`
--

/*!50001 DROP TABLE IF EXISTS `apr_processing_time`*/;
/*!50001 DROP VIEW IF EXISTS `apr_processing_time`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `apr_processing_time` AS select `apr_a`.`APR_NO` AS `APR_NO`,`apr_a`.`date_submitted` AS `date1`,`apr_b`.`date_submitted` AS `date2`,`apr_c`.`date_submitted` AS `date3`,`school`.`name` AS `name` from ((((`apr_a` join `apr_b`) join `apr_c`) join `hdr_student`) join `school`) where ((`apr_b`.`APR_NO` = `apr_a`.`APR_NO`) and (`apr_c`.`APR_NO` = `apr_b`.`APR_NO`) and (`hdr_student`.`Stud_NO` = `apr_a`.`Std_NO`) and (`school`.`Sc_NO` = `hdr_student`.`Sc_NO`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-17 13:39:29
