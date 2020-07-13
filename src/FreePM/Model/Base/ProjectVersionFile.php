<?php
namespace FreePM\Model\Base;

/**
 * Project
 *
 * @author ericmendez
 */
abstract class ProjectVersionFile extends \FreePM\Model\StorageModel\ProjectVersionFile
{

    /**
     * prjvf_id
     * @var int
     */
    protected $prjvf_id = null;

    /**
     * prjv_id
     * @var int
     */
    protected $prjv_id = null;

    /**
     * prjv_name
     * @var string contient le nom du fichier
     */
    protected $prjvf_name = null;

    /**
     * prjv_link
     * @var string contient le lien avec l'extérieur
     */
    protected $prjvf_link = null;

    /**
     * Set prjvf_id
     * @param int $p_value
     * @return \FreePM\Model\ProjectVersionFile
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
     * Set prjv_id
     * @param int $p_value
     * @return \FreePM\Model\ProjectVersionFile
     */
    public function setPrjvId($p_value)
    {
        $this->prjv_id = $p_value;
        return $this;
    }
    /**
     * Get prjv_id
     * @return int
     */
    public function getPrjvId()
    {
        return $this->prjv_id;
    }

    /**
     * Set prjvf_name
     * @param string $p_value nom du fichier
     * @return \FreePM\Model\ProjectversionFile
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
     * @return \FreePM\Model\ProjectversionFile
     */
    public function setPrjvfLink($p_value)
    {
        $this->prjvf_link = $p_value;
        return $this;
    }
    /**
     * Get prjvf_link
     * @return string
     */
    public function getPrjvfLink()
    {
        return $this->prjvf_link;
    }
}
