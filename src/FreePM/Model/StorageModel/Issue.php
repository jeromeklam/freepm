<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Issue
 *
 * @author jeromeklam
 */
abstract class Issue extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_ISS_ID = [
        FFCST::PROPERTY_PRIVATE => 'iss_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'incident',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du Client',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['grp_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'grp_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'interlocuteur Client qui a créé l\incident',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['user_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'user_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_CURRENT_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'current_user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'interlocuteur Client courant',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['current_user_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'current_user_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_USER_JVS_ID = [
        FFCST::PROPERTY_PRIVATE => 'user_jvs_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'interlocuteur JVS qui a reçu l\'incident',
        FFCST::PROPERTY_SAMPLE  => 20,
        FFCST::PROPERTY_FK      => ['user_jvs_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'user_jvs_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_CURRENT_USER_JVS_ID = [
        FFCST::PROPERTY_PRIVATE => 'current_user_jvs_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'interlocuteur JVS courant',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['current_user_jvs_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'current_user_jvs_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_CLOSE_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'close_user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'interlocuteur Client qui a fermé l\'incident',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['close_user_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'close_user_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_CLOSE_USER_JVS_ID = [
        FFCST::PROPERTY_PRIVATE => 'close_user_jvs_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'interlocuteur JVS qui a fermé l\'incident',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['close_user_jvs_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'close_user_jvs_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_PRJ_ID = [
        FFCST::PROPERTY_PRIVATE => 'prj_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du projet concerné',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['prj_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'prj_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_ISSC_ID = [
        FFCST::PROPERTY_PRIVATE => 'issc_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la catégorie de l\'incident',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['issc_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'issc_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_PRJCI_ID = [
        FFCST::PROPERTY_PRIVATE => 'prjci_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la catégorie d\'incident du projet',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['prjci_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'prjci_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_ISS_FROM = [
        FFCST::PROPERTY_PRIVATE => 'iss_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Date de création',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ISS_TS = [
        FFCST::PROPERTY_PRIVATE => 'iss_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Date de la dernière intervention',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ISS_DEADLINE = [
        FFCST::PROPERTY_PRIVATE => 'iss_deadline',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Date de réponse attendue',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ISS_TO = [
        FFCST::PROPERTY_PRIVATE => 'iss_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Date de fermeture',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ISS_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'iss_status',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['WAIT_JVS','WAIT_USER','WAIT_CLOSE','CLOSE_JVS','CLOSE_USER'],
        FFCST::PROPERTY_DEFAULT => 'WAIT_JVS',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Etat',
        FFCST::PROPERTY_SAMPLE  => 'CLOSE_USER',
    ];
    protected static $PRP_ISS_NB_CALL = [
        FFCST::PROPERTY_PRIVATE => 'iss_nb_call',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Nombre d\'appel',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_ISS_PRIORITY = [
        FFCST::PROPERTY_PRIVATE => 'iss_priority',
        FFCST::PROPERTY_ENUM    => ['NONE','MINOR','ANNOYING','CRITICAL'],
        FFCST::PROPERTY_DEFAULT => 'MINOR',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Priorité Bénin, Gênant, Bloquant',
        FFCST::PROPERTY_SAMPLE  => 'MINOR',
    ];
    protected static $PRP_ISS_FEATURE = [
        FFCST::PROPERTY_PRIVATE => 'iss_feature',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => false,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Incident découlant sur une demande',
    ];
    protected static $PRP_ISS_DURATION = [
        FFCST::PROPERTY_PRIVATE => 'iss_duration',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Durée totale du traitement de l\'incident en minutes',
        FFCST::PROPERTY_SAMPLE  => 18,
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'iss_id'              => self::$PRP_ISS_ID,
            'grp_id'              => self::$PRP_GRP_ID,
            'user_id'             => self::$PRP_USER_ID,
            'user_jvs_id'         => self::$PRP_USER_JVS_ID,
            'current_user_id'     => self::$PRP_CURRENT_USER_ID,
            'current_user_jvs_id' => self::$PRP_CURRENT_USER_JVS_ID,
            'close_user_id'       => self::$PRP_CLOSE_USER_ID,
            'close_user_jvs_id'   => self::$PRP_CLOSE_USER_JVS_ID,
            'prj_id'              => self::$PRP_PRJ_ID,
            'issc_id'             => self::$PRP_ISSC_ID,
            'prjci_id'            => self::$PRP_PRJCI_ID,
            'iss_from'            => self::$PRP_ISS_FROM,
            'iss_ts'              => self::$PRP_ISS_TS,
            'iss_deadline'        => self::$PRP_ISS_DEADLINE,
            'iss_to'              => self::$PRP_ISS_TO,
            'iss_status'          => self::$PRP_ISS_STATUS,
            'iss_nb_call'         => self::$PRP_ISS_NB_CALL,
            'iss_priority'        => self::$PRP_ISS_PRIORITY,
            'iss_feature'         => self::$PRP_ISS_FEATURE,
            'iss_duration'        => self::$PRP_ISS_DURATION
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'pm_issue';
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
}
