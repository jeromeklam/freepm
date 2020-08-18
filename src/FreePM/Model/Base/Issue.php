<?php
namespace FreePM\Model\Base;

/**
 * Issue
 *
 * @author jeromeklam
 */
abstract class Issue extends \FreePM\Model\StorageModel\Issue
{

    /**
     * iss_id
     * @var int
     */
    protected $iss_id = null;

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
     * current_user_id
     * @var int
     */
    protected $current_user_id = null;

    /**
     * user_jvs_id
     * @var int
     */
    protected $user_jvs_id = null;

    /**
     * current_user_jvs_id
     * @var int
     */
    protected $current_user_jvs_id = null;

    /**
     * close_user_id
     * @var int
     */
    protected $close_user_id = null;

    /**
     * close_user_jvs_id
     * @var int
     */
    protected $close_user_jvs_id = null;

    /**
     * prj_id
     * @var int
     */
    protected $prj_id = null;

    /**
     * issc_id
     * @var int
     */
    protected $issc_id = null;

    /**
     * prjci_id
     * @var int
     */
    protected $prjci_id = null;

    /**
     * iss_from
     * @var mixed
     */
    protected $iss_from = null;

    /**
     * iss_ts
     * @var mixed
     */
    protected $iss_ts = null;

    /**
     * iss_deadline
     * @var mixed
     */
    protected $iss_deadline = null;

    /**
     * iss_to
     * @var mixed
     */
    protected $iss_to = null;

    /**
     * iss_status
     * @var string
     */
    protected $iss_status = null;

    /**
     * iss_nb_call
     * @var int
     */
    protected $iss_nb_call = null;

    /**
     * iss_priority
     * @var string
     */
    protected $iss_priority = null;

    /**
     * iss_feature
     * @var int
     */
    protected $iss_feature = null;

    /**
     * iss_duration
     * @var int
     */
    protected $iss_duration = null;

    /**
     * Set iss_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIssId($p_value)
    {
        $this->iss_id = $p_value;
        return $this;
    }

    /**
     * Get iss_id
     *
     * @return int
     */
    public function getIssId()
    {
        return $this->iss_id;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
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
     * @return \FreePM\Model\Issue
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
     * Set current_user_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setCurrentUserId($p_value)
    {
        $this->current_user_id = $p_value;
        return $this;
    }

    /**
     * Get current_user_id
     *
     * @return int
     */
    public function getCurrentUserId()
    {
        return $this->current_user_id;
    }

    /**
     * Set user_jvs_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setUserJvsId($p_value)
    {
        $this->user_jvs_id = $p_value;
        return $this;
    }

    /**
     * Get user_jvs_id
     *
     * @return int
     */
    public function getUserJvsId()
    {
        return $this->user_jvs_id;
    }

    /**
     * Set current_user_jvs_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setCurrentUserJvsId($p_value)
    {
        $this->current_user_jvs_id = $p_value;
        return $this;
    }

    /**
     * Get current_user_jvs_id
     *
     * @return int
     */
    public function getCurrentUserJvsId()
    {
        return $this->current_user_jvs_id;
    }

    /**
     * Set close_user_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setCloseUserId($p_value)
    {
        $this->close_user_id = $p_value;
        return $this;
    }

    /**
     * Get close_user_id
     *
     * @return int
     */
    public function getCloseUserId()
    {
        return $this->close_user_id;
    }

    /**
     * Set close_user_jvs_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setCloseUserJvsId($p_value)
    {
        $this->close_user_jvs_id = $p_value;
        return $this;
    }

    /**
     * Get close_user_jvs_id
     *
     * @return int
     */
    public function getCloseUserJvsId()
    {
        return $this->close_user_jvs_id;
    }

    /**
     * Set prj_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
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
     * Set issc_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIsscId($p_value)
    {
        $this->issc_id = $p_value;
        return $this;
    }

    /**
     * Get issc_id
     *
     * @return int
     */
    public function getIsscId()
    {
        return $this->issc_id;
    }

    /**
     * Set prjci_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
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
     * Set iss_from
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIssFrom($p_value)
    {
        $this->iss_from = $p_value;
        return $this;
    }

    /**
     * Get iss_from
     *
     * @return mixed
     */
    public function getIssFrom()
    {
        return $this->iss_from;
    }

    /**
     * Set iss_ts
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIssTs($p_value)
    {
        $this->iss_ts = $p_value;
        return $this;
    }

    /**
     * Get iss_ts
     *
     * @return mixed
     */
    public function getIssTs()
    {
        return $this->iss_ts;
    }

    /**
     * Set iss_deadline
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIssDeadline($p_value)
    {
        $this->iss_deadline = $p_value;
        return $this;
    }

    /**
     * Get iss_deadline
     *
     * @return mixed
     */
    public function getIssDeadline()
    {
        return $this->iss_deadline;
    }

    /**
     * Set iss_to
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIssTo($p_value)
    {
        $this->iss_to = $p_value;
        return $this;
    }

    /**
     * Get iss_to
     *
     * @return mixed
     */
    public function getIssTo()
    {
        return $this->iss_to;
    }

    /**
     * Set iss_status
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIssStatus($p_value)
    {
        $this->iss_status = $p_value;
        return $this;
    }

    /**
     * Get iss_status
     *
     * @return string
     */
    public function getIssStatus()
    {
        return $this->iss_status;
    }

    /**
     * Set iss_nb_call
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIssNbCall($p_value)
    {
        $this->iss_nb_call = $p_value;
        return $this;
    }

    /**
     * Get iss_nb_call
     *
     * @return int
     */
    public function getIssNbCall()
    {
        return $this->iss_nb_call;
    }

    /**
     * Set iss_priority
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIssPriority($p_value)
    {
        $this->iss_priority = $p_value;
        return $this;
    }

    /**
     * Get iss_priority
     *
     * @return string
     */
    public function getIssPriority()
    {
        return $this->iss_priority;
    }

    /**
     * Set iss_feature
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIssFeature($p_value)
    {
        $this->iss_feature = $p_value;
        return $this;
    }

    /**
     * Get iss_feature
     *
     * @return int
     */
    public function getIssFeature()
    {
        return $this->iss_feature;
    }

    /**
     * Set iss_duration
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Issue
     */
    public function setIssDuration($p_value)
    {
        $this->iss_duration = $p_value;
        return $this;
    }

    /**
     * Get iss_duration
     *
     * @return int
     */
    public function getIssDuration()
    {
        return $this->iss_duration;
    }
}
