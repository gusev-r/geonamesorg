CREATE TABLE `alternate_names` (
  `alternateNameId` int(11) NOT NULL,
  `geonameid` int(11) DEFAULT NULL,
  `isolanguage` varchar(7) DEFAULT NULL,
  `alternate_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `isPreferredName` int(1) DEFAULT NULL,
  `isShortName` int(1) DEFAULT NULL,
  `isColloquial` int(1) DEFAULT NULL,
  `isHistoric` int(1) DEFAULT NULL,
  PRIMARY KEY (`alternateNameId`)
) ENGINE=InnoDB;

CREATE TABLE `geonames` (
  `geonameid` int(10) unsigned NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `asciiname` varchar(200) DEFAULT NULL,
  `alternatenames` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `feature_class` char(1) DEFAULT NULL,
  `feature_code` varchar(10) DEFAULT NULL,
  `country_code` varchar(2) DEFAULT NULL,
  `cc2` varchar(200) DEFAULT NULL,
  `admin1_code` varchar(20) DEFAULT NULL,
  `admin2_code` varchar(80) DEFAULT NULL,
  `admin3_code` varchar(20) DEFAULT NULL,
  `admin4_code` varchar(20) DEFAULT NULL,
  `population` bigint(8) DEFAULT NULL,
  `elevation` int(11) DEFAULT NULL,
  `dem` int(11) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `modification` date DEFAULT NULL,
  PRIMARY KEY (`geonameid`)
) ENGINE=InnoDB;