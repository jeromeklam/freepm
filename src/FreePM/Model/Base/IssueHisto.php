<?php
namespace FreePM\Model\Base;

/**
 * IssueHisto
 *
 * @author jeromeklam
 */
abstract class IssueHisto extends \FreePM\Model\StorageModel\IssueHisto
{

    /**
     * issh_id
     * @var int
     */
    protected $issh_id = null;

    /**
     * iss_id
     * @var int
     */
    protected $iss_id = null;

    /**
     * user_id
     * @var int
     */
    protected $user_id = null;

    /**
     * user_jvs_id
     * @var int
     */
    protected $user_jvs_id = null;

    /**
     * next_user_jvs_id
     * @var int
     */
    protected $next_user_jvs_id = null;

    /**
     * issh_from
     * @var mixed
     */
    protected $issh_from = null;

    /**
     * issh_to
     * @var mixed
     */
    protected $issh_to = null;

    /**
     * issh_comm
     * @var mixed
     */
    protected $issh_comm = null;

    /**
     * issh_comm_priv
     * @var mixed
     */
    protected $issh_comm_priv = null;

    /**
     * issh_status
     * @var string
     */
    protected $issh_status = null;

    /**
     * issh_duration
     * @var int
     */
    protected $issh_duration = null;

    /**
     * issh_deadline
     * @var mixed
     */
    protected $issh_deadline = null;

    /**
     * issh_mail
     * @var int
     */
    protected $issh_mail = null;

    /**
     * issh_way
     * @var string
     */
    protected $issh_way = null;

    /**
     * Set issh_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setIsshId($p_value)
    {
        $this->issh_id = $p_value;
        return $this;
    }

    /**
     * Get issh_id
     *
     * @return int
     */
    public function getIsshId()
    {
        return $this->issh_id;
    }

    /**
     * Set iss_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\IssueHisto
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
     * Set user_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\IssueHisto
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
     * Set user_jvs_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\IssueHisto
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
     * Set next_user_jvs_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setNextUserJvsId($p_value)
    {
        $this->next_user_jvs_id = $p_value;
        return $this;
    }

    /**
     * Get next_user_jvs_id
     *
     * @return int
     */
    public function getNextUserJvsId()
    {
        return $this->next_user_jvs_id;
    }

    /**
     * Set issh_from
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setIsshFrom($p_value)
    {
        $this->issh_from = $p_value;
        return $this;
    }

    /**
     * Get issh_from
     *
     * @return mixed
     */
    public function getIsshFrom()
    {
        return $this->issh_from;
    }

    /**
     * Set issh_to
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setIsshTo($p_value)
    {
        $this->issh_to = $p_value;
        return $this;
    }

    /**
     * Get issh_to
     *
     * @return mixed
     */
    public function getIsshTo()
    {
        return $this->issh_to;
    }

    /**
     * Set issh_comm
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setIsshComm($p_value)
    {
        $this->issh_comm = $p_value;
        return $this;
    }

    /**
     * Get issh_comm
     *
     * @return mixed
     */
    public function getIsshComm()
    {
        return $this->issh_comm;
    }

    /**
     * Set issh_comm_priv
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setIsshCommPriv($p_value)
    {
        $this->issh_comm_priv = $p_value;
        return $this;
    }

    /**
     * Get issh_comm_priv
     *
     * @return mixed
     */
    public function getIsshCommPriv()
    {
        return $this->issh_comm_priv;
    }

    /**
     * Set issh_status
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setIsshStatus($p_value)
    {
        $this->issh_status = $p_value;
        return $this;
    }

    /**
     * Get issh_status
     *
     * @return string
     */
    public function getIsshStatus()
    {
        return $this->issh_status;
    }

    /**
     * Set issh_duration
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setIsshDuration($p_value)
    {
        $this->issh_duration = $p_value;
        return $this;
    }

    /**
     * Get issh_duration
     *
     * @return int
     */
    public function getIsshDuration()
    {
        return $this->issh_duration;
    }

    /**
     * Set issh_deadline
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setIsshDeadline($p_value)
    {
        $this->issh_deadline = $p_value;
        return $this;
    }

    /**
     * Get issh_deadline
     *
     * @return mixed
     */
    public function getIsshDeadline()
    {
        return $this->issh_deadline;
    }

    /**
     * Set issh_mail
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setIsshMail($p_value)
    {
        $this->issh_mail = $p_value;
        return $this;
    }

    /**
     * Get issh_mail
     *
     * @return int
     */
    public function getIsshMail()
    {
        return $this->issh_mail;
    }

    /**
     * Set issh_way
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\IssueHisto
     */
    public function setIsshWay($p_value)
    {
        $this->issh_way = $p_value;
        return $this;
    }

    /**
     * Get issh_way
     *
     * @return string
     */
    public function getIsshWay()
    {
        return $this->issh_way;
    }
}
