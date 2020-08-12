CREATE TABLE `pm_project_category_issue` (
  `prjci_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la catégorie d''incident pour un projet',
  `prj_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant du projet',
  `prjci_name` varchar(32) DEFAULT NULL COMMENT 'Libellé de la catégorie d''incident du projet',
  PRIMARY KEY (`prjci_id`),
  KEY `fk_project_category_issue_project` (`prj_id`),
  CONSTRAINT `fk_project_category_issue_project` FOREIGN KEY (`prj_id`) REFERENCES `pm_project` (`prj_id`)
);

ALTER TABLE `pm_feature` 
CHANGE `feat_id` `feat_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la demande', 
CHANGE `prj_id` `prj_id` BIGINT(20) UNSIGNED NOT NULL COMMENT 'Identifiant du projet', 
ADD COLUMN `prjv_id` BIGINT(20) UNSIGNED NULL COMMENT 'Identifiant de la version du projet' AFTER `prj_id`, 
ADD COLUMN `user_id` BIGINT(20) NULL COMMENT 'Identifiant de l\'utilisateur qui a initié la demande' AFTER `prjv_id`,
ADD COLUMN `jvs_user_id` BIGINT(20) NULL COMMENT 'Identifiant de la personne qui va traiter la demande' AFTER `user_id`,
CHANGE `sta_id` `sta_id` BIGINT(20) UNSIGNED NOT NULL COMMENT 'Identifiant de l\'état' AFTER `jvs_user_id`, 
ADD COLUMN `feat_parent_id` BIGINT(20) NULL COMMENT 'Identifiant du travail parent' AFTER `sta_id`, 
CHANGE `feat_short` `feat_short` VARCHAR(255) CHARSET utf8 COLLATE utf8_general_ci DEFAULT '' NULL COMMENT 'Libellé', 
CHANGE `feat_desc` `feat_desc` LONGTEXT NULL COMMENT 'Description', 
CHANGE `feat_ts` `feat_ts` TIMESTAMP NULL COMMENT 'Date de modification' AFTER `feat_desc`, 
CHANGE `feat_from` `feat_from` TIMESTAMP NULL COMMENT 'Date de création', 
ADD COLUMN `feat_deadline` TIMESTAMP NULL COMMENT 'Date d\'échéance' AFTER `feat_from`,    
CHANGE `feat_to` `feat_to` TIMESTAMP NULL COMMENT 'Date de fin (réalisation - refus - rejet)',    
CHANGE `feat_priority` `feat_priority` TINYINT(4) DEFAULT 9 NOT NULL COMMENT 'Priorité de la demande (de 1 à 9)',    
ADD COLUMN `feat_public` INT(1) NULL COMMENT 'Demande visible depuis les clients' AFTER `feat_priority`,    
ADD COLUMN `feat_comm` LONGTEXT NULL COMMENT 'Commentaire (Motif du refus ou du rejet - Texte réalisation - Texte technique - Texte fonctionnel)' AFTER `feat_public`,    
ADD COLUMN `feat_comm_priv` LONGTEXT NULL COMMENT 'Commentaire privé' AFTER `feat_comm`,    
ADD COLUMN `feat_workload` INT(11) NULL COMMENT 'Charge estimée en Heure' AFTER `feat_comm_priv`,    
ADD COLUMN `feat_mail` INT(1) NULL COMMENT 'Envoi d\'un mail' AFTER `feat_workload`, 
ADD COLUMN `nova_id` INT(11) NULL COMMENT 'Identifiant du travail dans Novatime' AFTER `feat_mail`, 
ADD COLUMN `feat_note_dev` ENUM('NONE','RISKY','IMPOSSIBLE','COMPLEX','STANDARD') NOT NULL AFTER `nova_id`, 
ADD COLUMN `feat_note_hl` ENUM('NONE','INCOHERENT','RECURRENT_LOW','RECURRENT_HIGH','LEGAL','INCORRECT_BEHAVIOUR','NOT_REPRODUCED_ERROR') NOT NULL AFTER `feat_note_dev`,    
ADD COLUMN `feat_plan_form` TIMESTAMP NULL COMMENT 'Date de début de planification' AFTER `feat_note_hl`,    
ADD COLUMN `feat_plan_to` TIMESTAMP NULL COMMENT 'Fate de fin de planification' AFTER `feat_plan_form`,
ADD KEY `fk_feature_user` (`user_id`), 
ADD KEY `fk_feature_jvs_user` (`jvs_user_id`), 
ADD KEY `fk_feature_parent` (`feat_parent_id`), 
ADD CONSTRAINT `fk_feature_project_version` 
FOREIGN KEY (`prjv_id`) REFERENCES `pm_project_version`(`prjv_id`);

CREATE TABLE `pm_feature_histo` (
  `feath_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du suivi de la demande',
  `feat_id` bigint(20) unsigned NOT NULL COMMENT 'Identifiant de la demande',
  `sta_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant de l''état de la demande',
  `feath_ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date de la modification',
  `feath_name` longtext DEFAULT NULL COMMENT 'Libellé de la modification',
  PRIMARY KEY (`feath_id`),
  KEY `fk_feature_histo_feature` (`feat_id`),
  KEY `fk_feature_histo_status` (`sta_id`),
  CONSTRAINT `fk_feature_histo_feature` FOREIGN KEY (`feat_id`) REFERENCES `pm_feature` (`feat_id`),
  CONSTRAINT `fk_feature_histo_status` FOREIGN KEY (`sta_id`) REFERENCES `pm_status` (`sta_id`)
);

