<?php
namespace FreePM\Command;

/**
 * FreePM commands
 *
 * @author jeromeklam
 */
class Import
{

    /**
     * Tableau des projets
     * @var array
     */
    protected static $mt_projects = null;
    protected static $mt_versions = null;
    protected static $mt_groups = null;
    protected static $mt_users = null;

    /**
     * Recherche des projets existants
     *
     * @param \PDO $p_cnxWebBO
     *
     * àreturn void
     */
    protected function loadInMemory($p_cnxWebBO)
    {
        /**
         * Recherche des projets existants
         */
        if (self::$mt_projects === null) {
            self::$mt_projects = [];
            $queryProjects = $cnxWebBO->prepare("SELECT * FROM pm_project");
            $queryProjects->execute();
            while ($rowProject = $queryProjects->fetch(\PDO::FETCH_OBJ)) {
                self::$mt_projects[$rowProject->prj_code] = $rowProject->prj_id;
                /**
                 * Recherche des versions de projets existants
                 */
                if (self::$mt_versions === null) {
                    self::$mt_versions = [];
                    $queryVersions = $cnxWebBO->prepare("SELECT * FROM pm_project_version WHERE prj_id = " + $rowProject->prj_id);
                    $queryVersions->execute();
                    while ($rowVersion = $queryVersions->fetch(\PDO::FETCH_OBJ)) {
                        self::$mt_versions[$rowProject->prj_code.'@'.$rowVersion->prjv_version] = $rowVersion->prjv_id;
                    }
                }
            }
        }

        /**
         * Recherche des clients existants
         */
        if (self::$mt_groups === null) {
            self::$mt_groups = [];
            $queryGroups = $cnxWebBO->prepare("SELECT * FROM sso_group");
            $queryGroups->execute();
            while ($rowGroup = $queryGroups->fetch(\PDO::FETCH_OBJ)) {
                self::$mt_groups[$rowGroup->grp_extern_code] = $rowGroup->grp_id;
            }
        }

        /**
         * Recherche des utilisateurs existants
         */
        if (self::$mt_users === null) {
            self::$mt_users = [];
            $queryUsers = $cnxWebBO->prepare("SELECT * FROM pm_user");
            $users = [];
            $queryUsers->execute();
            while ($rowUser = $queryUsers->fetch(\PDO::FETCH_OBJ)) {
                self::$mt_users[$rowUser->user_extern_code] = $rowUser->user_id;
            }
        }
    }

    /**
     * Get new project id
     *
     * @param mixed $p_gic_code   Code Application GIC
     *
     * @return number | null
     */
    protected function getNewProjectId($p_gic_code)
    {
        if (array_key_exists($p_gic_code, self::$mt_projects)) {
            return intval(self::$mt_projects[$p_gic_code]);
        }
        return null;
    }

    /**
     * Get new version id
     *
     * @param mixed $p_gic_code   Code Application GIC
     *
     * @return number | null
     */
    protected function getNewVersionId($p_gic_prj, $p_gic_vers)
    {
        $prjVers = $p_gic_prj.'@'.$p_gic_vers;
        if (array_key_exists($prjVers, self::$mt_versions)) {
            return intval(self::$mt_versions[$prjVers]);
        }
        return null;
    }

    /**
     * Get new group id
     *
     * @param mixed $p_gic_id   Identifiant GIC
     *
     * @return number | null
     */
    protected function getNewGroupId($p_gic_id)
    {
        if (array_key_exists($p_gic_id, self::$mt_groups)) {
            return intval(self::$mt_groups[$p_gic_id]);
        }
        return null;
    }

    /**
     * Get new user id
     *
     * @param mixed $p_gic_id   Identifiant GIC
     *
     * @return number | null
     */
    protected function getNewUserId($p_gic_id)
    {
        if (array_key_exists($p_gic_id, self::$mt_users)) {
            return intval(self::$mt_users[$p_gic_id]);
        }
        return null;
    }


