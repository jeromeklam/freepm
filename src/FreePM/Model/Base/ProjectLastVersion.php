<?php
namespace FreePM\Model\Base;

/**
 * Project
 *
 * @author ericmendez
 */
abstract class ProjectLastVersion extends \FreePM\Model\StorageModel\ProjectLastVersion
{

    /**
     * prjv_id
     * @var string
     */
    protected $prj_pk = null;

    /**
     * prj_name
     * @var string
     */
    protected $prj_name = null;

    /**
     * prjv_version
     * @var string
     */
    protected $prjv_version = null;

    /**
     * prjvf_id
     * @var int
     */
    protected $prjvf_id = null;

    /**
     * prjvf_name
     * @var string
     */
    protected $prjvf_name = null;

    /**
     * prjvf_link
     * @var string
     */
    protected $prjvf_link = null;

    /**
     * Set prj_pk
     * @param string $p_value
     * @return \FreePM\Model\ProjectLastVersion
     */
    public function setPrjPjk($p_value)
    {
        $this->prj_pk = $p_value;
        return $this;
    }
    /**
     * Get prj_pk
     * @return string
     */
    public function getPrjPk()
    {
        return $this->prj_pk;
    }

    /**
     * Set prj_name
     * @param string $p_value
     * @return \FreePM\Model\ProjectLastVersion
     */
    public function setPrjName($p_value)
    {
        $this->prj_name= $p_value;
        return $this;
    }
    /**
     * Get prj_name
     * @return string
     */
    public function getPrjName()
    {
        return $this->prj_name;
    }

    /**
     * Set prjv_version
     * @param string $p_value
     * @return \FreePM\Model\ProjectLastVersion
     */
    public function setPrjvVersion($p_value)
    {
        $this->prjv_version = $p_value;
        return $this;
    }
    /**
     * Get prjv_version
     * @return string
     */
    public function getPrjvVersion()
    {
        return $this->prjv_version;
    }

    /**
     * Set prjvf_id
     * @param int $p_value
     * @return \FreePM\Model\ProjectLastVersion
     */
    public function setPrjvfId($p_value)
    {
        $this->prjvf_id = $p_value;
        return $this;
    }
    /**
     * Get prjvf_id
     * @return int
     */
    public function getPrjvfId()
    {
        return $this->prjvf_id;
    }

    /**
     * Set prjvf_name
     * @param string $p_value
     * @return \FreePM\Model\ProjectLastVersion
     */
    public function setPrjvfName($p_value)
    {
        $this->prjvf_name = $p_value;
        return $this;
    }
    /**
     * Get prjvf_name
     * @return string
     */
    public function getPrjvfName()
    {
        return $this->prjvf_name;
    }

    /**
     * Set prjvf_link
     * @param string $p_value
     * @return \FreePM\Model\ProjectLastVersion
     */
    public function setPrjvfLink($p_value)
    {
        $this->prjvf_link = $p_value;
        return $this;
    }
    /**
     * Get prjv_link
     * @return string
     */
    public function getPrjvfLink()
    {
        return $this->prjvf_link;
    }
}