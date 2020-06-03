<?php
namespace FreePM\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model DeskColFeature
 *
 * @author jeromeklam
 */
class DeskColFeature extends \FreePM\Model\Base\DeskColFeature
{

    /**
     * Desk Column
     * @var \FreePM\Model\DeskCol
     */
    protected $desk_col = null;

    /**
     * Facture
     * @var \FreePM\Model\Feature
     */
    protected $feature = null;

    /**
     * Set Desk Column
     *
     * @param \FreePM\Model\Feature $p_desk_col
     *
     * @return \FreePM\Model\DeskColFeature
     */
    public function setDeskCol($p_desk_col)
    {
        $this->desk_col = $p_desk_col;
        return $this;
    }

    /**
     * Get desk column
     *
     * @return \FreePM\Model\DeskCol
     */
    public function getDeskCol()
    {
        return $this->desk_col;
    }

    /**
     * Set feature
     *
     * @param \FreePM\Model\Feature $p_feature
     *
     * @return \FreePM\Model\DeskColFeature
     */
    public function setFeature($p_feature)
    {
        $this->feature = $p_feature;
        return $this;
    }

    /**
     * Get feature
     *
     * @return \FreePM\Model\Feature
     */
    public function getFeature()
    {
        return $this->feature;
    }
}
