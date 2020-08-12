<?php
namespace FreePM\Model\Base;

/**
 * IssueCategory
 *
 * @author jeromeklam
 */
abstract class IssueCategory extends \FreePM\Model\StorageModel\IssueCategory
{

    /**
     * issc_id
     * @var int
     */
    protected $issc_id = null;

    /**
     * issc_name
     * @var string
     */
    protected $issc_name = null;

    /**
     * Set issc_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\IssueCategory
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
     * Set issc_name
     *
     * @param string $p_value
     *
     * @return \FreePM\Model\IssueCategory
     */
    public function setIsscName($p_value)
    {
        $this->issc_name = $p_value;
        return $this;
    }

    /**
     * Get issc_name
     *
     * @return string
     */
    public function getIsscName()
    {
        return $this->issc_name;
    }
}
