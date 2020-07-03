CREATE TABLE `pm_project_version_file` (
  `prjvf_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prjv_id` bigint(20) unsigned NOT NULL,
  `prjvf_name` varchar(255) NOT NULL DEFAULT '',
  `prjvf_link` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`prjvf_id`),
  KEY `fk_project_version_file_project_version` (`prjv_id`),
  CONSTRAINT `fk_project_version_file_project_version` FOREIGN KEY (`prjv_id`) REFERENCES `pm_project_version` (`prjv_id`)
);