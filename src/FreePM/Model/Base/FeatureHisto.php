<?php
namespace FreePM\Model\Base;

/**
 * FeatureHisto
 *
 * @author jeromeklam
 */
abstract class FeatureHisto extends \FreePM\Model\StorageModel\FeatureHisto
{

    /**
     * feath_id
     * @var int
     */
    protected $feath_id = null;

    /**
     * feat_id
     * @var int
     */
    protected $feat_id = null;

    /**
     * sta_id
     * @var int
     */
    protected $sta_id = null;

    /**
     * feath_ts
     * @var mixed
     */
    protected $feath_ts = null;

    /**
     * feath_name
     * @var mixed
     */
    protected $feath_name = null;

    /**
     * Set feath_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\FeatureHisto
     */
    public function setFeathId($p_value)
    {
        $this->feath_id = $p_value;
        return $this;
    }

    /**
     * Get feath_id
     *
     * @return int
     */
    public function getFeathId()
    {
        return $this->feath_id;
    }

    /**
     * Set feat_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\FeatureHisto
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
     * Set sta_id
     *
     * @param int $p_value
     *
     * @return \FreePM\Model\FeatureHisto
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
     * Set feath_ts
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\FeatureHisto
     */
    public function setFeathTs($p_value)
    {
        $this->feath_ts = $p_value;
        return $this;
    }

    /**
     * Get feath_ts
     *
     * @return mixed
     */
    public function getFeathTs()
    {
        return $this->feath_ts;
    }

    /**
     * Set feath_name
     *
     * @param mixed $p_value
     *
     * @return \FreePM\Model\FeatureHisto
     */
    public function setFeathName($p_value)
    {
        $this->feath_name = $p_value;
        return $this;
    }

    /**
     * Get feath_name
     *
     * @return mixed
     */
    public function getFeathName()
    {
        return $this->feath_name;
    }
}