    public function removeBeforeImport(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
        ) {
            $p_output->write("Nettoyage", true);
            $sso      = \FreeFW\DI\DI::getShared('sso');
            $brokerId = $sso->getBrokerId();
            $p_output->write("Broker : " . $brokerId, true);
            $storage = \FreeFW\DI\DI::getShared('Storage::default');
            $cnxWebBO = $storage->getProvider();
            if ($brokerId != '4') {
                die('Wrong brokerId !');
            }
            //
            $query = $cnxWebBO->exec("DELETE FROM sso_broker_session WHERE 1=1");
            $query = $cnxWebBO->exec("DELETE FROM sso_session WHERE 1=1");
            $query = $cnxWebBO->exec("DELETE FROM sso_broker WHERE brk_id > 9");
            $query = $cnxWebBO->exec("DELETE FROM sso_group_user WHERE grp_id > 5");
            $query = $cnxWebBO->exec("DELETE FROM sso_group_user WHERE user_id > 2");
            $query = $cnxWebBO->exec("DELETE FROM sso_user_broker WHERE brk_id > 9");
            $query = $cnxWebBO->exec("DELETE FROM sso_user_broker WHERE user_id > 2");
            $query = $cnxWebBO->exec("DELETE FROM sso_user_token WHERE user_id > 2");
            $query = $cnxWebBO->exec("DELETE FROM sso_password_token WHERE user_id > 2");
            $query = $cnxWebBO->exec("DELETE FROM pm_desk_col_feature");
            $query = $cnxWebBO->exec("DELETE FROM pm_desk_col");
            $query = $cnxWebBO->exec("DELETE FROM pm_desk");
            $query = $cnxWebBO->exec("DELETE FROM pm_feature");
            $query = $cnxWebBO->exec("DELETE FROM pm_status WHERE brk_id = " . $brokerId);
            $query = $cnxWebBO->exec("DELETE FROM pm_project_version_file WHERE prjv_id = (SELECT prjv_id FROM pm_project_version WHERE brk_id = " . $brokerId . ")");
            $query = $cnxWebBO->exec("DELETE FROM pm_project_version WHERE brk_id = " . $brokerId);
            $query = $cnxWebBO->exec("DELETE FROM pm_project WHERE grp_id > 5");
            $query = $cnxWebBO->exec("UPDATE sso_group SET grp_parent_id = null WHERE grp_id > 5");
            $query = $cnxWebBO->exec("UPDATE sso_group SET grp_realm_id = null WHERE grp_id > 5");
            $query = $cnxWebBO->exec("DELETE FROM sso_group WHERE grp_id > 5");
            $query = $cnxWebBO->exec("DELETE FROM sso_user WHERE user_id > 2");
            $query = $cnxWebBO->exec("DELETE FROM sso_autologin_cookie WHERE user_id > 2");
            $query = $cnxWebBO->exec("DELETE FROM sso_group_type WHERE grpt_id > 5");
            $query = $cnxWebBO->exec("DELETE FROM sso_job_function WHERE fct_id > 5");
            $query = $cnxWebBO->exec("DELETE FROM sys_alert");
            $query = $cnxWebBO->exec("DELETE FROM sys_history");
            $query = $cnxWebBO->exec("DELETE FROM sys_message");
            $query = $cnxWebBO->exec("DELETE FROM sys_notification");
            $query = $cnxWebBO->exec("DELETE FROM sys_rate");
            //
            die;
            //
            $p_output->write("Fin du nettoyage BO", true);
    }

    /**
     * Suppression des données pour les demandes
     *
     * @param \PDO $p_cnxWebBO
     *
     * @return void
     */
    protected function removePmFeatures($p_cnxWebBO)
    {
        /**
         *
         */
        $query = $p_cnxWebBO->exec("DELETE FROM pm_feature");
        $query = $p_cnxWebBO->exec("DELETE FROM pm_feature_histo");
    }

    /**
     * Suppression des données pour les incidents
     *
     * @param \PDO $p_cnxWebBO
     *
     * @return void
     */
    protected function removePmIssues($p_cnxWebBO)
    {
        /**
         *
         */
        $query = $p_cnxWebBO->exec("DELETE FROM pm_issue_histo");
        $query = $p_cnxWebBO->exec("DELETE FROM pm_issue");
        $query = $p_cnxWebBO->exec("DELETE FROM pm_issue_category");
    }

