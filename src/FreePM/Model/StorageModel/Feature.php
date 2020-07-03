<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Feature
 *
 * @author jeromeklam
 */
abstract class Feature extends \FreePM\Model\StorageModel\Base
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
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::Group',
                FFCST::FOREIGN_FIELD => 'grp_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_PRJ_ID = [
        FFCST::PROPERTY_PRIVATE => 'prj_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['project' =>
            [
                FFCST::FOREIGN_MODEL => 'FreePM::Model::Project',
                FFCST::FOREIGN_FIELD => 'prj_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_FEAT_TS = [
        FFCST::PROPERTY_PRIVATE => 'feat_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_SHORT = [
        FFCST::PROPERTY_PRIVATE => 'feat_short',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 255,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_DESC = [
        FFCST::PROPERTY_PRIVATE => 'feat_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_FROM = [
        FFCST::PROPERTY_PRIVATE => 'feat_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEAT_TO = [
        FFCST::PROPERTY_PRIVATE => 'feat_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_STA_ID = [
        FFCST::PROPERTY_PRIVATE => 'sta_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['status' =>
            [
                FFCST::FOREIGN_MODEL => 'FreePM::Model::Status',
                FFCST::FOREIGN_FIELD => 'sta_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_FEAT_PRIORITY = [
        FFCST::PROPERTY_PRIVATE => 'feat_priority',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Priorité, de 1 à 9, 9 étant le moins important',
        FFCST::PROPERTY_DEFAULT => 9,
        FFCST::PROPERTY_SAMPLE  => 3,
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'feat_id'       => self::$PRP_FEAT_ID,
            'brk_id'        => self::$PRP_BRK_ID,
            'grp_id'        => self::$PRP_GRP_ID,
            'prj_id'        => self::$PRP_PRJ_ID,
            'feat_ts'       => self::$PRP_FEAT_TS,
            'feat_short'    => self::$PRP_FEAT_SHORT,
            'feat_desc'     => self::$PRP_FEAT_DESC,
            'feat_from'     => self::$PRP_FEAT_FROM,
            'feat_to'       => self::$PRP_FEAT_TO,
            'sta_id'        => self::$PRP_STA_ID,
            'feat_priority' => self::$PRP_FEAT_PRIORITY
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
                FFCST::REL_FIELD   => 'deco_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les liens vers les kanbans',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
        ];
    }
}
