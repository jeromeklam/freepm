<?php
namespace FreePM\Model\Base;

/**
 * Status
 *
 * @author jeromeklam
 */
abstract class Status extends \FreePM\Model\StorageModel\Status
{

    /**
     * sta_id
     * @var int
     */
    protected $sta_id = null;

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
     * sta_name
     * @var string
     */
    protected $sta_name = null;

    /**
     * sta_type
     * @var string
     */
    protected $sta_type = null;

    /**
     * Set sta_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Status
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Status
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
     * @return \FreePM\Model\Status
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
     * Set sta_name
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Status
     */
    public function setStaName($p_value)
    {
        $this->sta_name = $p_value;
        return $this;
    }

    /**
     * Get sta_name
     *
     * @return string
     */
    public function getStaName()
    {
        return $this->sta_name;
    }

    /**
     * Set sta_type
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Status
     */
    public function setStaType($p_value)
    {
        $this->sta_type = $p_value;
        return $this;
    }

    /**
     * Get sta_type
     *
     * @return string
     */
    public function getStaType()
    {
        return $this->sta_type;
    }
}
