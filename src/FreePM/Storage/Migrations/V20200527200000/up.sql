CREATE TABLE `pm_desk` (
  `desk_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_id` bigint(20) unsigned NOT NULL,
  `grp_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `desk_name` varchar(80) NOT NULL DEFAULT '',
  `desk_desc` text DEFAULT NULL,
  `desk_from` timestamp NULL DEFAULT NULL,
  `desk_to` timestamp NULL DEFAULT NULL,
  `desk_status` enum('PENDING','CLOSED','OPEN') NOT NULL DEFAULT 'PENDING',
  PRIMARY KEY (`desk_id`),
  KEY `fk_desk_broker` (`brk_id`),
  KEY `fk_desk_user` (`user_id`),
  KEY `fk_desk_group` (`grp_id`)
);
CREATE TABLE `pm_project` (
  `prj_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_id` bigint(20) unsigned NOT NULL,
  `grp_id` bigint(20) unsigned NOT NULL,
  `prj_name` varchar(80) NOT NULL DEFAULT '',
  `prj_code` varchar(20) NOT NULL DEFAULT '',
  `prj_type` enum('APPLICATION','MODULE','EXECUTABLE','TOOL','OTHER','WEBAPP') NOT NULL DEFAULT 'OTHER',
  `prj_from` timestamp NULL DEFAULT NULL,
  `prj_to` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`prj_id`),
  KEY `fk_project_broker` (`brk_id`),
  KEY `fk_project_group` (`grp_id`)
);
CREATE TABLE `pm_status` (
  `sta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_id` bigint(20) unsigned NOT NULL,
  `grp_id` bigint(20) unsigned NOT NULL,
  `sta_name` varchar(80) NOT NULL DEFAULT '',
  `sta_type` enum('CLOSED','PENDING','OK','REFUSED') NOT NULL DEFAULT 'PENDING',
  PRIMARY KEY (`sta_id`),
  KEY `fk_status_broker` (`brk_id`),
  KEY `fk_status_group` (`grp_id`)
);
CREATE TABLE `pm_project_version` (
  `prjv_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_id` bigint(20) unsigned NOT NULL,
  `prj_id` bigint(20) unsigned NOT NULL,
  `prjv_type` enum('REAL','TEST','BETA','ALPHA','DEV') NOT NULL DEFAULT 'DEV',
  `prjv_version` varchar(20) NOT NULL DEFAULT '',
  `prjv_from` timestamp NULL DEFAULT NULL,
  `prjv_tp` timestamp NULL DEFAULT NULL,
  `prjv_beta_test` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`prjv_id`),
  KEY `fk_project_version_broker` (`brk_id`),
  KEY `fk_project_version_project` (`prj_id`),
  CONSTRAINT `fk_project_version_project` FOREIGN KEY (`prj_id`) REFERENCES `pm_project` (`prj_id`)
);
CREATE TABLE `pm_feature` (
  `feat_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_id` bigint(20) unsigned NOT NULL,
  `grp_id` bigint(20) unsigned NOT NULL,
  `prj_id` bigint(20) unsigned NOT NULL,
  `feat_ts` timestamp NULL DEFAULT NULL,
  `feat_short` varchar(255) DEFAULT '',
  `feat_desc` longtext DEFAULT NULL,
  `feat_from` timestamp NULL DEFAULT NULL,
  `feat_to` timestamp NULL DEFAULT NULL,
  `sta_id` bigint(20) unsigned NOT NULL,
  `sta_priority` tinyint(4) NOT NULL DEFAULT 9,
  PRIMARY KEY (`feat_id`),
  KEY `fk_feature_broker` (`brk_id`),
  KEY `fk_feature_group` (`grp_id`),
  KEY `fk_feature_project` (`prj_id`),
  KEY `fk_feature_status` (`sta_id`),
  CONSTRAINT `fk_feature_project` FOREIGN KEY (`prj_id`) REFERENCES `pm_project` (`prj_id`),
  CONSTRAINT `fk_feature_status` FOREIGN KEY (`sta_id`) REFERENCES `pm_status` (`sta_id`)
);
CREATE TABLE `pm_desk_col` (
  `deco_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_id` bigint(20) unsigned NOT NULL,
  `grp_id` bigint(20) unsigned NOT NULL,
  `desk_id` bigint(20) unsigned NOT NULL,
  `deco_name` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`deco_id`),
  KEY `fk_desk_col_desk` (`desk_id`),
  KEY `fk_desk_col_broker` (`brk_id`),
  KEY `fk_desk_col_group` (`grp_id`),
  CONSTRAINT `fk_desk_col_desk` FOREIGN KEY (`desk_id`) REFERENCES `pm_desk` (`desk_id`)
);
CREATE TABLE `pm_desk_col_feature` (
  `dcf_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `deco_id` bigint(20) unsigned NOT NULL,
  `feat_id` bigint(20) unsigned NOT NULL,
  `dcf_position` int(11) NOT NULL,
  PRIMARY KEY (`dcf_id`),
  KEY `fk_desk_col_feature_feature` (`feat_id`),
  KEY `fk_desk_col_feature_desk_col` (`deco_id`),
  CONSTRAINT `fk_desk_col_feature_desk_col` FOREIGN KEY (`deco_id`) REFERENCES `pm_desk_col` (`deco_id`),
  CONSTRAINT `fk_desk_col_feature_feature` FOREIGN KEY (`feat_id`) REFERENCES `pm_feature` (`feat_id`)
);