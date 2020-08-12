<?php
namespace FreePM\Model\Base;

/**
 * Feature
 *
 * @author jeromeklam
 */
abstract class Feature extends \FreePM\Model\StorageModel\Feature
{

    /**
     * feat_id
     * @var int
     */
    protected $feat_id = null;

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
     * prj_id
     * @var int
     */
    protected $prj_id = null;

    /**
     * prjv_id
     * @var int
     */
    protected $prjv_id = null;

    /**
     * user_id
     * @var int
     */
    protected $user_id = null;

    /**
     * jvs_user_id
     * @var int
     */
    protected $jvs_user_id = null;

    /**
     * sta_id
     * @var int
     */
    protected $sta_id = null;

    /**
     * feat_parent_id
     * @var int
     */
    protected $feat_parent_id = null;

    /**
     * feat_short
     * @var string
     */
    protected $feat_short = null;

    /**
     * feat_desc
     * @var mixed
     */
    protected $feat_desc = null;

    /**
     * feat_ts
     * @var mixed
     */
    protected $feat_ts = null;

    /**
     * feat_from
     * @var mixed
     */
    protected $feat_from = null;

    /**
     * feat_deadline
     * @var mixed
     */
    protected $feat_deadline = null;

    /**
     * feat_to
     * @var mixed
     */
    protected $feat_to = null;

    /**
     * feat_priority
     * @var int
     */
    protected $feat_priority = null;

    /**
     * feat_public
     * @var int
     */
    protected $feat_public = null;

    /**
     * feat_comm
     * @var mixed
     */
    protected $feat_comm = null;

    /**
     * feat_comm_priv
     * @var mixed
     */
    protected $feat_comm_priv = null;

    /**
     * feat_workload
     * @var int
     */
    protected $feat_workload = null;

    /**
     * feat_mail
     * @var int
     */
    protected $feat_mail = null;

    /**
     * nova_id
     * @var int
     */
    protected $nova_id = null;

    /**
     * feat_note_dev
     * @var string
     */
    protected $feat_note_dev = null;

    /**
     * feat_note_hl
     * @var string
     */
    protected $feat_note_hl = null;

    /**
     * feat_plan_form
     * @var mixed
     */
    protected $feat_plan_form = null;

    /**
     * feat_plan_to
     * @var mixed
     */
    protected $feat_plan_to = null;

