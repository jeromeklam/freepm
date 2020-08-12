<?php
namespace FreePM\Command;

/**
 * FreePM commands
 *
 * @author jeromeklam
 */
class Import
{

    public function beforeImport(
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
        //
        $groupTypes = [];
        $queryTypes = $cnxGIC->prepare("SELECT * FROM T_TYPE_CLIENT WHERE TYPE_CLIENT_ID IN (" . implode(",", $typeclientFilter) . ")");
        $queryTypes->execute();
        while ($rowGrpType = $queryTypes->fetch(\PDO::FETCH_OBJ)) {
            /**
             * @var \FreeSSO\Model\GroupType $groupType
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
        //
        $codes  = [];
        $groups = [];
        $users  = [];
        $logins = [];
        //
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
            ;
            if (!$group->create()) {
                var_export($rowClient);
                var_export($group->getErrors());
                die('ERROR');
            }
            $groups[$rowClient->CLIENT_ID] = $group->getGrpId();

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

            $query = $cnxWebBO->exec("DELETE FROM pm_feature");
            $query = $cnxWebBO->exec("DELETE FROM pm_feature_histo");

            $demandes = [];
            $demandes = $cnxGIC->prepare("SELECT D.*, A.CODE APP_CODE FROM T_DEMANDE D
                                         JOIN T_DEV_APPLICATION A ON A.DEV_APPLICATION_ID = D.DEV_APPLICATION_ID
                                         AND UPPER(A.CODE) IN ('OMEGA','ICLIENT','GIC')
                                         WHERE D.CREE_LE >= '2015-01-01' AND NOVATIME_ID IS NULL");
            $queryProject = $cnxWebBO->prepare("SELECT prj_id FROM pm_project WHERE prj_code = :codePrj");
            $queryDemandes->execute();
            while ($rowDemande = $demandes->fetch(\PDO::FETCH_OBJ)) {
                /**
                 * @var \FreeSSO\Model\Features $feature
                 */

                /** On recherche l'Id de l'application (du project) **/
                $codeProject = $rowDemande->APP_CODE;
                $queryProject->bindParam(":codePrj",$codeProject);
                $queryProject->execute();
                $prjId = $queryProject->fetchColumn();
                /** On recherche l'Id de l'application (du project) **/

                //$feature = \FreeFW\DI\DI::get('FreePM::Model::Feature');
                $feat = new \FreePM\Model\Feature();
                $feat
                    ->setBrkId($broker_id)
                    ->setGrpId(5)
                    ->setPrjId($rowDemande->DEV_APPLICATION_ID)
                    ->setFeatTs($rowDemande->DATE_ETAT)
                ;
                if (!$feat->create()) {
                    var_export($feat->getErrors());
                    die('ERROR');
                }
            }

            $p_output->write("Fin de l'import GIC Demandes", true);
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
            $cnxGIC = new \FreeFW\Storage\PDO\Mysql('mysql:host=host.docker.internal;dbname=GIC;charset=utf8;', 'root', 'm0n1c4po');
            $storage = \FreeFW\DI\DI::getShared('Storage::default');
            $cnxWebBO = $storage->getProvider();
            if ($brokerId != '4') {
                die('Wrong brokerId !');
            }

            $query = $cnxWebBO->exec("DELETE FROM pm_issue");
            $query = $cnxWebBO->exec("DELETE FROM pm_issue_histo");

            $demandes = [];
            $demandes = $cnxGIC->prepare("SELECT * FROM T_INCIDENT");
            $queryProject = $cnxWebBO->prepare("SELECT prj_id FROM pm_project WHERE prj_code = :codePrj");
            $queryDemandes->execute();
            while ($rowDemande = $demandes->fetch(\PDO::FETCH_OBJ)) {
                /**
                 * @var \FreeSSO\Model\Features $feature
                 */

                /** On recherche l'Id de l'application (du project) **/
                $codeProject = $rowDemande->APP_CODE;
                $queryProject->bindParam(":codePrj",$codeProject);
                $queryProject->execute();
                $prjId = $queryProject->fetchColumn();
                /** On recherche l'Id de l'application (du project) **/

                //$feature = \FreeFW\DI\DI::get('FreePM::Model::Feature');
                $feat = new \FreePM\Model\Feature();
                $feat
                ->setBrkId($broker_id)
                ->setGrpId(5)
                ->setPrjId($rowDemande->DEV_APPLICATION_ID)
                ->setFeatTs($rowDemande->)
                ;
                if (!$feat->create()) {
                    var_export($feat->getErrors());
                    die('ERROR');
                }
            }

            $p_output->write("Fin de l'import GIC Incidents", true);
    }

}
