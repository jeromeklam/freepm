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
     * Import GIC
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     */
    public function import(
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
        $provider = new \FreeFW\Storage\PDO\Mysql('mysql:host=mysql;dbname=GIC;charset=utf8;', 'super', 'YggDrasil');
        $storage = \FreeFW\DI\DI::getShared('Storage::default');
        $assoPdo = $storage->getProvider();
        if ($brokerId != '4') {
            die('Wrong brokerId !');
        }
        //
        $p_output->write("Nettoyage", true);
        $query = $assoPdo->exec("DELETE FROM sso_broker_session WHERE 1=1");
        $query = $assoPdo->exec("DELETE FROM sso_session WHERE 1=1");
        $query = $assoPdo->exec("DELETE FROM sso_group_user WHERE grp_id > 5 ");
        $query = $assoPdo->exec("DELETE FROM sso_group_user WHERE user_id > 2");
        $query = $assoPdo->exec("DELETE FROM sso_user_broker WHERE brk_id > 4");
        $query = $assoPdo->exec("DELETE FROM sso_user_broker WHERE user_id > 2");
        $query = $assoPdo->exec("DELETE FROM sso_user_token WHERE user_id > 2");
        $query = $assoPdo->exec("DELETE FROM sso_password_token WHERE user_id > 2");
        $query = $assoPdo->exec("DELETE FROM pm_desk_col_feature WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM pm_desk_col WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM pm_desk WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM pm_feature WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM pm_status WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM pm_project_version WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM pm_project WHERE grp_id > 5");
        $query = $assoPdo->exec("UPDATE sso_group SET grp_parent_id = null grp_id > 5");
        $query = $assoPdo->exec("DELETE FROM sso_group WHERE grp_id > 5");
        $query = $assoPdo->exec("DELETE FROM sso_user WHERE user_id > 2");
        $query = $assoPdo->exec("DELETE FROM sso_group_type WHERE grpt_id > 5");
        $query = $assoPdo->exec("DELETE FROM sso_job_function WHERE fct_id > 5");
        //
        $groupTypes = [];
        $queryTypes = $provider->prepare("SELECT * FROM T_TYPE_CLIENT WHERE TYPE_CLIENT_ID IN (" . implode(",", $typeclientFilter) . ")");
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
        $queryClients = $provider->prepare("SELECT * FROM T_CLIENT WHERE TYPE_CLIENT_ID IN (" . implode(",", $typeclientFilter) . ")");
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
            $queryInterlocuteurs = $provider->prepare("SELECT * FROM T_INTERLOCUTEUR WHERE CLIENT_ID  = " . $rowClient->CLIENT_ID);
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
        $p_output->write("Fin de l'import", true);
    }
}
