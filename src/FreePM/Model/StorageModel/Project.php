<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Project
 *
 * @author jeromeklam
 */
abstract class Project extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_PRJ_ID = [
        FFCST::PROPERTY_PRIVATE => 'prj_id',
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
        FFCST::PROPERTY_FK      => ['grp_id' => 
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'grp_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_PRJ_NAME = [
        FFCST::PROPERTY_PRIVATE => 'prj_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 80,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_PRJ_CODE = [
        FFCST::PROPERTY_PRIVATE => 'prj_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 20,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_PRJ_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'prj_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 11,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_PRJ_FROM = [
        FFCST::PROPERTY_PRIVATE => 'prj_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_PRJ_TO = [
        FFCST::PROPERTY_PRIVATE => 'prj_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
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
            'prj_id'   => self::$PRP_PRJ_ID,
            'brk_id'   => self::$PRP_BRK_ID,
            'grp_id'   => self::$PRP_GRP_ID,
            'prj_name' => self::$PRP_PRJ_NAME,
            'prj_code' => self::$PRP_PRJ_CODE,
            'prj_type' => self::$PRP_PRJ_TYPE,
            'prj_from' => self::$PRP_PRJ_FROM,
            'prj_to'   => self::$PRP_PRJ_TO
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'pm_project';
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
