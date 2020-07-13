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
     * Récupére un fichier avec son contenu
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function downloadFile(\Psr\Http\Message\ServerRequestInterface $p_request, int $p_id) // NVT 291074
    {
        $this->logger->debug('FreePM.ProjectVersionFile.downloadFile.start');

        if (!intval($p_id) > 0) {
            $this->logger->debug('FreePM.ProjectVersionFile.downloadFile.end project_version_file id is mandatory');
            return $this->createErrorResponse(FFCST::ERROR_ID_IS_MANDATORY);
        }

        /**
         * @var \FreePM\Model\Base\ProjectVersionFile $prjvf
         */
        $prjvf = \FreeFW\DI\DI::get('FreePM::Model::ProjectVersionFile');
        $prjvf = \FreePM\Model\ProjectVersionFile::findFirst(
            [
                'prjvf_id' => $p_id
            ]
        );

        if (!$prjvf) {
            $this->logger->debug('FreePM.ProjectVersionFile.downloadFile.end project_version_file not found');
            return $this->createErrorResponse(FFCST::ERROR_NOT_FOUND);
        }

        if ($prjvf->getPrjvfLink() === '') {
            $this->logger->debug('FreePM.ProjectVersionFile.downloadFile.end project_version_file no link');
            return $this->createErrorResponse(FFCST::ERROR_NOT_FOUND);
        }

        $fileName = $prjvf->getPrjvfName();
        $contentFile = null;

        if ($this->gedGetFile($prjvf, $prjvf->getPrjvfLink(), $contentFile, $fileName) === true) {
            $this->logger->debug('FreePM.ProjectVersionFileUpload.downloadFile.end');
            return $this->createMimeTypeResponse($fileName,$contentFile);
        }

        if (!$prjvf->hasErrors()) {
            $prjvf = null;
        }

        $this->logger->debug('FreePM.ProjectVersionFileUpload.downloadFile.end with error');
        return $this->createErrorResponse(FFCST::ERROR_NOT_FOUND, $prjvf); // 404
    }

    /**
     * Ajoute un fichier avec son contenu
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function uploadFile(\Psr\Http\Message\ServerRequestInterface $p_request) // NVT 291074
    {
        $this->logger->debug('FreePM.ProjectVersionFile.uploadFile.start');

        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if (!isset($p_request->default_model)) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
                );
        }

        if ($apiParams->hasData()) {
            /**
             * @var \FreePM\Model\ProjectVersionFileUpload $data
             */
            $data = $apiParams->getData();

            // if _file != ''
            // if _upload != ''
            //
            // sont déjà gérès par PROPERTY_OPTIONS.OPTION_REQUIRED de StorageModel\ProjectVersionFileUpload

            // on demande à la GED de stocker le fichier _file
            // puis en retour la GED nous renvoie un doc_externe ou false

            $doc_externe = $this->gedAddFile($data,$data->getPrjvfFile(),$data->getPrjvfUpload());

            if ($doc_externe===false) {
                if (!$data->hasErrors()) {
                    $data = null;
                }

                $code = FFCST::ERROR_NOT_INSERT; // 412
            } else {
                $parts = pathinfo($data->getPrjvfFile()); // on découpe pour récupérer que le basename

                // on stocke tout ca dans pm_project_version_file
                // et on retourne un Model/ProjectVersionFile

                /**
                 * @var \FreePM\Model\ProjectVersionFile $prjvf
                 */
                $prjvf = \FreeFW\DI\DI::get('FreePM::Model::ProjectVersionFile');
                $prjvf
                    ->setPrjvId($data->getPrjvId())
                    ->setPrjvfName($parts['basename'])
                    ->setPrjvfLink($doc_externe)
                ;

                if ($prjvf->create()) {
                    $data = $this->getModelById($apiParams, $prjvf, $prjvf->getApiId());

                    $this->logger->debug('FreePM.ProjectVersionFile.uploadFile.end');
                    return $this->createSuccessAddResponse($data); // 201
                } else {
                    if (!$prjvf->hasErrors()) {
                        $data = null; // erreur en provenance du create. donc de $prvjf
                    } else {
                        $data = $prjvf;
                    }

                    $code = FFCST::ERROR_NOT_INSERT; // 412
                }
            }
        } else { // pas de body !
            $data = null;
            $code = FFCST::ERROR_NO_DATA; // 409
        }

        $this->logger->debug('FreePM.ProjectVersionFileUpload.uploadFile.end with error');
        return $this->createErrorResponse($code, $data);
    }

    /**
     * Copie un fichier encoder en base64 dans un répertoire défini par la config ged:dirname
     * @param \FreeFW\Core\StorageModel &$p_model
     * @param string $p_file nom complet du fichier qui doit être archivé
     * @param string $p_upload contenu du fichier en base64 qui dot être archivé
     * @return false|string avec erros[] du model renseigné
     */
    public function gedAddFile(\FreeFW\Core\StorageModel &$p_model,string $p_file,string $p_upload) // NVT 299096
    {
        if (!$p_model || $p_file == '' || $p_upload == '') { // minimum pour continuer !
            $p_model->addError(
                \FreeFW\Core\Error::TYPE_PRECONDITION, // FGCST::_MISSING_PARAMETERS
                'missing parameters for ged !'
            );

            return false;
        }

        $gedDirName = $this->getAppConfig()->get('ged:dirname', '');
        $gedDirName = rtrim(str_replace('\\', '/', $gedDirName), '/');

        if (!is_dir($gedDirName)) { // si ce n'est pas un répertoire on ne fait rien !
            $p_model->addError(
                \FreeFW\Core\Error::TYPE_PRECONDITION, // FGCST::_GED_NOT_FOUND
                'ged not installed !'
            );

            return false;
        }

        $doc_externe = false;

        for ($i=0; $i<=8; $i++) { // on va essayer 8 fois de créer un fichier sur le disque
            $doc_externe = md5(uniqid(microtime(true),true));

            $gedFile = $gedDirName . '/' . $doc_externe;

            if (!is_file($gedFile)) { // le fichier n'existe pas, super !
                break;
            }

            $gedFile = false;
            usleep(100);
        }

        if ($gedFile === false) {
            $p_model->addError(
                \FreeFW\Core\Error::TYPE_PRECONDITION, // FGCST::_IMPOSSIBLE_TO_ARCHIVE_A_FILE
                'Unable to archive file in ged !'
            );

            return false;
        }

        try {
            file_put_contents($gedFile,$p_upload);
        } catch (\Exception $ex) {
            $p_model->addError($ex->getCode(), $ex->getMessage());
            return false;
        }

        // mise à jour de ged_document
        // ...

        return $doc_externe;
    }

    /**
     * Copie un fichier encoder en base64 dans un répertoire défini par la config ged:dirname
     * @param \FreeFW\Core\StorageModel &$p_model
     * @param string $p_doc_externe lien externe du fichier dont on doit récupérer le contenu
     * @param string &$p_fileName nom du fichier qui correspond à p_doc_externe
     * @param mixed &$p_content contenu du fichier à downloader
     * @return boolean true si y a quelque chose à downloader.sinon erros[] du model renseigné contient les erreurs
     */
    public function gedGetFile(
        \FreeFW\Core\StorageModel &$p_model,
        string $p_doc_externe,
        &$p_content,
        string &$p_fileName
    )
    {
        if (!$p_model || $p_doc_externe == '') { // minimum pour continuer !
            $p_model->addError(
                \FreeFW\Core\Error::TYPE_PRECONDITION, // FGCST::_MISSING_PARAMETERS
                'missing parameters for ged !'
                );

            return false;
        }

        // on contrôle que p_doc_externe existe bien dans la ged
        // ...

        if ($p_fileName === '' || $p_fileName == null) {
            $p_model->addError(
                \FreeFW\Core\Error::TYPE_PRECONDITION, // FGCST::_MISSING_PARAMETERS
                'ged file name is mandatory !'
                );

            return false;
        }

        $gedDirName = $this->getAppConfig()->get('ged:dirname', '');
        $gedDirName = rtrim(str_replace('\\', '/', $gedDirName), '/');

        if (!is_dir($gedDirName)) { // si ce n'est pas un répertoire on ne fait rien !
            $p_model->addError(
                \FreeFW\Core\Error::TYPE_PRECONDITION, // FGCST::_GED_NOT_FOUND
                'ged not installed !'
                );

            return false;
        }

        $gedFile = $gedDirName . '/' . $p_doc_externe;

        if (!is_file($gedFile)) { // si le fichier n'existe pas on ne fait rien !
            $p_model->addError(
                \FreeFW\Core\Error::TYPE_PRECONDITION, // FGCST::_GED_NOT_FOUND
                'ged file not found !'
            );

            $this->logger->debug(
                sprintf(
                    'FreePM.ProjectVersionFile.gedGetFile.end %s not exists',
                    $gedFile
                )
            );
        }

        try {
            $p_content = file_get_contents($gedFile);

            if ($p_content === false) {
                $p_model->addError(
                    \FreeFW\Core\Error::TYPE_PRECONDITION, // FGCST::_GED_NOT_FOUND
                    'ged error while get content file !'
                );
            } else {
                return true;
            }
        } catch (\Exception $ex) {
            $p_model->addError($ex->getCode(), $ex->getMessage());
        }

        $p_content = null;
        return false;
    }
}
