ALTER TABLE `pm_project_version` CHANGE `prjv_tp` `prjv_to` timestamp NULL DEFAULT NULL;

CREATE UNIQUE INDEX `ix_project_version` ON `pm_project_version` (`prj_id`,`prjv_version`);

CREATE UNIQUE INDEX `ix_project_name` ON `pm_project` (`prj_name`);
CREATE UNIQUE INDEX `ix_project_code` ON `pm_project` (`prj_code`);