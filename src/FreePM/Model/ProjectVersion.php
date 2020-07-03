<?php
namespace FreePM\Model;

use \FreeFW\Constants as FFCST;

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
     * les fichiers d'une version
     *
     * @var [\FreePM\Model\ProjectVersionFile]
     */
    protected $files = null;

    /**
     * Get File d'une version
     *
     * @return [\FreePM\Model\ProjectVersionFile]
     */
    public function getFiles()
    {
        if ($this->files === null && $this->getPrjvId() > 0) {
            $this->files = new \FreeFW\Model\ResultSet();
            $conditions = new \FreeFW\Model\Conditions();

            $conditions->initFromArray(['prjv_id' => $this->getPrjvId()]);

            $model = \FreeFW\DI\DI::get('FreePM::Model::ProjectVersionFile');
            $query = $model->getQuery();
            $rels = []; // array('project_version');
            $query
                ->addConditions($conditions)
                ->addRelations($rels)
            ;

            if ($query->execute()) {
                $this->files = $query->getResult();
            }
        }

        return $this->files;
    }
}
