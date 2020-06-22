<?php
namespace FreePM\Model\Base;

/**
 * Project
 *
 * @author ericmendez
 */
abstract class ProjectVersion extends \FreePM\Model\StorageModel\ProjectVersion
{

    /**
     * prjv_id
     * @var int
     */
    protected $prjv_id = null;
    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;
    /**
     * prj_id
     * @var int
     */
    protected $prj_id = null;
    /**
     * prjv_type
     * @var string contient le type de version (REAL,TEST,BETA,ALPHA,DEV)
     */
    protected $prjv_type = null;
    /**
     * prjv_version
     * @var string
     */
    protected $prjv_version = null;
    /**
     * prj_from
     * @var mixed
     */
    protected $prjv_from = null;
    /**
     * prj_to
     * @var mixed
     */
    protected $prjv_tp = null;
    /**
     * prj_to
     * @var bool
     */
    protected $prjv_beta_test = null;
    /**
     * Set prjv_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\ProjectVersion
     */
    public function setPrjvId($p_value)
    {
        $this->prjv_id = $p_value;
        return $this;
    }
    /**
     * Get prjv_id
     *
     * @return int
     */
    public function getPrjvId()
    {
        return $this->prjv_id;
    }
    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\ProjectVersion
     */
    public function setBrkId($p_value)
    {
        $this->brk_id = $p_value;
        return $this;
    }
    /**
     * Get prj_id
     *
     * @return int
     */
    public function getBrkId()
    {
        return $this->brk_id;
    }
    /**
     * Set prj_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\ProjectVersion
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
     * Set prjv_type
     *
     * @param string $p_value liste de valeurs autorisées : REAL,TEST,BETA,ALPHA ou DEV
     *
     * @return \FreePM\Model\Projectversion
     */
    public function setPrjvType($p_value)
    {
        $this->prjv_type = $p_value;
        return $this;
    }
    /**
     * Get prjv_type
     *
     * @return string
     * @example example de retour : REAL,TEST,BETA,ALPHA ou DEV
     */
    public function getPrjvType()
    {
        return $this->prjv_type;
    }
    /**
     * Set prjv_version
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Projectversion
     */
    public function setPrjvVersion($p_value)
    {
        $this->prjv_version = $p_value;
        return $this;
    }
    /**
     * Get prjv_version
     *
     * @return string
     */
    public function getPrjvVersion()
    {
        return $this->prjv_version;
    }
    /**
     * Set prjv_from
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\ProjectVersion
     */
    public function setPrjvFrom($p_value)
    {
        $this->prjv_from = $p_value;
        return $this;
    }
    /**
     * Get prjv_from
     *
     * @return mixed
     */
    public function getPrjvFrom()
    {
        return $this->prjv_from;
    }
    /**
     * Set prjv_tp
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\ProjectVersion
     */
    public function setPrjvTp($p_value)
    {
        $this->prjv_tp = $p_value;
        return $this;
    }
    /**
     * Get prjv_tp
     *
     * @return mixed
     */
    public function getPrjvTp()
    {
        return $this->prjv_tp;
    }
    /**
     * Set prjv_beta_test
     *
     * @param bool $p_value
     *
     * @return \FreePM\Model\Projectversion
     */
    public function setPrjvBetaTest($p_value)
    {
        $this->prjv_beta_test = $p_value;
        return $this;
    }
    /**
     * Get prjv_beta_test
     *
     * @return bool
     */
    public function getPrjvBetatest()
    {
        return $this->prjv_beta_test;
    }
}
