<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Status
 *
 * @author jeromeklam
 */
abstract class Status extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_STA_ID = [
        FFCST::PROPERTY_PRIVATE => 'sta_id',
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
    protected static $PRP_STA_NAME = [
        FFCST::PROPERTY_PRIVATE => 'sta_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 80,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_STA_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'sta_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 7,
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
            'sta_id'   => self::$PRP_STA_ID,
            'brk_id'   => self::$PRP_BRK_ID,
            'grp_id'   => self::$PRP_GRP_ID,
            'sta_name' => self::$PRP_STA_NAME,
            'sta_type' => self::$PRP_STA_TYPE
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'pm_status';
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
