<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * IssueHisto
 *
 * @author jeromeklam
 */
abstract class IssueHisto extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_ISSH_ID = [
        FFCST::PROPERTY_PRIVATE => 'issh_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'intervention',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_ISS_ID = [
        FFCST::PROPERTY_PRIVATE => 'iss_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'incident',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['iss_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'iss_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'interlocuteur Client',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['user_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'user_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_JVS_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'jvs_user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'interlocuteur JVS',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['jvs_user_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'jvs_user_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_JVS_NEXT_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'jvs_next_user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'interlocuteur JVS à qui est transféré l\'incident',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['jvs_next_user_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'jvs_next_user_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_ISSH_FROM = [
        FFCST::PROPERTY_PRIVATE => 'issh_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Date du début de l\'intervention',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ISSH_TO = [
        FFCST::PROPERTY_PRIVATE => 'issh_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date de fin de l\'intervention',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ISSH_COMM = [
        FFCST::PROPERTY_PRIVATE => 'issh_comm',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Commentaire (Texte public)',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ISSH_COMM_PRIV = [
        FFCST::PROPERTY_PRIVATE => 'issh_comm_priv',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Commentaire privé',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ISSH_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'issh_status',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['WAIT_JVS','WAIT_USER','WAIT_CLOSE','CLOSE_JVS','CLOSE_USER'],
        FFCST::PROPERTY_DEFAULT => 'WAIT_JVS',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Etat de l\intervention',
        FFCST::PROPERTY_SAMPLE  => 'CLOSE_USER',
    ];
    protected static $PRP_ISSH_DURATION = [
        FFCST::PROPERTY_PRIVATE => 'issh_duration',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Durée (en minutes)',
        FFCST::PROPERTY_SAMPLE  => 30,
    ];
    protected static $PRP_ISSH_DEADLINE = [
        FFCST::PROPERTY_PRIVATE => 'issh_deadline',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date de réponse attendue',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ISSH_MAIL = [
        FFCST::PROPERTY_PRIVATE => 'issh_mail',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => true,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'En d\'un eMail',
        FFCST::PROPERTY_SAMPLE  => false,
    ];
    protected static $PRP_ISSH_WAY = [
        FFCST::PROPERTY_PRIVATE => 'issh_way',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['IN','OUT'],
        FFCST::PROPERTY_DEFAULT => 'IN',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Sens de l\'intervention (IN : Client -> JVS ; OUT : JVS -> Client)',
        FFCST::PROPERTY_SAMPLE  => 'IN',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'issh_id'          => self::$PRP_ISSH_ID,
            'iss_id'           => self::$PRP_ISS_ID,
            'user_id'          => self::$PRP_USER_ID,
            'jvs_user_id'      => self::$PRP_JVS_USER_ID,
            'jvs_next_user_id' => self::$PRP_JVS_NEXT_USER_ID,
            'issh_from'        => self::$PRP_ISSH_FROM,
            'issh_to'          => self::$PRP_ISSH_TO,
            'issh_comm'        => self::$PRP_ISSH_COMM,
            'issh_comm_priv'   => self::$PRP_ISSH_COMM_PRIV,
            'issh_status'      => self::$PRP_ISSH_STATUS,
            'issh_duration'    => self::$PRP_ISSH_DURATION,
            'issh_deadline'    => self::$PRP_ISSH_DEADLINE,
            'issh_mail'        => self::$PRP_ISSH_MAIL,
            'issh_way'         => self::$PRP_ISSH_WAY
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'pm_issue_histo';
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
