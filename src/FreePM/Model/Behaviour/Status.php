<?php
namespace FreePM\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Status
{

    /**
     * Status id
     * @var number
     */
    protected $sta_id = null;

    /**
     * Status
     * @var \FreePM\Model\Status
     */
    protected $status = null;

    /**
     * Set status
     *
     * @param \FreePM\Model\Status $p_status
     *
     * @return \FreeFW\Core\Model
     */
    public function setStatus($p_status)
    {
        $this->status = $p_status;
        return $this;
    }

    /**
     * Get status
     *
     * @return \FreePM\Model\Status
     */
    public function getStatus()
    {
        if ($this->status === null) {
            if ($this->sta_id > 0) {
                $this->status = \FreePM\Model\Status::findFirst(['sta_id' => $this->sta_id]);
            }
        }
        return $this->status;
    }

    /**
     * Set status id
     *
     * @param number $p_id
     *
     * @return \FreePM\Model\Behaviour\Status
     */
    public function setStaId($p_id)
    {
        $this->sta_id = $p_id;
        if ($this->status !== null) {
            if ($this->status->getStaId() !== $this->getStaId()) {
                $this->status = null;
            }
        }
        return $this;
    }

    /**
     * Get status id
     *
     * @return number
     */
    public function getStaId()
    {
        return $this->sta_id;
    }
}
