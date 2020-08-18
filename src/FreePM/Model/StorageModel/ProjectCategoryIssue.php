<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * ProjectCategoryIssue
 *
 * @author jeromeklam
 */
abstract class ProjectCategoryIssue extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_PRJCI_ID = [
        FFCST::PROPERTY_PRIVATE => 'prjci_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la catégorie d\'incident pour un projet',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_PRJ_ID = [
        FFCST::PROPERTY_PRIVATE => 'prj_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du projet',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['prj_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'prj_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_PRJCI_NAME = [
        FFCST::PROPERTY_PRIVATE => 'prjci_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Libellé de la catégorie d\'incident du projet',
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
            'prjci_id'   => self::$PRP_PRJCI_ID,
            'prj_id'     => self::$PRP_PRJ_ID,
            'prjci_name' => self::$PRP_PRJCI_NAME
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'pm_project_category_issue';
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
