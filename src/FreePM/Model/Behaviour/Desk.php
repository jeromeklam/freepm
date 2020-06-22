<?php
namespace FreePM\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Desk
{

    /**
     * Desk id
     * @var number
     */
    protected $desk_id = null;

    /**
     * Desk
     * @var \FreePM\Model\Desk
     */
    protected $desk = null;

    /**
     * Set desk
     *
     * @param \FreePM\Model\Desk $p_desk
     *
     * @return \FreeFW\Core\Model
     */
    public function setDesk($p_desk)
    {
        $this->desk = $p_desk;
        return $this;
    }

    /**
     * Get desk
     *
     * @return \FreePM\Model\Desk
     */
    public function getDesk()
    {
        if ($this->desk === null) {
            if ($this->desk_id > 0) {
                $this->desk = \FreePM\Model\Desk::findFirst(['desk_id' => $this->desk_id]);
            }
        }
        return $this->desk;
    }

    /**
     * Set desk id
     *
     * @param number $p_id
     *
     * @return \FreePM\Model\Behaviour\Desk
     */
    public function setStaId($p_id)
    {
        $this->desk_id = $p_id;
        if ($this->desk !== null) {
            if ($this->desk->getStaId() !== $this->getStaId()) {
                $this->desk = null;
            }
        }
        return $this;
    }

    /**
     * Get desk id
     *
     * @return number
     */
    public function getStaId()
    {
        return $this->desk_id;
    }
}
