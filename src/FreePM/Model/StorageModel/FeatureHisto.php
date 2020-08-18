<?php
namespace FreePM\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * FeatureHisto
 *
 * @author jeromeklam
 */
abstract class FeatureHisto extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_FEATH_ID = [
        FFCST::PROPERTY_PRIVATE => 'feath_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du suivi de la demande',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_FEAT_ID = [
        FFCST::PROPERTY_PRIVATE => 'feat_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la demande',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['feat_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'feat_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_STA_ID = [
        FFCST::PROPERTY_PRIVATE => 'sta_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'état de la demande',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['sta_id' =>
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'sta_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_FEATH_TS = [
        FFCST::PROPERTY_PRIVATE => 'feath_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Date de la modification',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_FEATH_NAME = [
        FFCST::PROPERTY_PRIVATE => 'feath_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Libellé de la modification',
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
            'feath_id'   => self::$PRP_FEATH_ID,
            'feat_id'    => self::$PRP_FEAT_ID,
            'sta_id'     => self::$PRP_STA_ID,
            'feath_ts'   => self::$PRP_FEATH_TS,
            'feath_name' => self::$PRP_FEATH_NAME
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'pm_feature_histo';
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
