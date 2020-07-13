<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;
use \FreePM\Constants as FPCST;

/**
 * Project
 *
 * @author ericmendez
 */
abstract class ProjectVersionFile extends \FreePM\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_PRJVF_ID = [
        FFCST::PROPERTY_PRIVATE => 'prjvf_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du fichier',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];

    protected static $PRP_PRJV_ID = [
        FFCST::PROPERTY_PRIVATE => 'prjv_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la version',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['project_version' =>
            [
                FFCST::FOREIGN_MODEL => 'FreePM::Model::ProjectVersion',
                FFCST::FOREIGN_FIELD => 'prjv_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ],
    ];

    protected static $PRP_PRJVF_NAME = [
        FFCST::PROPERTY_PRIVATE => 'prjvf_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Nom du fichier',
        FFCST::PROPERTY_MAX     => 64,
        FFCST::PROPERTY_SAMPLE  => 'Je suis un fichier.txt',
    ];

    protected static $PRP_PRJVF_LINK = [
        FFCST::PROPERTY_PRIVATE => 'prjvf_link',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Lien ou chemin vers l\'extérieur',
        FFCST::PROPERTY_MAX     => 200,
        FFCST::PROPERTY_SAMPLE  => '0a1fe8b54cdcd57964f',
    ];

    /**
     * Get properties
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'prjvf_id'          => self::$PRP_PRJVF_ID,
            'prjv_id'           => self::$PRP_PRJV_ID,
            'prjvf_name'        => self::$PRP_PRJVF_NAME,
            'prjvf_link'        => self::$PRP_PRJVF_LINK,
        ];
    }

    /**
     * Set object source
     * @return string
     */
    public static function getSource()
    {
        return 'pm_project_version_file';
    }

    /**
     * Get object short description
     * @return string
     */
    public static function getSourceComments()
    {
        return 'Gestion des liens fichiers / versions';
    }

    /**
     * Get autocomplete field
     * @return string
     */
    public static function getAutocompleteField()
    {
        return '';
    }

    /**
     * Get uniq indexes
     * @return array[]
     */
    public static function getUniqIndexes()
    {
        return [
            'file' => [
                FFCST::INDEX_FIELDS => 'prjv_id,prjvf_name',
                FFCST::INDEX_EXISTS => FPCST::ERROR_FILE_EXISTS
            ]
        ];
    }
}
