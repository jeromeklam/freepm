<?php
namespace FreePM\Model\Base;

/**
 * Project
 *
 * @author jeromeklam
 */
abstract class Project extends \FreePM\Model\StorageModel\Project
{

    /**
     * prj_id
     * @var int
     */
    protected $prj_id = null;

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
     * prj_name
     * @var string
     */
    protected $prj_name = null;

    /**
     * prj_code
     * @var string
     */
    protected $prj_code = null;

    /**
     * prj_type
     * @var string
     */
    protected $prj_type = null;

    /**
     * prj_from
     * @var mixed
     */
    protected $prj_from = null;

    /**
     * prj_to
     * @var mixed
     */
    protected $prj_to = null;

    /**
     * Set prj_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Project
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Project
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
     * @return \FreePM\Model\Project
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
     * Set prj_name
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Project
     */
    public function setPrjName($p_value)
    {
        $this->prj_name = $p_value;
        return $this;
    }

    /**
     * Get prj_name
     *
     * @return string
     */
    public function getPrjName()
    {
        return $this->prj_name;
    }

    /**
     * Set prj_code
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Project
     */
    public function setPrjCode($p_value)
    {
        $this->prj_code = $p_value;
        return $this;
    }

    /**
     * Get prj_code
     *
     * @return string
     */
    public function getPrjCode()
    {
        return $this->prj_code;
    }

    /**
     * Set prj_type
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Project
     */
    public function setPrjType($p_value)
    {
        $this->prj_type = $p_value;
        return $this;
    }

    /**
     * Get prj_type
     *
     * @return string
     */
    public function getPrjType()
    {
        return $this->prj_type;
    }

    /**
     * Set prj_from
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Project
     */
    public function setPrjFrom($p_value)
    {
        $this->prj_from = $p_value;
        return $this;
    }

    /**
     * Get prj_from
     *
     * @return mixed
     */
    public function getPrjFrom()
    {
        return $this->prj_from;
    }

    /**
     * Set prj_to
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Project
     */
    public function setPrjTo($p_value)
    {
        $this->prj_to = $p_value;
        return $this;
    }

    /**
     * Get prj_to
     *
     * @return mixed
     */
    public function getPrjTo()
    {
        return $this->prj_to;
    }
}
