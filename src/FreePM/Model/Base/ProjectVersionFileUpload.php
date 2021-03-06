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
     * @var string
     */
    protected $prjvf_upload = null;
    /**
     * content_file est affecté lorsque prjvf_upload est affecté
     * @desc ce pointeur évite les copies en mémoire. cela peut vite devenir gourmant !
     * @var string <b>pointeur</b> vers $prjvf_upload
     */
    public $content_file = null;

    /**
     * prjvf_desc
     * @var string
     */
    protected $prjvf_desc = null;

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
        $this->content_file = &$this->prjvf_upload;
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

    /**
     * Set prjvf_desc
     * @param string $p_value
     * @return \FreePM\Model\ProjectVersionFileUpload
     */
    public function setPrjvfDesc($p_value)
    {
        $this->prjvf_desc = $p_value;
        return $this;
    }
    /**
     * Get prjvf_desc
     * @return string
     */
    public function getPrjvfDesc()
    {
        return $this->prjvf_desc;
    }
}
