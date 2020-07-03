<?php
namespace FreePM\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model Project
 *
 * @author jeromeklam
 */
class Project extends \FreePM\Model\Base\Project
{

    /**
     * Behaviour
     */
    use \FreeSSO\Model\Behaviour\Group;

    /**
     * les version d'un projet
     *
     * @var [\FreePM\Model\ProjectVersion]
     */
    protected $versions = null;

    /**
     * Get Versions
     *
     * @return [\FreePM\Model\ProjectVersion]
     */
    public function getVersions()
    {
        if ($this->versions === null && $this->getPrjId() > 0) {
            $this->versions = new \FreeFW\Model\ResultSet();
            $conditions = new \FreeFW\Model\Conditions();
            $conditions->initFromArray(['prj_id' => $this->getPrjId()]);

            $model  = \FreeFW\DI\DI::get('FreePM::Model::ProjectVersion');
            $query  = $model->getQuery();
            $rels   = [];

            $query
                ->addConditions($conditions)
                ->addRelations($rels)
            ;

            if ($query->execute()) {
                $this->versions = $query->getResult();
            }

/*
            $result = new \FreeFW\Model\ResultSet();

            if ($query->execute()) {
                foreach ($query->getResult() as $key => $row) {
                    $result[] = $row;
                }
            }

            return $result;
*/
        }

        return $this->versions;
    }
}
