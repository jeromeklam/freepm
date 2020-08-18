<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * IssueCategory
 *
 * @author jeromeklam
 */
abstract class IssueCategory extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_ISSC_ID = [
        FFCST::PROPERTY_PRIVATE => 'issc_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la catégorie d\'incident',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_ISSC_NAME = [
        FFCST::PROPERTY_PRIVATE => 'issc_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Libellé de la catégorie d\'incident',
        FFCST::PROPERTY_MAX     => 32,
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
            'issc_id'   => self::$PRP_ISSC_ID,
            'issc_name' => self::$PRP_ISSC_NAME
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'pm_issue_category';
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
