<?php
namespace FreePM\Controller;

use \FreeFW\Constants as FFCST;

/**
 * Controller Project
 *
 * @author jeromeklam
 */
class Project extends \FreeFW\Core\ApiController
{

    /**
     * Retourne la liste des fichiers de la dernière version d'un projet
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param \Psr\Http\Message\ServerRequestInterface $p_int identifiant du projet
     * @return \Psr\Http\Message\Response
     */
    public function getLastVersion(\Psr\Http\Message\ServerRequestInterface $p_request, int $p_id)
    {
        $this->logger->debug('FreePM.Project.getlastVersion.start');

        if (!isset($p_request->default_model)) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
                );
        }

        if (!intval($p_id) > 0) {
            $this->logger->debug('FreePM.Project.getlastVersion.end project id is mandatory');
            return $this->createErrorResponse(FFCST::ERROR_ID_IS_MANDATORY);
        }

        /**
         * @var \FreePM\Model\Base\ProjectLastVersion $model
         * @var \FreePM\Model\Base\Project $prj
         * @var \FreePM\Model\Base\ProjectVersion $prjv
         * @var \FreePM\Model\Base\ProjectVersionFile $prjvf
         */

        /*
         * pour le moment, un getQuery avec des addRelations imbriquées à 2 niveaux ne fonctionne pas
         * on va donc faire 3 select successifs.
         */

        $prj = \FreeFW\DI\DI::get('FreePM::Model::Project');
        $prj = \FreePM\Model\Project::findFirst(
            [
                'prj_id' => $p_id
            ]
        );

        if (!$prj) {
            $this->logger->debug('FreePM.Project.getlastVersion.end project not found');
            return $this->createErrorResponse(FFCST::ERROR_NOT_FOUND);
        }

        $prjv = \FreeFW\DI\DI::get('FreePM::Model::ProjectVersion');
        $prjv = \FreePM\Model\ProjectVersion::findFirst(
            [
                'prj_id' => $p_id
            ],
            [
                'prjv_id' => \FreeFW\Storage\Storage::SORT_DESC
            ]
        );

        if (!$prjv) {
            $this->logger->debug('FreePM.Project.getlastVersion.end project_version not found');
            return $this->createErrorResponse(FFCST::ERROR_NOT_FOUND);
        }

        $prjvf = \FreeFW\DI\DI::get('FreePM::Model::ProjectVersionFile');
        $prjvf = \FreePM\Model\ProjectVersionFile::find(
            [
                'prjv_id' => $prjv->getPrjvId()
            ],
        );

        $result = new \FreeFW\Model\ResultSet();

        foreach ($prjvf as $row) {
            $onePrjvf = \FreeFW\DI\DI::get('FreePM::Model::ProjectLastVersion'); // new \FreePM\Model\ProjectLastVersion();

            $onePrjvf->setPrjPk(trim($prj->getPrjName()) . ', ' . trim($prjv->getPrjvVersion()));

            $onePrjvf
                ->setPrjName($prj->getPrjName())
                ->setPrjvVersion($prjv->getPrjvVersion())
                ->setPrjvfId($row->getPrjvfId())
                ->setPrjvfName($row->getPrjvfName())
                ->setPrjvfLink($row->getPrjvfLink());

            $result[] = $onePrjvf;
        }

        if (count($result) > 0) {
            $this->logger->debug('FreePM.Project.getlastVersion.end');
            return $this->createSuccessOkResponse($result);
        }

        $this->logger->debug('FreePM.Project.getlastVersion.end project_version_file not found');
        return $this->createErrorResponse(FFCST::ERROR_NOT_FOUND);
    }
}