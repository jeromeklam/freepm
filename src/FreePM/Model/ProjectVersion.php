<?php
namespace FreePM\Model;

use \FreeFW\Constants as FFCST;
use \FreePM\Constants as FPCST;

/**
 * Model Project
 *
 * @author ericmendez
 */
class ProjectVersion extends \FreePM\Model\Base\ProjectVersion
{

    /**
     * Behaviour
     */
    use \FreePM\Model\Behaviour\Project;
    /**
     * Validation
     *
     * @return void
     */
    public function validate()
    {
        // on interdit 2 fois le même numero de version pour un même projet.
        //
        $version = \FreePM\Model\ProjectVersion::findFirst(
            [
                'prj_id'        => [\FreeFW\Storage\Storage::COND_EQUAL => $this->getPrjId()],
                'prjv_id'       => [\FreeFW\Storage\Storage::COND_NOT_EQUAL => $this->getPrjvId()],
                'prjv_version'  => [\FreeFW\Storage\Storage::COND_EQUAL => $this->getPrjvVersion()]
            ]
        );
        //
        if ($version instanceof ProjectVersion) {
            $test   = 'prjv_version';
            $props  = $this->getProperties();
            //
            if (array_key_exists($test, $props)) {
                if (array_key_exists(FFCST::PROPERTY_PUBLIC, $props[$test])) {
                    $test = $props[$test][FFCST::PROPERTY_PUBLIC];
                }
            }
            //
            $this->addError(
                FPCST::ERROR_VERSION_NUMBER_EXISTS,
                sprintf('There is already a version %s for this project', $this->getPrjvVersion()),
                \FreeFW\Core\Error::TYPE_PRECONDITION,
                $test
            );
        } else {
            parent::validate();
        }
    }
}
