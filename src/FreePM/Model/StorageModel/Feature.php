<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Feature
 *
 * @author jeromeklam
 */
abstract class Feature extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_FEAT_ID = [
        FFCST::PROPERTY_PRIVATE => 'feat_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['group' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::Group',
                FFCST::FOREIGN_FIELD => 'grp_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_PRJ_ID = [
        FFCST::PROPERTY_PRIVATE => 'prj_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du projet',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['project' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::Project',
                FFCST::FOREIGN_FIELD => 'prj_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_PRJV_ID = [
        FFCST::PROPERTY_PRIVATE => 'prjv_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la version du projet',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['project_version' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ProjectVersion',
                FFCST::FOREIGN_FIELD => 'prjv_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'utilisateur qui a initié la demande',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['user' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::User',
                FFCST::FOREIGN_FIELD => 'user_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_JVS_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'jvs_user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la personne qui va traité la demande',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['jvs_user_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::User',
                FFCST::FOREIGN_FIELD => 'user_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_STA_ID = [
        FFCST::PROPERTY_PRIVATE => 'sta_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'état',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['status' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::Status',
                FFCST::FOREIGN_FIELD => 'sta_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_FEAT_PARENT_ID = [
        FFCST::PROPERTY_PRIVATE => 'feat_parent_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du travail parent',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['parent' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::Feature',
                FFCST::FOREIGN_FIELD => 'feat_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_FEAT_SHORT = [
        FFCST::PROPERTY_PRIVATE => 'feat_short',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Libellé',
        FFCST::PROPERTY_MAX     => 255,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_DESC = [
        FFCST::PROPERTY_PRIVATE => 'feat_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Description',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_TS = [
        FFCST::PROPERTY_PRIVATE => 'feat_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date de modification',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_FROM = [
        FFCST::PROPERTY_PRIVATE => 'feat_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Date de création',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_DEADLINE = [
        FFCST::PROPERTY_PRIVATE => 'feat_deadline',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date d\'échéance',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_TO = [
        FFCST::PROPERTY_PRIVATE => 'feat_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date de fin (réalisation - refus - rejet)',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_PRIORITY = [
        FFCST::PROPERTY_PRIVATE => 'feat_priority',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Priorité, de 1 à 9, 9 étant le moins important',
        FFCST::PROPERTY_DEFAULT => 9,
        FFCST::PROPERTY_SAMPLE  => 3,
    ];
    protected static $PRP_FEAT_PUBLIC = [
        FFCST::PROPERTY_PRIVATE => 'feat_public',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_FEAT_COMM = [
        FFCST::PROPERTY_PRIVATE => 'feat_comm',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Commentaire (Motif du refus ou du rejet - Texte réalisation - Texte technique - Texte fonctionnel)',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_COMM_PRIV = [
        FFCST::PROPERTY_PRIVATE => 'feat_comm_priv',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Commentaire privé',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_WORKLOAD = [
        FFCST::PROPERTY_PRIVATE => 'feat_workload',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Charge estimée en Heure',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_FEAT_MAIL = [
        FFCST::PROPERTY_PRIVATE => 'feat_mail',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Envoi d\'un mail',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_NOVA_ID = [
        FFCST::PROPERTY_PRIVATE => 'nova_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Identifiant du travail dans Novatime',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_FEAT_NOTE_DEV = [
        FFCST::PROPERTY_PRIVATE => 'feat_note_dev',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['NONE','RISKY','IMPOSSIBLE','COMPLEX','STANDARD'],
        FFCST::PROPERTY_DEFAULT => 'NONE',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Note développement',
        FFCST::PROPERTY_SAMPLE  => 'STANDARD',
    ];
    protected static $PRP_FEAT_NOTE_HL = [
        FFCST::PROPERTY_PRIVATE => 'feat_note_hl',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['NONE','INCOHERENT','RECURRENT_LOW','RECURRENT_HIGH','LEGAL','INCORRECT_BEHAVIOUR','NOT_REPRODUCED_ERROR'],
        FFCST::PROPERTY_DEFAULT => 'NONE',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Note Assistance',
        FFCST::PROPERTY_SAMPLE  => 'LEGAL',
    ];
    protected static $PRP_FEAT_PLAN_FORM = [
        FFCST::PROPERTY_PRIVATE => 'feat_plan_form',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date de début de planification',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_PLAN_TO = [
        FFCST::PROPERTY_PRIVATE => 'feat_plan_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date de fin de planification',
        FFCST::PROPERTY_SAMPLE  => '',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'feat_id'        => self::$PRP_FEAT_ID,
            'brk_id'         => self::$PRP_BRK_ID,
            'grp_id'         => self::$PRP_GRP_ID,
            'prj_id'         => self::$PRP_PRJ_ID,
            'prjv_id'        => self::$PRP_PRJV_ID,
            'user_id'        => self::$PRP_USER_ID,
            'jvs_user_id'    => self::$PRP_JVS_USER_ID,
            'sta_id'         => self::$PRP_STA_ID,
            'feat_parent_id' => self::$PRP_FEAT_PARENT_ID,
            'feat_short'     => self::$PRP_FEAT_SHORT,
            'feat_desc'      => self::$PRP_FEAT_DESC,
            'feat_ts'        => self::$PRP_FEAT_TS,
            'feat_from'      => self::$PRP_FEAT_FROM,
            'feat_deadline'  => self::$PRP_FEAT_DEADLINE,
            'feat_to'        => self::$PRP_FEAT_TO,
            'feat_priority'  => self::$PRP_FEAT_PRIORITY,
            'feat_public'    => self::$PRP_FEAT_PUBLIC,
            'feat_comm'      => self::$PRP_FEAT_COMM,
            'feat_comm_priv' => self::$PRP_FEAT_COMM_PRIV,
            'feat_workload'  => self::$PRP_FEAT_WORKLOAD,
            'feat_mail'      => self::$PRP_FEAT_MAIL,
            'nova_id'        => self::$PRP_NOVA_ID,
            'feat_note_dev'  => self::$PRP_FEAT_NOTE_DEV,
            'feat_note_hl'   => self::$PRP_FEAT_NOTE_HL,
            'feat_plan_form' => self::$PRP_FEAT_PLAN_FORM,
            'feat_plan_to'   => self::$PRP_FEAT_PLAN_TO
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'pm_feature';
    }

    /**
     * Get object short description
     *
     * @return string
     */
    public static function getSourceComments()
    {
        return '';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return '';
    }

    /**
     * Get One To many relationShips
     *
     * @return array
     */
    public function getRelationships()
    {
        return [
            'desk_cols' => [
                FFCST::REL_MODEL   => 'FreePM::Model::DeskColFeature',
                FFCST::REL_FIELD   => 'feat_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les liens vers les kanbans',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
        ];
    }

}