CREATE TABLE `pm_issue_category` (
  `issc_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la catégorie d''incident',
  `issc_name` varchar(32) NOT NULL COMMENT 'Nom',
  PRIMARY KEY (`issc_id`)
);

CREATE TABLE `pm_issue` (
  `iss_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''incident',
  `grp_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant du Client',
  `user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant de l''interlocuteur Client',
  `current_user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant de l''interlocuteur Client courant',
  `jvs_user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant de l''interlocuteur JVS',
  `jvs_current_user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant de l''interlocuteur JVS courant',
  `close_user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant de l''interlocuteur Client qui a fermé l''incident',
  `close_jvs_user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant de l''interlocuteur JVS qui a fermé l''incident',
  `prj_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant du projet concerné',
  `issc_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant de la catégorie de l''incident',
  `prjci_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant de la catégorie d''incident du projet',
  `iss_from` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date de création',
  `iss_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date de la dernière intervention',
  `iss_deadline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date de réponse attendue',
  `iss_to` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date de fermeture',
  `iss_status` enum('WAIT_JVS','WAIT_USER','WAIT_CLOSE','CLOSE_JVS','CLOSE_USER') DEFAULT NULL COMMENT 'Etat de l''incident',
  `iss_nb_call` int(6) DEFAULT NULL COMMENT 'Nombre d''appel',
  `iss_priority` enum('MINOR','ANNOYING','CRITICAL') NOT NULL COMMENT 'Priorité Bénin, Gênant, Bloquant',
  `iss_feature` int(1) DEFAULT NULL COMMENT 'Incident découlant sur une demande',
  `iss_duration` int(11) DEFAULT NULL COMMENT 'Durée totale du traitement de l''incident',
  PRIMARY KEY (`iss_id`),
  KEY `fk_issue_user` (`user_id`),
  KEY `fk_issue_current_user` (`current_user_id`),
  KEY `fk_issue_jvs_user` (`jvs_user_id`),
  KEY `fk_issue_jvs_current_user` (`jvs_current_user_id`),
  KEY `fk_issue_close_user` (`close_user_id`),
  KEY `fk_issue_close_jvs_user` (`close_jvs_user_id`),
  KEY `fk_issue_group` (`grp_id`),
  KEY `fk_issue_project` (`prj_id`),
  KEY `fk_issue_issue_category` (`issc_id`),
  KEY `fk_issue_project_category_issue` (`prjci_id`),
  CONSTRAINT `fk_issue_issue_category` FOREIGN KEY (`issc_id`) REFERENCES `pm_issue_category` (`issc_id`),
  CONSTRAINT `fk_issue_project` FOREIGN KEY (`prj_id`) REFERENCES `pm_project` (`prj_id`),
  CONSTRAINT `fk_issue_project_category_issue` FOREIGN KEY (`prjci_id`) REFERENCES `pm_project_category_issue` (`prjci_id`)
);

CREATE TABLE `pm_issue_histo` (
  `issh_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''intervention',
  `iss_id` bigint(20) unsigned NOT NULL COMMENT 'Identifiant de l''incident',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'Identifiant de l''interlocuteur Client',
  `jvs_user_id` bigint(20) unsigned NOT NULL COMMENT 'Identifiant de l''interlocuteur JVS',
  `jvs_next_user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Identifiant de l''interlocuteur JVS à qui va être transféré l''incident',
  `issh_from` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date du début de l''intervention',
  `issh_to` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date de fin de l''intervention',
  `issh_comm` longtext DEFAULT NULL COMMENT 'Commentaire (Texte public)',
  `issh_comm_priv` longtext DEFAULT NULL COMMENT 'Texte privé',
  `issh_status` enum('WAIT_JVS','WAIT_USER','WAIT_CLOSE','CLOSE_JVS','CLOSE_USER') DEFAULT NULL COMMENT 'Etat',
  `issh_duration` int(11) DEFAULT NULL COMMENT 'Durée en minutes',
  `issh_deadline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date de réponse attendue',
  `issh_mail` int(1) DEFAULT NULL COMMENT 'Envoi d''un mail (0/1)',
  `issh_way` enum('IN','OUT') DEFAULT NULL COMMENT 'Sans de l''intervention (IN : Client -> JVS ; OUT : JVS -> Client)',
  PRIMARY KEY (`issh_id`),
  KEY `fk_issue_histo_user` (`user_id`),
  KEY `fk_issue_histo_jvs_user` (`jvs_user_id`),
  KEY `fk_issue_histo_jvs_next_user` (`jvs_next_user_id`),
  KEY `fk_issue_histo_issue` (`iss_id`),
  CONSTRAINT `fk_issue_histo_issue` FOREIGN KEY (`iss_id`) REFERENCES `pm_issue` (`iss_id`)
);
