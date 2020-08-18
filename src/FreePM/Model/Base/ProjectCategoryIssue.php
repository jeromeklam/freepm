<?php
namespace FreePM\Model\Base;

/**
 * ProjectCategoryIssue
 *
 * @author jeromeklam
 */
abstract class ProjectCategoryIssue extends \FreePM\Model\StorageModel\ProjectCategoryIssue
{

    /**
     * prjci_id
     * @var int
     */
    protected $prjci_id = null;

    /**
     * prj_id
     * @var int
     */
    protected $prj_id = null;

    /**
     * prjci_name
     * @var string
     */
    protected $prjci_name = null;

    /**
     * Set prjci_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\ProjectCategoryIssue
     */
    public function setPrjciId($p_value)
    {
        $this->prjci_id = $p_value;
        return $this;
    }

    /**
     * Get prjci_id
     *
     * @return int
     */
    public function getPrjciId()
    {
        return $this->prjci_id;
    }

    /**
     * Set prj_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\ProjectCategoryIssue
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
     * Set prjci_name
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\ProjectCategoryIssue
     */
    public function setPrjciName($p_value)
    {
        $this->prjci_name = $p_value;
        return $this;
    }

    /**
     * Get prjci_name
     *
     * @return string
     */
    public function getPrjciName()
    {
        return $this->prjci_name;
    }
}
