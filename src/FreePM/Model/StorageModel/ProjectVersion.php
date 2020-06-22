<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Project
 *
 * @author ericmendez
 */
abstract class ProjectVersion extends \FreePM\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_PRJV_ID = [
        FFCST::PROPERTY_PRIVATE => 'prjv_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la version',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER],
        FFCST::PROPERTY_COMMENT => 'Identifiant du broker',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_PRJ_ID = [
        FFCST::PROPERTY_PRIVATE => 'prj_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du projet',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['project' =>
            [
                FFCST::FOREIGN_MODEL => 'FreePM::Model::Project',
                FFCST::FOREIGN_FIELD => 'prj_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ],
    ];
    protected static $PRP_PRJV_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'prjv_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['REAL','TEST','BETA','ALPHA','DEV'],
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Type de version',
        FFCST::PROPERTY_DEFAULT => 'DEV',
        FFCST::PROPERTY_SAMPLE  => 'DEV',
    ];
    protected static $PRP_PRJV_VERSION = [
        FFCST::PROPERTY_PRIVATE => 'prjv_version',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Numéro de la version version',
        FFCST::PROPERTY_MAX     => 20,
        FFCST::PROPERTY_SAMPLE  => 'V1.23.4a',
    ];
    protected static $PRP_PRJV_FROM = [
        FFCST::PROPERTY_PRIVATE => 'prjv_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Début de validité',
        FFCST::PROPERTY_SAMPLE  => '1983-01-01 00:00:00',
    ];
    protected static $PRP_PRJV_TO = [
        FFCST::PROPERTY_PRIVATE => 'prjv_tp',
        FFCST::PROPERTY_PUBLIC  => 'prjv_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Fin de validité',
        FFCST::PROPERTY_SAMPLE  => '2049-12-31 23:59:59',
    ];
    protected static $PRP_PRJV_BETA_TEST = [
        FFCST::PROPERTY_PRIVATE => 'prjv_beta_test',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Version en bêta test',
        FFCST::PROPERTY_SAMPLE  => true,
        FFCST::PROPERTY_DEFAULT => false,
    ];
    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'prjv_id'           => self::$PRP_PRJV_ID,
            'brk_id'            => self::$PRP_BRK_ID,
            'prj_id'            => self::$PRP_PRJ_ID,
            'prjv_type'         => self::$PRP_PRJV_TYPE,
            'prjv_version'      => self::$PRP_PRJV_VERSION,
            'prjv_from'         => self::$PRP_PRJV_FROM,
            'prjv_tp'           => self::$PRP_PRJV_TO,
            'prjv_beta_test'    => self::$PRP_PRJV_BETA_TEST
        ];
    }
    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'pm_project_version';
    }
    /**
     * Get object short description
     *
     * @return string
     */
    public static function getSourceComments()
    {
        return 'Gestion des liens versions / projets';
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