    /**
     * Import GIC
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     */
    public function importGIC(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $defaultFunction  = 4;
        $typeclientFilter = [2, 4, 13];
        $mainGroup[2]     = 5;
        $mainGroup[4]     = 5;
        $mainGroup[13]    = 5;

        $p_output->write("Import GIC", true);
        $sso      = \FreeFW\DI\DI::getShared('sso');
        $brokerId = $sso->getBrokerId();
        $p_output->write("Broker : " . $brokerId, true);
        $cnxGIC = new \FreeFW\Storage\PDO\Mysql('mysql:host=host.docker.internal;dbname=GIC;charset=utf8;', 'root', 'm0n1c4po');
        $storage = \FreeFW\DI\DI::getShared('Storage::default');
        $cnxWebBO = $storage->getProvider();
        if ($brokerId != '4') {
            die('Wrong brokerId !');
        }

        /**
         * Import des Versions de projets
         */

        /** Correspondance des types de versions **/
        $typeVers['R'] = 'REAL';
        $typeVers['T'] = 'TEST';
        $typeVers['A'] = 'ALPHA';
        $typeVers['D'] = 'DEV';

        $queryVersions = $cnxGIC->prepare("SELECT * FROM T_DEV_VERSION V
                                            WHERE UPPER(APP_CODE) IN ('OMEGA','ICLIENT','GIC')"
                                           );
        $queryVersions->execute();
        while ($rowVersion = $queryVersions->fetch(\PDO::FETCH_OBJ)) {
            /**
             * @var \FreeSSO\Model\ProjectVersion
             */
            $prjVersion = new \FreePM\Model\ProjectVersion();
            $prjVersion
            ->setBrkId($brokerId)
            ->setPrjId($this->getNewProjectId($rowVersion->APP_CODE))
            ->setPrjvVersion($rowVersion->VERSION)
            ->setPrjvFrom($rowVersion->DEBUT)
            ->setPrjvTo($rowVersion->Fin)
            ->setPrjvType($typeVers[$rowVersion->TYPE_VERSION])
            ;

            if (!$prjVersion->create()) {
                var_export($prjVersion->getErrors());
                die('ERROR');
            }
            self::$mt_versions[$rowVersion->APP_CODE.'@'.$rowVersion->VERSION] = $prjVersion->getPrjvId();
        }

        /**
         * Import des Types de Clients
         */
        $groupTypes = [];
        $queryTypes = $cnxGIC->prepare("SELECT * FROM T_TYPE_CLIENT WHERE TYPE_CLIENT_ID IN (" . implode(",", $typeclientFilter) . ")");
        $queryTypes->execute();
        while ($rowGrpType = $queryTypes->fetch(\PDO::FETCH_OBJ)) {
            /**
             * @var \FreeSSO\Model\GroupType
             */
            $groupType = \FreeFW\DI\DI::get('FreeSSO::Model::GroupType');
            $groupType
                ->setGrptCode(substr(str_replace(' ', '', strtoupper($rowGrpType->LIBELLE)), 0, 20))
                ->setGrptName($rowGrpType->LIBELLE)
                ->setGrptFrom($rowGrpType->DEBUT)
                ->setGrptTo($rowGrpType->FIN)
            ;
            if (!$groupType->create()) {
                var_export($groupType->getErrors());
                die('ERROR');
            }
            $groupTypes[$rowGrpType->TYPE_CLIENT_ID] = $groupType->getGrptId();
        }


        $codes  = [];
        $logins = [];

        /**
         * Import des Clients
         */
        $queryClients = $cnxGIC->prepare("SELECT * FROM T_CLIENT WHERE TYPE_CLIENT_ID IN (" . implode(",", $typeclientFilter) . ")");
        $queryClients->execute();
        while ($rowClient = $queryClients->fetch(\PDO::FETCH_OBJ)) {
            echo ".";
            $code = $rowClient->CODE;
            if ($code == '') {
                $code = 'ID-' . $rowClient->CLIENT_ID;
            } else {
                if (in_array($code, $codes)) {
                    $code = 'DUP-' . $code . '-' . $rowClient->CLIENT_ID;
                }
            }
            $name = strtoupper(\FreeFW\Tools\PBXString::withoutAccent($rowClient->NOM));
            if ($name == '') {
                $name = $code;
            }
            array_push($codes, $code);
            /**
             * @var \FreeSSO\Model\Group $group
             */
            $group = \FreeFW\DI\DI::get('FreeSSO::Model::Group');
            $group
                ->setGrpName($name)
                ->setGrpCode($code)
                ->setGrpAddress1($rowClient->ADRESSE)
                ->setGrpCp($rowClient->CODE_POSTAL)
                ->setGrpTown($rowClient->COMMUNE)
                ->setGrptId($groupTypes[$rowClient->TYPE_CLIENT_ID])
                ->setGrpFrom($rowClient->DEBUT)
                ->setGrpTo($rowClient->FIN)
                ->setGrpParentId($mainGroup[$rowClient->TYPE_CLIENT_ID])
                ->setGrpExternCode($rowClient->CLIENT_ID)
            ;
            if (!$group->create()) {
                var_export($rowClient);
                var_export($group->getErrors());
                die('ERROR');
            }
            self::$mt_groups[$rowClient->CLIENT_ID] = $group->getGrpId();

            /**
             * Import des Interlocuteurs
             */
            $queryInterlocuteurs = $cnxGIC->prepare("SELECT * FROM T_INTERLOCUTEUR WHERE CLIENT_ID  = " . $rowClient->CLIENT_ID);
            $queryInterlocuteurs->execute();
            while ($rowInterlocuteur = $queryInterlocuteurs->fetch(\PDO::FETCH_OBJ)) {
                $civ   = \FreeSSO\Model\User::TITLE_OTHER;
                $titre = strtoupper($rowInterlocuteur->TITRE);
                if (in_array($titre, ['MR', 'M.', 'M', 'MONSIEUR'])) {
                    $civ = \FreeSSO\Model\User::TITLE_MISTER;
                } else {
                    if (in_array($titre, ['MME', 'MADAME'])) {
                        $civ = \FreeSSO\Model\User::TITLE_MADAM;
                    } else {
                        if (in_array($titre, ['MLLE', 'MADEMOISELLE'])) {
                            $civ = \FreeSSO\Model\User::TITLE_MISS;
                        }
                    }
                }
                $login = $rowInterlocuteur->MAIL;
                $activ = 1;
                if ($login == '') {
                    $login = 'ID-' . $rowInterlocuteur->INTERLOCUTEUR_ID;
                    $activ = 0;
                } else {
                    if (!\FreeFW\Tools\Email::verify($login)) {
                        $login = 'ID-' . $rowInterlocuteur->INTERLOCUTEUR_ID;
                        $activ = 0;
                    } else {
                        $login = strtolower($login);
                    }
                }
                if (in_array($login, $logins)) {
                    $login = 'DUP-' . $rowInterlocuteur->INTERLOCUTEUR_ID;
                    $activ = 0;
                }
                // @todo : verify is email...
                array_push($logins, $login);
                /**
                 * @var \FreeSSO\Model\User $user
                 */
                $user = \FreeFW\DI\DI::get('FreeSSO::Model::User');
                $user
                    ->setUserTitle($civ)
                    ->setUserType(\FreeSSO\Model\User::TYPE_USER)
                    ->setUserLogin($login)
                    ->setUserEmail($rowInterlocuteur->MAIL)
                    ->setUserExternCode($rowInterlocuteur->INTERLOCUTEUR_ID)
                    ->setUserActive($activ)
                    ->setUserFirstName($rowInterlocuteur->PRENOM)
                    ->setUserLastName($rowInterlocuteur->NOM)
                ;
                if (!$user->create()) {
                    var_export($rowInterlocuteur);
                    var_export($user->getErrors());
                    die('ERROR');
                }

                /**
                 *
                 * @var \FreeSSO\Model\GroupUser $groupUser
                 */
                $groupUser = \FreeFW\DI\DI::get('FreeSSO::Model::GroupUser');
                $groupUser
                    ->setGrpId($group->getGrpId())
                    ->setUserId($user->getUserId())
                    ->setGruEmail($rowInterlocuteur->MAIL)
                    ->setGruActiv(true)
                    ->setGruTel1(substr($rowInterlocuteur->TELEPHONE, 0, 20))
                    ->setGruTel2(substr($rowInterlocuteur->MOBILE, 0, 20))
                    ->setFctId($defaultFunction)
                ;
                if (!$groupUser->create()) {
                    var_export($groupUser->getErrors());
                    die('ERROR');
                }
            }
        }
        //
        $p_output->write("Fin de l'import GIC", true);
    }

