<?php
namespace FreePM\Model;

/**
 * Model ProjectVersionFile
 */
class ProjectVersionFile extends \FreePM\Model\Base\ProjectVersionFile
{

    /**
     * Comportements
     */
    use \FreePM\Model\Behaviour\Project;
    use \FreePM\Model\Behaviour\ProjectVersion;

    /**
     *
     * @return boolean
     */
    public function beforeRemove()
    {
        return true;
    }

    /**
     *
     * @return boolean
     */
    public function afterRemove()
    {
        if ($this->getPrjvfLink() !== '') {
            $ged = new \FreeEDMS\Core\Edms();

            $ged->setDocExternId($this->getPrjvfLink());

            if ($ged->removeFile(false) === false) {
                if ($ged->hasErrors()) {
                    $this->addErrors($ged->getErrors());
                }

                return false;
            } else {
                return true;
            }
        }

        return false;
    }
}
