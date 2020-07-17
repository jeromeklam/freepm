<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;
use \FreePM\Constants as FPCST;

/**
 * Project
 *
 * @author ericmendez
 */
abstract class ProjectVersionFileUpload extends \FreePM\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_PRJVF_PK = [
        FFCST::PROPERTY_PRIVATE => 'prjvf_pk',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_PK, FFCST::OPTION_LOCAL], // PK est indispensable pour renseigner id
        FFCST::PROPERTY_COMMENT => 'Identifiant PK',
        FFCST::PROPERTY_SAMPLE  => 123,

    ];

    protected static $PRP_PRJV_ID = [
        FFCST::PROPERTY_PRIVATE => 'prjv_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_LOCAL],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la version',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];

    protected static $PRP_PRJVF_FILE = [
        FFCST::PROPERTY_PRIVATE => 'prjvf_file',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_LOCAL],
        FFCST::PROPERTY_COMMENT => 'Nom complet du fichier',
        FFCST::PROPERTY_MAX     => 255,
        FFCST::PROPERTY_SAMPLE  => 'C:\\REP1\\REP2\\Je suis un fichier.txt',
    ];

    protected static $PRP_PRJVF_UPLOAD = [
        FFCST::PROPERTY_PRIVATE => 'prjvf_upload',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_LOCAL],
        FFCST::PROPERTY_COMMENT => 'je suis le fichier en base64',
        FFCST::PROPERTY_SAMPLE  => 'bGlnbmUgMSA6IGplIHN1aXMgbGUgY29udGVudSBkdSBmaWNoaWVyDQo=',
    ];

    /**
     * Get properties
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'prjvf_pk'      => self::$PRP_PRJVF_PK,
            'prjv_id'       => self::$PRP_PRJV_ID,
            'prjvf_file'    => self::$PRP_PRJVF_FILE,
            'prjvf_upload'  => self::$PRP_PRJVF_UPLOAD,
        ];
    }

    /**
     * Set object source
     * @return string
     */
    public static function getSource()
    {
        return 'dummy_upload';
    }

    /**
     * Get object short description
     * @return string
     */
    public static function getSourceComments()
    {
        return 'Ajout d\'un fichier et de son contenu';
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
        return [];
    }

    /**
     * Get One To many relationShips
     * @return array
     */
    public function getRelationships()
    {
        return [];
    }
}