    public function importBO(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {

        $p_output->write("Import BO", true);
        $cnxBO = new \FreeFW\Storage\PDO\Mysql('mysql:host=host.docker.internal;dbname=omegaweb;charset=utf8;', 'root', 'm0n1c4po');
        $storage = \FreeFW\DI\DI::getShared('Storage::default');
        $cnxWebBO = $storage->getProvider();
        /**
         * Imports Utilisateurs
         */
        $users = [];
        $lang = 'FR';
        $langId = 368;

        $queryUsers = $cnxBO->prepare("SELECT * FROM pawbx_users where user_login not in ('jeromeklam@free.fr', 'fannykuster@free.fr') and user_id > 280000");
        $queryUsers->execute();

        //$webUser = \FreeSSO\Model\User::findFirst(['user_login' => $rowUser->user_login);
        $queryUser = $cnxWebBO->prepare("SELECT user_id FROM sso_user WHERE user_login = :login");

        while ($rowUser = $queryUsers->fetch(\PDO::FETCH_OBJ)) {
            echo ".";
            /**
             * @var \FreeSSO\Model\User $user
             */
            $login = $rowUser->user_login;
            $queryUser->bindParam(":login",$login);
            $queryUser->execute();
            $userId = $queryUser->fetchColumn();
            $user = \FreeFW\DI\DI::get('FreeSSO::Model::User');
            $user
                ->setUserLogin($rowUser->user_login)
                ->setUserPassword($rowUser->user_password)
                ->setUserActive($rowUser->user_active)
                ->setUserSalt($rowUser->user_salt)
                ->setUserEmail($rowUser->user_email)
                ->setUserTitle($rowUser->user_title)
                ->setUserFirstName($rowUser->user_first_name)
                ->setUserLastName($rowUser->user_last_name)
                ->setUserScope($rowUser->user_roles)
                ->setUserType($rowUser->user_type)
                ->setUserIps($rowUser->user_ips)
                ->setUserLastUpdate($rowUser->user_last_update)
                ->setUserPreferredLanguage($lang)
                ->setUserAvatar($rowUser->user_avatar)
                ->setUserCache($rowUser->user_cache)
                ->setUserValString($rowUser->user_val_string)
                ->setUserValEnd($rowUser->user_val_end)
                ->setUserValLogin($rowUser->user_val_login)
                ->setUserCnx($rowUser->user_cnx)
                ->setUserExternCode($rowUser->user_extern_code)
                ->setLangId($langId)
            ;
            if ($userId > 0) {
                $user->setUserId($userId);
                if (!$user->save()) {
                    var_export($user->getErrors());
                    die('ERROR');
                }
            } else {
                if (!$user->create()) {
                    var_export($rowUser);
                    var_export($user->getErrors());
                    die('ERROR');
                }
            }
            $users[$rowUser->user_id] = $user->getUserId();
        }

        /**
         * Imports Accès + Lien Accès Utilisateurs
         */
        $domId = 1;
        $queryBrokers = $cnxBO->prepare("SELECT * FROM pawbx_brokers WHERE brk_active = 1 and brk_cli_app IN ('OMEGA','ICILENT','OTHER')");
        $queryBrokers->execute();
        $queryLinks = $cnxBO->prepare("SELECT * FROM pawbx_links_users WHERE brk_id = :brkId and user_id > 280000");
        $queryGroup = $cnxWebBO->prepare("SELECT grp_id FROM sso_group WHERE grp_code = :cli_code");
        while ($rowBroker = $queryBrokers->fetch(\PDO::FETCH_OBJ)) {
            /**
             * @var \FreeSSO\Model\Broker $broker
             */
            $grpId = 0;
            $cliCode = $rowBroker->brk_cli_code;
            echo $cliCode;
            if ($cliCode != "") {
                $queryGroup->bindParam(":cli_code",$cliCode);
                $queryGroup->execute();
                $grpId = $queryGroup->fetchColumn();
            }
            if ($grpId == 0) {
                $grpId = 4;
            }
            $broker = \FreeFW\DI\DI::get('FreeSSO::Model::Broker');
            $broker
            ->setDomId($domId)
            ->setGrpId($grpId)
            ->setBrkKey($rowBroker->brk_key)
            ->setBrkName($rowBroker->brk_name)
            ->setBrkCertificate($rowBroker->brk_certificate)
            ->setBrkActive($rowBroker->brk_active)
            ->setBrkTs($rowBroker->brk_ts)
            ->setBrkApiScope($rowBroker->brk_api_scope)
            ->setBrkUsersScope($rowBroker->brk_users_scope)
            ->setBrkIps($rowBroker->brk_ips)
            ->setBrkConfig($rowBroker->brk_config)
            ;
            if (!$broker->create()) {
                var_export($rowBroker);
                var_export($broker->getErrors());
                die('ERROR');
            }
            $queryLinks->bindParam(":brkId",$rowBroker->brk_id);
            $queryLinks->execute();
            while ($rowLink = $queryLinks->fetch(\PDO::FETCH_OBJ)) {
                $userBroker = \FreeFW\DI\DI::get('FreeSSO::Model::UserBroker');
                $userBroker
                ->setBrkId($broker->getBrkId())
                ->setUserId($users[$rowLink->user_id])
                ->setUbrkTs($rowLink->lku_ts)
                ->setUbrkPartnerType($rowLink->lku_partner_type)
                ->setUbrkPartnerId($rowLink->lku_partner_id)
                ->setUbrkAuthMethod($rowLink->lku_auth_method)
                ->setUbrkAuthDatas($rowLink->lku_auth_datas)
                ->setUbrkEnd($rowLink->lku_end)
                ;
                if (!$userBroker->create()) {
                    var_export($userBroker->getErrors());
                    die('ERROR');
                }
            }
        }
        $p_output->write("Fin de l'import BO", true);
    }

    /**
     * Get Priority Feature
     *
     * @param mixed $p_gic_id   Identifiant GIC
     *
     * @return int
     *
     * Dans GIC 3 types de priorités alors que dans Omegaweb BO Priorité de 1 à 9
     */
    protected function getPriorityFeature($p_gic_id)
    {
        $prioritys[1] = 1; // Bénin
        $prioritys[2] = 5; // Gênant
        $prioritys[3] = 9; // Bloquant

        if (array_key_exists($p_gic_id, $prioritys)) {
            return $prioritys[$p_gic_id];
        }
        return 1;
    }

    /**
     * Get Notes
     *
     * @param mixed $p_gic_id   Identifiant GIC
     *
     * @return String
     */
    protected function getNewNote($p_gic_id)
    {
        $notes[1] = 'INCOHERENT';
        $notes[2] = 'RECURRENT_LOW';
        $notes[3] = 'RECURRENT_HIGH';
        $notes[4] = 'LEGAL';
        $notes[5] = 'INCORRECT_BEHAVIOUR';
        $notes[6] = 'RISKY';
        $notes[7] = 'IMPOSSIBLE';
        $notes[8] = 'COMPLEX';
        $notes[9] = 'STANDARD';
        $notes[10] = 'NOT_REPRODUCED_ERROR';

        if (array_key_exists($p_gic_id, $notes)) {
            return $notes[$p_gic_id];
        }
        return 'NONE';
    }

    /**
     * Imports Demandes GIC + NovaTime
     */
    public function importGIC_Feature(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
        ) {

            $p_output->write("Import GIC Demandes", true);
            $sso      = \FreeFW\DI\DI::getShared('sso');
            $brokerId = $sso->getBrokerId();
            $p_output->write("Broker : " . $brokerId, true);
            $cnxGIC = new \FreeFW\Storage\PDO\Mysql('mysql:host=host.docker.internal;dbname=GIC;charset=utf8;', 'root', 'm0n1c4po');
            $storage = \FreeFW\DI\DI::getShared('Storage::default');
            $cnxWebBO = $storage->getProvider();
            if ($brokerId != '4') {
                die('Wrong brokerId !');
            }
            /**
             * Suppression des données
             */
            $this->removePmFeatures($cnxWebBO);

            /**
             * Chargement des données en mémoire
             */
            $this->loadInMemory($cnxWebBO);

            /** Correspondance de l'état des demandes **/
            $status['A'] = 1; // Accepté
            $status['C'] = 2; // CT/ CP A Analyser
            $status['N'] = 3; // En cours
            $status['F'] = 4; // Refusé
            $status['J'] = 5; // Rejeté

            $queryDemandes = $cnxGIC->prepare("SELECT D.*, A.CODE APP_CODE, VF.VERSION APP_VERS_F, VT.VERSION APP_VERS_T FROM T_DEMANDE D
                                         JOIN T_DEV_APPLICATION A ON A.DEV_APPLICATION_ID = D.DEV_APPLICATION_ID AND UPPER(A.CODE) IN ('OMEGA','ICLIENT','GIC')
                                         JOIN T_DEV_VERSION VF ON VF.DEV_VERSION_ID = D.DEV_VERSION_ID
                                         LEFT JOIN T_DEV_VERSION VT ON VT.DEV_VERSION_ID = D.SORTIE_DEV_VERSION_ID
                                         WHERE D.CREE_LE >= '2015-01-01' AND NOVATIME_ID IS NULL");
            $queryDecisions = $cnxGIC->prepare("SELECT * FROM T_DECISION WHERE DEMANDE_ID = :demandeId");
            $queryDemandes->execute();
            while ($rowDemande = $queryDemandes->fetch(\PDO::FETCH_OBJ)) {
                /**
                 * @var \FreeSSO\Model\Features $feature
                 */

                /** En fonction de l'état on renseigne la date de fin **/
                $featTo = $rowDemande->DATE_REALISATION;
                $comm = $rowDemande->TEXTE_REALISATION;
                switch ($rowDemande->ETAT) {
                    case 'J':
                        $featTo = $rowDemande->DATE_REJET;
                        $comm = $rowDemande->MOTIF;
                        break;
                    case 'F':
                        $featTo = $rowDemande->DATE_REFUS;
                        $comm = $rowDemande->MOTIF;
                        break;
                };
                /** Concaténation de tous les commentaires **/
                if ($rowDemande->TEXTE_FONCTIONNELLE <> '') {
                    if ($comm <> '') {
                        $comm .= '\n' . '\n';
                    }
                    $comm .= $rowDemande->TEXTE_FONCTIONNELLE;
                }
                if ($rowDemande->TEXTE_TECHNIQUE <> '') {
                    if ($comm <> '') {
                        $comm .= '\n' . '\n';
                    }
                    $comm .= '\n' . '\n' . $rowDemande->TEXTE_TECHNIQUE;
                }

                //$feature = \FreeFW\DI\DI::get('FreePM::Model::Feature');
                $feat = new \FreePM\Model\Feature();
                $feat
                    ->setFeatId($rowDemande->$rowDemande->DEMANDE_ID)
                    ->setBrkId($broker_id)
                    ->setGrpId(5)
                    ->setPrjId($this->getNewProjectId($rowDemande->APP_CODE))
                    ->setFromPrjvId($this->getNewVersionId($rowDemande->APP_CODE, $rowDemande->APP_VERS_F))
                    ->setToPrjvId($this->getNewVersionId($rowDemande->APP_CODE, $rowDemande->APP_VERS_T))
                    ->setUserId($this->getNewUserId($rowDemande->RESPONSABLE_ID))
                    ->setUserJvsId($this->getNewUserId($rowDemande->DEVELOPPEMENT_ID))
                    ->setFeatFrom($rowDemande->CREE_LE)
                    ->setFeatDeadline($rowDemande->DATE_ECHEANCE)
                    ->setFeatPriority($this->getPriorityFeature($rowDemande->PRIORITE_ID))
                    ->setFeatNoteDev($this->getNewNote($rowDemande->NOTE_DEV_ID))
                    ->setFeatNoteHl($this->getNewNote($p_gic_id->NOTE_ASSISTANCE_ID))
                    ->setStaId($status[$rowDemande->ETAT])
                    ->setFeatTs($rowDemande->DATE_ETAT)
                    ->setFeatTo($featTo)
                    ->setFeatShort($rowDemande->TEXTE_PUBLIC)
                    ->setFeatPublic($rowDemande->PUBLIC)
                    ->setFeatMail($rowDemande->ENVOI_MAIL)
                    ->setFeatComm($comm)
                    ->setFeatCommPriv($rowDemande->TEXTE_PRIVE)
                    ->setFeatPlanForm($rowDemande->DATE_PLANIFICATION)
                    ->setFeatWorkload($rowDemande->CHARGE_ESTIMEE)
                    ->setNovaId($rowDemande->NOVATIME_ID)
                ;
                if (!$feat->create()) {
                    var_export($feat->getErrors());
                    die('ERROR');
                }

                /**
                 * Import des Suivis de demandes
                */
                $queryDecisions->bindParam(":demandeId",$rowDemande->DEMANDE_ID);
                $queryDecision->execute();
                while ($rowDecision = $queryDecisions->fetch(\PDO::FETCH_OBJ)) {

                    $featHisto = new \FreePM\Model\FeatureHisto();
                    $featHisto
                    ->setFeatId($feat->getFeatId)
                    ->setFeathTs($rowDecision->DATE_ETAT)
                    ->setStaId($status[$rowDecision->ETAT])
                    ->setFeathComm($rowDecision->REMARQUE)
                    ;

                    if (!$featHisto->create()) {
                        var_export($featHisto->getErrors());
                        die('ERROR');
                    }
                }


            }

            $p_output->write("Fin de l'import GIC Demandes", true);
    }

    /**
     * Get Priority Issue
     *
     * @param mixed $p_gic_id   Identifiant GIC
     *
     * @return String
     */
    protected function getPriorityIssue($p_gic_id)
    {
        $prioritys[1] = 'MINOR';    // Bénin
        $prioritys[2] = 'ANNOYING'; // Gênant
        $prioritys[3] = 'CRITICAL'; // Bloquant

        if (array_key_exists($p_gic_id, $prioritys)) {
            return $prioritys[$p_gic_id];
        }
        return 'NONE';
    }

    /**
     * Imports Incidents GIC
     */
    public function importGIC_Issue(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
        ) {

            $p_output->write("Import GIC Incidents", true);
            $sso      = \FreeFW\DI\DI::getShared('sso');
            $brokerId = $sso->getBrokerId();
            $p_output->write("Broker : " . $brokerId, true);
            $cnxGIC = new \FreeFW\Storage\PDO\Mysql('mysql:host=host.docker.internal;dbname=GIC;charset=utfis8;', 'root', 'm0n1c4po');
            $storage = \FreeFW\DI\DI::getShared('Storage::default');
            $cnxWebBO = $storage->getProvider();
            if ($brokerId != '4') {
                die('Wrong brokerId !');
            }

            /**
             * Suppression des données
             */
            $this->removePmIssues($cnxWebBO);

            /**
             * Chargement des données en mémoire
             */
            $this->loadInMemory($cnxWebBO);

            /**
             * Import des Catégories d'incident pour les projets
             */
            $prjCatIsss = [];
            $queryRubriques = $cnxGIC->prepare("SELECT R.*, A.CODE APP_CODE FROM T_RUBRIQUE R
                                                JOIN T_DEV_APPLICATION A ON A.DEV_APPLICATION_ID = R.DEV_APPLICATION_ID AND UPPER(A.CODE) IN ('OMEGA','ICLIENT','GIC')"
                                               );
            $queryRubriques->execute();
            while ($rowRubrique = $queryRubriques->fetch(\PDO::FETCH_OBJ)) {
                $prjCatIss = new \FreePM\Model\ProjectCategoryIssue();
                $prjCatIss
                ->setPrjId($this->getNewProjectId($rowRubrique->APP_CODE))
                ->setPrjciName($rowRubrique->LIBELLE)
                ;
                if (!$prjCatIss->create()) {
                    var_export($prjCatIss->getErrors());
                    die('ERROR');
                }
                $prjCatIsss[$rowRubrique->RUBRIQUE_ID] = $prjCatIss->getPrjciId();
            }

            /**
             * Import des Catégories d'incident
             */
            $categorys = [];
            $queryCatIncidents = $cnxGIC->prepare("SELECT * FROM T_CATEGORIE_INCIDENT WHERE FIN IS NULL");
            $queryCatIncidents->execute();
            while ($rowCatIncident = $queryCatIncidents->fetch(\PDO::FETCH_OBJ)) {
                $issCat = new \FreePM\Model\IssueCategory();
                $issCat
                    ->setIsscName($rowCatIncident->LIBELLE)
                ;

                if (!$issCat->create()) {
                    var_export($issCat->getErrors());
                    die('ERROR');
                }
                $categorys[$rowCatIncident->CATEGORIE_INCIDENT_ID] = $issCat->getIsscId();
            }

            /**
             * Import des Incidents
             */
            $typeclientFilter = [2, 4, 13];
            $queryIncidents = $cnxGIC->prepare("SELECT I.*, A.CODE APP_CODE
                                          FROM T_INCIDENT I
                                          JOIN T_CLIENT C ON C.CLIENT_ID = I.CLIENT_ID AND C.TYPE_CLIENT_ID IN (" . implode(",", $typeclientFilter) . ")
                                          JOIN T_DEV_APPLICATION A ON A.DEV_APPLICATION_ID = D.DEV_APPLICATION_ID AND UPPER(A.CODE) IN ('OMEGA','ICLIENT','GIC')
                                          WHERE I.APPARUTION_LE >= '2015-01-01'");
            $queryInterventions = $cnxGIC->prepare("SELECT * FROM T_INTERVENTION WHERE INCIDENT_ID = :incidentId");
            /** Etats des incidents ou des interventions **/
            $status['I'] = 'WAIT_JVS';
            $status['C'] = 'WAIT_USER';
            $status['A'] = 'WAIT_CLOSE';
            $status['E'] = 'CLOSE_USER';
            $status['F'] = 'CLOSE_JVS';

            /** Sens des interventions **/
            $way['C'] = 'IN';
            $way['J'] = 'OUT';

            $queryIncidents->execute();
            while ($rowIncident = $queryIncidents->fetch(\PDO::FETCH_OBJ)) {
                /**
                 * @var \FreeSSO\Model\Issue $issue
                 */
                //$iss = \FreeFW\DI\DI::get('FreePM::Model::Issue');
                $iss = new \FreePM\Model\Issue();
                $iss
                  ->setGrpId($this->getNewGroupId($rowIncident->CLIENT_ID))
                  ->setPrjId($this->getNewProjectId($rowRubrique->APP_CODE))
                  ->setIsscId($categorys[$rowIncident->CATEGORIE_INCIDENT_ID])
                  ->setPrjciId($prjCatIsss[$rowIncident->RUBRIQUE_ID])
                  ->setIssFrom($rowIncident->APPARUTION_LE)
                  ->setIssDeadline($rowIncident->REPONSE_LE)
                  ->setIssTs($rowIncident->INTERVENTION_LE)
                  ->setUserId($this->getNewUserId($rowIncident->INT_APPEL_ID))
                  ->setUserJvsId($this->getNewUserId($rowIncident->JVS_APPEL_ID))
                  ->setIssPriority($this->getPriorityIssue($rowIncident->PRIORITE_ID))
                  ->setIssNbCall($rowIncident->NB_APPEL)
                  ->setIssStatus($status[$rowIncident->ETAT_COURANT])
                  ->setCurrentUserId($this->getNewUserId($rowIncident->INT_COURANT_ID))
                  ->setCurrentUserJvsId($this->getNewUserId($rowIncident->JVS_COURANT_ID))
                  ->setCloseUserId($this->getNewUserId($rowIncident->FERME_PAR_INTE_ID))
                  ->setCloseUserJvsId($this->getNewUserId($rowIncident->FERME_PAR_JVS_ID))
                  ->setFeature($rowIncident->DEMANDE)
                ;
                if (!$iss->create()) {
                    var_export($iss->getErrors());
                    die('ERROR');
                }

                /**
                 * Import des Interventions
                 */
                $queryInterventions->bindParam(":incidentId",$rowIncident->INCIDENT_ID);
                $queryInterventions->execute();
                while ($rowIntervention = $queryInterventions->fetch(\PDO::FETCH_OBJ)) {
                    $issHisto = new \FreePM\Model\IssueHisto();
                    $issHisto
                      ->setIsshId($iss->getIssId)
                      ->setIsshFrom($rowIntervention->DATE_DEBUT_INTERVENTION)
                      ->setIsshDeadline($rowIntervention->REPONSE_LE)
                      ->setIsshTo($rowIntervention->DATE_FIN_INTERVENTION)
                      ->setUserId($this->getNewUserId($rowIncident->INTE_APPEL_ID))
                      ->setUserJvsId($this->getNewUserId($rowIncident->JVS_APPEL_ID))
                      ->setNextUserJvsId($this->getNewUserId($rowIncident->TRANSFERT_APPEL_ID))
                      ->setIsshDuration(($rowIntervention->DUREE_H * 60) + $rowIntervention->DUREE_M)
                      ->setIsshStatus($status[$rowIntervention->ETAT_COURANT])
                      ->setIsshComm($rowIntervention->TEXTE_PUBLIC)
                      ->setIsshCommPriv($rowIntervention->TEXTE_PRIVE)
                      ->setIsshMail($rowIntervention->ENVOI_MAIL)
                      ->setIsshWay($way[$rowIntervention->SENS])
                    ;

                    if (!$issHisto->create()) {
                        var_export($issHisto->getErrors());
                        die('ERROR');
                    }
                }
            }

            $p_output->write("Fin de l'import GIC Incidents", true);
    }

}