    /**
     * Set feat_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatId($p_value)
    {
        $this->feat_id = $p_value;
        return $this;
    }

    /**
     * Get feat_id
     *
     * @return int
     */
    public function getFeatId()
    {
        return $this->feat_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
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
     * @return \FreePM\Model\Feature
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
     * Set prj_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
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
     * Set prjv_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
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
     * Set user_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
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
     * Set jvs_user_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setJvsUserId($p_value)
    {
        $this->jvs_user_id = $p_value;
        return $this;
    }

    /**
     * Get jvs_user_id
     *
     * @return int
     */
    public function getJvsUserId()
    {
        return $this->jvs_user_id;
    }

    /**
     * Set sta_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setStaId($p_value)
    {
        $this->sta_id = $p_value;
        return $this;
    }

    /**
     * Get sta_id
     *
     * @return int
     */
    public function getStaId()
    {
        return $this->sta_id;
    }

    /**
     * Set feat_parent_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatParentId($p_value)
    {
        $this->feat_parent_id = $p_value;
        return $this;
    }

    /**
     * Get feat_parent_id
     *
     * @return int
     */
    public function getFeatParentId()
    {
        return $this->feat_parent_id;
    }

    /**
     * Set feat_short
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatShort($p_value)
    {
        $this->feat_short = $p_value;
        return $this;
    }

    /**
     * Get feat_short
     *
     * @return string
     */
    public function getFeatShort()
    {
        return $this->feat_short;
    }

    /**
     * Set feat_desc
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatDesc($p_value)
    {
        $this->feat_desc = $p_value;
        return $this;
    }

    /**
     * Get feat_desc
     *
     * @return mixed
     */
    public function getFeatDesc()
    {
        return $this->feat_desc;
    }

    /**
     * Set feat_ts
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatTs($p_value)
    {
        $this->feat_ts = $p_value;
        return $this;
    }

    /**
     * Get feat_ts
     *
     * @return mixed
     */
    public function getFeatTs()
    {
        return $this->feat_ts;
    }

    /**
     * Set feat_from
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatFrom($p_value)
    {
        $this->feat_from = $p_value;
        return $this;
    }

    /**
     * Get feat_from
     *
     * @return mixed
     */
    public function getFeatFrom()
    {
        return $this->feat_from;
    }

    /**
     * Set feat_deadline
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatDeadline($p_value)
    {
        $this->feat_deadline = $p_value;
        return $this;
    }

    /**
     * Get feat_deadline
     *
     * @return mixed
     */
    public function getFeatDeadline()
    {
        return $this->feat_deadline;
    }

    /**
     * Set feat_to
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatTo($p_value)
    {
        $this->feat_to = $p_value;
        return $this;
    }

    /**
     * Get feat_to
     *
     * @return mixed
     */
    public function getFeatTo()
    {
        return $this->feat_to;
    }

    /**
     * Set feat_priority
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatPriority($p_value)
    {
        $this->feat_priority = $p_value;
        return $this;
    }

    /**
     * Get feat_priority
     *
     * @return int
     */
    public function getFeatPriority()
    {
        return $this->feat_priority;
    }

    /**
     * Set feat_public
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatPublic($p_value)
    {
        $this->feat_public = $p_value;
        return $this;
    }

    /**
     * Get feat_public
     *
     * @return int
     */
    public function getFeatPublic()
    {
        return $this->feat_public;
    }

    /**
     * Set feat_comm
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatComm($p_value)
    {
        $this->feat_comm = $p_value;
        return $this;
    }

    /**
     * Get feat_comm
     *
     * @return mixed
     */
    public function getFeatComm()
    {
        return $this->feat_comm;
    }

    /**
     * Set feat_comm_priv
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatCommPriv($p_value)
    {
        $this->feat_comm_priv = $p_value;
        return $this;
    }

    /**
     * Get feat_comm_priv
     *
     * @return mixed
     */
    public function getFeatCommPriv()
    {
        return $this->feat_comm_priv;
    }

    /**
     * Set feat_workload
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatWorkload($p_value)
    {
        $this->feat_workload = $p_value;
        return $this;
    }

    /**
     * Get feat_workload
     *
     * @return int
     */
    public function getFeatWorkload()
    {
        return $this->feat_workload;
    }

    /**
     * Set feat_mail
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatMail($p_value)
    {
        $this->feat_mail = $p_value;
        return $this;
    }

    /**
     * Get feat_mail
     *
     * @return int
     */
    public function getFeatMail()
    {
        return $this->feat_mail;
    }

    /**
     * Set nova_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setNovaId($p_value)
    {
        $this->nova_id = $p_value;
        return $this;
    }

    /**
     * Get nova_id
     *
     * @return int
     */
    public function getNovaId()
    {
        return $this->nova_id;
    }

    /**
     * Set feat_note_dev
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatNoteDev($p_value)
    {
        $this->feat_note_dev = $p_value;
        return $this;
    }

    /**
     * Get feat_note_dev
     *
     * @return string
     */
    public function getFeatNoteDev()
    {
        return $this->feat_note_dev;
    }

    /**
     * Set feat_note_hl
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatNoteHl($p_value)
    {
        $this->feat_note_hl = $p_value;
        return $this;
    }

    /**
     * Get feat_note_hl
     *
     * @return string
     */
    public function getFeatNoteHl()
    {
        return $this->feat_note_hl;
    }

    /**
     * Set feat_plan_form
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatPlanForm($p_value)
    {
        $this->feat_plan_form = $p_value;
        return $this;
    }

    /**
     * Get feat_plan_form
     *
     * @return mixed
     */
    public function getFeatPlanForm()
    {
        return $this->feat_plan_form;
    }

    /**
     * Set feat_plan_to
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\Feature
     */
    public function setFeatPlanTo($p_value)
    {
        $this->feat_plan_to = $p_value;
        return $this;
    }

    /**
     * Get feat_plan_to
     *
     * @return mixed
     */
    public function getFeatPlanTo()
    {
        return $this->feat_plan_to;
    }
}
