<?php
namespace FreePM\Model\Base;

/**
 * Desk
 *
 * @author jeromeklam
 */
abstract class Desk extends \FreePM\Model\StorageModel\Desk
{

    /**
     * desk_id
     * @var int
     */
    protected $desk_id = null;

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
     * user_id
     * @var int
     */
    protected $user_id = null;

    /**
     * desk_name
     * @var string
     */
    protected $desk_name = null;

    /**
     * desk_desc
     * @var mixed
     */
    protected $desk_desc = null;

    /**
     * desk_from
     * @var mixed
     */
    protected $desk_from = null;

    /**
     * desk_to
     * @var mixed
     */
    protected $desk_to = null;

    /**
     * desk_status
     * @var string
     */
    protected $desk_status = null;

    /**
     * Set desk_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Desk
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Desk
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
     * @return \FreePM\Model\Desk
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
     * Set user_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Desk
     */
    public function setUserId($p_value)
    {
        $this->user_id = $p_value;
        return $this;
    }

    /**
     * Get user_id
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set desk_name
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Desk
     */
    public function setDeskName($p_value)
    {
        $this->desk_name = $p_value;
        return $this;
    }

    /**
     * Get desk_name
     *
     * @return string
     */
    public function getDeskName()
    {
        return $this->desk_name;
    }

    /**
     * Set desk_desc
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Desk
     */
    public function setDeskDesc($p_value)
    {
        $this->desk_desc = $p_value;
        return $this;
    }

    /**
     * Get desk_desc
     *
     * @return mixed
     */
    public function getDeskDesc()
    {
        return $this->desk_desc;
    }

    /**
     * Set desk_from
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Desk
     */
    public function setDeskFrom($p_value)
    {
        $this->desk_from = $p_value;
        return $this;
    }

    /**
     * Get desk_from
     *
     * @return mixed
     */
    public function getDeskFrom()
    {
        return $this->desk_from;
    }

    /**
     * Set desk_to
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Desk
     */
    public function setDeskTo($p_value)
    {
        $this->desk_to = $p_value;
        return $this;
    }

    /**
     * Get desk_to
     *
     * @return mixed
     */
    public function getDeskTo()
    {
        return $this->desk_to;
    }

    /**
     * Set desk_status
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Desk
     */
    public function setDeskStatus($p_value)
    {
        $this->desk_status = $p_value;
        return $this;
    }

    /**
     * Get desk_status
     *
     * @return string
     */
    public function getDeskStatus()
    {
        return $this->desk_status;
    }
}
