<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;
use \FreePM\Constants as FPCST;

/**
 * Project
 *
 * @author ericmendez
 */
abstract class ProjectLastVersion extends \FreePM\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_PRJ_PK = [
        FFCST::PROPERTY_PRIVATE => 'prj_pk',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_PK], // indispensable pour renseigner id
        FFCST::PROPERTY_COMMENT => 'Identifiant PK',
        FFCST::PROPERTY_SAMPLE  => 'Mon projet V1.23.4a',
    ];
    protected static $PRP_PRJ_NAME = [
        FFCST::PROPERTY_PRIVATE => 'prj_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 'Mon Projet',
    ];
    protected static $PRP_PRJV_VERSION = [
        FFCST::PROPERTY_PRIVATE => 'prjv_version',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Numéro de la version version',
        FFCST::PROPERTY_SAMPLE  => 'V1.23.4a',
    ];
    protected static $PRP_PRJVF_ID = [
        FFCST::PROPERTY_PRIVATE => 'prjvf_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Identifiant du fichier',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_PRJVF_NAME = [
        FFCST::PROPERTY_PRIVATE => 'prjvf_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Nom du fichier',
        FFCST::PROPERTY_SAMPLE  => 'Je suis un fichier.txt',
    ];
    protected static $PRP_PRJVF_LINK = [
        FFCST::PROPERTY_PRIVATE => 'prjvf_link',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Lien ou chemin vers l\'extérieur',
        FFCST::PROPERTY_SAMPLE  => 'GED:1A23FE67AZEA',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'prj_pk'            => self::$PRP_PRJ_PK,
            'prj_name'          => self::$PRP_PRJ_NAME,
            'prjv_version'      => self::$PRP_PRJV_VERSION,
            'prjvf_id'          => self::$PRP_PRJVF_ID,
            'prjvf_name'        => self::$PRP_PRJVF_NAME,
            'prjvf_link'        => self::$PRP_PRJVF_LINK,
        ];
    }
    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'dummy_lastversion';
    }
    /**
     * Get object short description
     *
     * @return string
     */
    public static function getSourceComments()
    {
        return 'Structure pour obtenir la dernière version avec la liste des fichiers';
    }
}
