<?php
namespace FreePM\Model\Base;

/**
 * Project
 *
 * @author ericmendez
 */
abstract class ProjectVersionFileUpload extends \FreePM\Model\StorageModel\ProjectVersionFileUpload
{

    /**
     * prjvf_pk
     * @var int
     */
    protected $prjvf_pk = null;

    /**
     * prjv_id
     * @var int
     */
    protected $prjv_id = null;

    /**
     * prjvf_file
     * @var string contient le nom complet du fichier
     */
    protected $prjvf_file = null;

    /**
     * prjvf_upload
     * @var string contient le contenu du fichier en base64
     */
    protected $prjvf_upload = null;

    /**
     * Set prjvf_pk
     * @param int $p_value
     * @return \FreePM\Model\ProjectVersionFileUpload
     */
    public function setPrjvfPk($p_value)
    {
        $this->prjvf_pk = $p_value;
        return $this;
    }
    /**
     * Get prjvf_pk
     * @return int
     */
    public function getPrjvfPk()
    {
        return $this->prjvf_pk;
    }

    /**
     * Set prjv_id
     * @param int $p_value
     * @return \FreePM\Model\ProjectVersionFileUpload
     */
    public function setPrjvId($p_value)
    {
        $this->prjv_id = $p_value;
        return $this;
    }
    /**
     * Get prjvf_pk
     * @return int
     */
    public function getPrjvId()
    {
        return $this->prjv_id;
    }

    /**
     * Set prjvf_file
     * @param string $p_value nom complet du fichier
     * @return \FreePM\Model\ProjectVersionFileUpload
     */
    public function setPrjvfFile($p_value)
    {
        $this->prjvf_file = $p_value;
        return $this;
    }
    /**
     * Get prjvf_File
     * @return string
     */
    public function getPrjvfFile()
    {
        return $this->prjvf_file;
    }

    /**
     * Set prjvf_upload
     * @param string $p_value
     * @return \FreePM\Model\ProjectVersionFileUpload
     */
    public function setPrjvfUpload($p_value)
    {
        $this->prjvf_upload = $p_value;
        return $this;
    }
    /**
     * Get prjvf_upload
     * @return string
     */
    public function getPrjvfUpload()
    {
        return $this->prjvf_upload;
    }
}
