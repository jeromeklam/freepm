<?php
namespace FreePM\Model\Base;

/**
 * DeskColFeature
 *
 * @author jeromeklam
 */
abstract class DeskColFeature extends \FreePM\Model\StorageModel\DeskColFeature
{

    /**
     * dcf_id
     * @var int
     */
    protected $dcf_id = null;

    /**
     * deco_id
     * @var int
     */
    protected $deco_id = null;

    /**
     * feat_id
     * @var int
     */
    protected $feat_id = null;

    /**
     * dcf_position
     * @var int
     */
    protected $dcf_position = null;

    /**
     * Set dcf_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\DeskColFeature
     */
    public function setDcfId($p_value)
    {
        $this->dcf_id = $p_value;
        return $this;
    }

    /**
     * Get dcf_id
     *
     * @return int
     */
    public function getDcfId()
    {
        return $this->dcf_id;
    }

    /**
     * Set deco_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\DeskColFeature
     */
    public function setDecoId($p_value)
    {
        $this->deco_id = $p_value;
        return $this;
    }

    /**
     * Get deco_id
     *
     * @return int
     */
    public function getDecoId()
    {
        return $this->deco_id;
    }

    /**
     * Set feat_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\DeskColFeature
     */
    public function setFeatId($p_value)
    {
        $this->feat_id = $p_value;
        return $this;
    }

    /**
     * Get feat_id
     *
     * @return int
     */
    public function getFeatId()
    {
        return $this->feat_id;
    }

    /**
     * Set dcf_position
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\DeskColFeature
     */
    public function setDcfPosition($p_value)
    {
        $this->dcf_position = $p_value;
        return $this;
    }

    /**
     * Get dcf_position
     *
     * @return int
     */
    public function getDcfPosition()
    {
        return $this->dcf_position;
    }
}
