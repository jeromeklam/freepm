<?php
namespace FreePM\Controller;

use \FreeFW\Constants as FFCST;

/**
 * Controller ProjectVersionFile
 *
 * @author ericmendez
 */
class ProjectVersionFile extends \FreeFW\Core\ApiController
{

    /**
     * @desc Copie un fichier encoder en base64 dans la ged,
     * <br>puis mets à jour pm_project_version_file. si une erreur intervient il est supprimer de la ged.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @throws \FreeFW\Core\FreeFWStorageException
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function uploadFile(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->_debug(__METHOD__, 'start');

        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if (!isset($p_request->default_model)) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }

        $data = null;
        $code = FFCST::ERROR_NO_DATA; // 409

        if ($apiParams->hasData()) {
            /**
             * @var \FreePM\Model\ProjectVersionFileUpload $data
             */
            $data = $apiParams->getData();

            $ged = new \FreeEDMS\Core\Edms();

            $ged
                ->setDocFilename($data->getPrjvfFile())
                ->setContentFile($data->content_file)
                ->setDocOrigTheme('PM')
                ->setDocOrigType('VERSFILE')
                ->setDocOrigAnyid(md5(uniqid(microtime(true),true)))
                ->setDocDesc($data->getPrjvfDesc())
            ;

            if ($ged->addFile() === false) {
                if (!$ged->hasErrors()) {
                    $data = null;
                } else {
                    $data = $apiParams->getApiModel($p_request->default_model);
                    $data->addErrors($ged->getErrors());
                }

                $code = FFCST::ERROR_NOT_INSERT; // 412
            } else {
                /**
                 * @var \FreePM\Model\ProjectVersionFile $prjvf
                 */
                $prjvf = \FreeFW\DI\DI::get('FreePM::Model::ProjectVersionFile');

                $prjvf
                    ->setPrjvId($data->getPrjvId())
                    ->setPrjvfName($ged->getDocFilename())
                    ->setPrjvfLink($ged->getDocExternId())
                ;

                if ($prjvf->create()) {
                    $data = $this->getModelById($apiParams, $prjvf, $prjvf->getApiId());

                    $this->_debug(__METHOD__, 'end');
                    return $this->createSuccessAddResponse($data); // 201
                } else {
                    $ged->removeFile();

                    if (!$prjvf->hasErrors()) {
                        $data = null; // erreur en provenance du create. donc de $prvjf
                    } else {
                        $data = $prjvf;
                    }

                    $code = FFCST::ERROR_NOT_INSERT; // 412
                } // if $prjvf->create
            } // if $ged->addFile
        }

        $this->_debug(__METHOD__, 'end with error');
        return $this->createErrorResponse($code, $data);
    }

    /**
     * @desc Renvoie un fichier de la ged.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param int $p_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function downloadFile(\Psr\Http\Message\ServerRequestInterface $p_request, int $p_id)
    {
        $this->_debug(__METHOD__, 'start');

        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if (!isset($p_request->default_model)) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }

        $data = null;
        $code = null;

        if (!intval($p_id) > 0) {
            $code = FFCST::ERROR_ID_IS_MANDATORY;
        } else {
            /**
             * @var \FreePM\Model\Base\ProjectVersionFile $prjvf
             */
            $prjvf = \FreePM\Model\ProjectVersionFile::findFirst(
                [
                    'prjvf_id' => $p_id
                ]
            );

            if (!$prjvf) {
                $code = FFCST::ERROR_NOT_FOUND;
            } else {
                $ged = new \FreeEDMS\Core\Edms();

                if ($ged->getFile($prjvf->getPrjvfLink()) === false) {
                    if (!$ged->hasErrors()) {
                        $data = null;
                    } else {
                        $data = $apiParams->getApiModel($p_request->default_model);
                        $data->addErrors($ged->getErrors());
                    }

                    $code = FFCST::ERROR_NOT_FOUND;
                } else {
                    $this->_debug(__METHOD__, 'end');

                    return $this->createMimeTypeResponse(
                        $ged->getDocFilename(),
                        $ged->getContentFile()
                    );
                }
            }
        }

        $this->_debug(__METHOD__, 'end with error');
        return $this->createErrorResponse(FFCST::ERROR_NOT_FOUND, $data); // on retourne toujours un 404
    }

    /**
     * laisse une trace...
     *
     * @param string $p_who correspond à la méthode qui est en cours
     * @param string $p_message correspond au message qu'on désire tracer !
     * @param array $p_context
     */
    protected function _debug(string $p_who, string $p_message, array $p_context = array())
    {
        $this->logger->debug(
            str_replace(array('\\', '::'), array('.', '.'), $p_who)
            . '.' . $p_message,
            $p_context
        );
    }
}
