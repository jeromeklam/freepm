<?php
namespace FreePM\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait ProjectVersion
{

    /**
     * Project version id
     * @var number
     */
    protected $prjv_id = null;

    /**
     * Project
     * @var \FreePM\Model\ProjectVersion
     */
    protected $project_version = null;

    /**
     * Set project version
     *
     * @param \FreePM\Model\ProjectVersion $p_project_version
     *
     * @return \FreeFW\Core\Model
     */
    public function setProjectVersion($p_project_version)
    {
        $this->project_version = $p_project_version;
        return $this;
    }

    /**
     * Get project version
     *
     * @return \FreePM\Model\ProjectVersion
     */
    public function getProjectVersion()
    {
        if ($this->project_version === null) {
            if ($this->prjv_id > 0) {
                $this->project_version = \FreePM\Model\Project::findFirst(['prjv_id' => $this->prjv_id]);
            }
        }
        return $this->project_version;
    }

    /**
     * Set project version id
     *
     * @param number $p_id
     *
     * @return \FreePM\Model\Behaviour\ProjectVersion
     */
    public function setPrjvId($p_id)
    {
        $this->prjv_id = $p_id;
        if ($this->project_version !== null) {
            if ($this->project_version->getPrjvId() !== $this->getPrjvId()) {
                $this->project_version = null;
            }
        }
        return $this;
    }

    /**
     * Get project version id
     *
     * @return number
     */
    public function getPrjvId()
    {
        return $this->prjv_id;
    }
}
