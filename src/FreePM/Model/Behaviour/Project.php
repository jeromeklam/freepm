<?php
namespace FreePM\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Project
{

    /**
     * Project id
     * @var number
     */
    protected $prj_id = null;

    /**
     * Project
     * @var \FreePM\Model\Project
     */
    protected $project = null;

    /**
     * Set project
     *
     * @param \FreePM\Model\Project $p_project
     *
     * @return \FreeFW\Core\Model
     */
    public function setProject($p_project)
    {
        $this->project = $p_project;
        return $this;
    }

    /**
     * Get project
     *
     * @return \FreePM\Model\Project
     */
    public function getProject()
    {
        if ($this->project === null) {
            if ($this->prj_id > 0) {
                $this->project = \FreePM\Model\Project::findFirst(['prj_id' => $this->prj_id]);
            }
        }
        return $this->project;
    }

    /**
     * Set project id
     *
     * @param number $p_id
     *
     * @return \FreePM\Model\Behaviour\Project
     */
    public function setPrjId($p_id)
    {
        $this->prj_id = $p_id;
        if ($this->project !== null) {
            if ($this->project->getPrjId() !== $this->getPrjId()) {
                $this->project = null;
            }
        }
        return $this;
    }

    /**
     * Get project id
     *
     * @return number
     */
    public function getPrjId()
    {
        return $this->prj_id;
    }
}
