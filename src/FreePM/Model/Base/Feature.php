<?php
namespace FreePM\Model\Base;

/**
 * Feature
 *
 * @author jeromeklam
 */
abstract class Feature extends \FreePM\Model\StorageModel\Feature
{

    /**
     * feat_id
     * @var int
     */
    protected $feat_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * prj_id
     * @var int
     */
    protected $prj_id = null;

    /**
     * feat_ts
     * @var mixed
     */
    protected $feat_ts = null;

    /**
     * feat_short
     * @var string
     */
    protected $feat_short = null;

    /**
     * feat_desc
     * @var mixed
     */
    protected $feat_desc = null;

    /**
     * feat_from
     * @var mixed
     */
    protected $feat_from = null;

    /**
     * feat_to
     * @var mixed
     */
    protected $feat_to = null;

    /**
     * sta_id
     * @var int
     */
    protected $sta_id = null;

    /**
     * feat_priority
     * @var int
     */
    protected $feat_priority = null;

    /**
     * Set feat_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setBrkId($p_value)
    {
        $this->brk_id = $p_value;
        return $this;
    }

    /**
     * Get brk_id
     *
     * @return int
     */
    public function getBrkId()
    {
        return $this->brk_id;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setGrpId($p_value)
    {
        $this->grp_id = $p_value;
        return $this;
    }

    /**
     * Get grp_id
     *
     * @return int
     */
    public function getGrpId()
    {
        return $this->grp_id;
    }

    /**
     * Set prj_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setPrjId($p_value)
    {
        $this->prj_id = $p_value;
        return $this;
    }

    /**
     * Get prj_id
     *
     * @return int
     */
    public function getPrjId()
    {
        return $this->prj_id;
    }

    /**
     * Set feat_ts
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatTs($p_value)
    {
        $this->feat_ts = $p_value;
        return $this;
    }

    /**
     * Get feat_ts
     *
     * @return mixed
     */
    public function getFeatTs()
    {
        return $this->feat_ts;
    }

    /**
     * Set feat_short
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatShort($p_value)
    {
        $this->feat_short = $p_value;
        return $this;
    }

    /**
     * Get feat_short
     *
     * @return string
     */
    public function getFeatShort()
    {
        return $this->feat_short;
    }

    /**
     * Set feat_desc
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatDesc($p_value)
    {
        $this->feat_desc = $p_value;
        return $this;
    }

    /**
     * Get feat_desc
     *
     * @return mixed
     */
    public function getFeatDesc()
    {
        return $this->feat_desc;
    }

    /**
     * Set feat_from
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatFrom($p_value)
    {
        $this->feat_from = $p_value;
        return $this;
    }

    /**
     * Get feat_from
     *
     * @return mixed
     */
    public function getFeatFrom()
    {
        return $this->feat_from;
    }

    /**
     * Set feat_to
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatTo($p_value)
    {
        $this->feat_to = $p_value;
        return $this;
    }

    /**
     * Get feat_to
     *
     * @return mixed
     */
    public function getFeatTo()
    {
        return $this->feat_to;
    }

    /**
     * Set sta_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setStaId($p_value)
    {
        $this->sta_id = $p_value;
        return $this;
    }

    /**
     * Get sta_id
     *
     * @return int
     */
    public function getStaId()
    {
        return $this->sta_id;
    }

    /**
     * Set feat_priority
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatPriority($p_value)
    {
        $this->feat_priority = $p_value;
        return $this;
    }

    /**
     * Get feat_priority
     *
     * @return int
     */
    public function getFeatPriority()
    {
        return $this->feat_priority;
    }
}
