<?php
namespace FreePM\Model\Base;

/**
 * DeskCol
 *
 * @author jeromeklam
 */
abstract class DeskCol extends \FreePM\Model\StorageModel\DeskCol
{

    /**
     * deco_id
     * @var int
     */
    protected $deco_id = null;

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
     * desk_id
     * @var int
     */
    protected $desk_id = null;

    /**
     * deco_name
     * @var string
     */
    protected $deco_name = null;

    /**
     * Set deco_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\DeskCol
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\DeskCol
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
     * @return \FreePM\Model\DeskCol
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
     * Set desk_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\DeskCol
     */
    public function setDeskId($p_value)
    {
        $this->desk_id = $p_value;
        return $this;
    }

    /**
     * Get desk_id
     *
     * @return int
     */
    public function getDeskId()
    {
        return $this->desk_id;
    }

    /**
     * Set deco_name
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\DeskCol
     */
    public function setDecoName($p_value)
    {
        $this->deco_name = $p_value;
        return $this;
    }

    /**
     * Get deco_name
     *
     * @return string
     */
    public function getDecoName()
    {
        return $this->deco_name;
    }
}
