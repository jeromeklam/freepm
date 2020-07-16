<?php
use \FreeFW\Constants as FFCST;
use \FreeFW\Router\Route as FFCSTRT;

/**
 * Routes for ProjectVersionFile
 *
 * @author ericmendez
 */
$routes_project_version_file = [
    'free_p_m.project_version_file.autocomplete' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/ProjectVersionFile',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::ProjectVersionFile',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/project_version_file/autocomplete/:search',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::ProjectVersionFile',
        FFCSTRT::ROUTE_FUNCTION   => 'autocomplete',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_AUTOCOMPLETE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'search' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Chaine de recherche'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_LIST,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreePM::Model::ProjectVersionFile',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'free_p_m.project_version_file.getall' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/ProjectVersionFile',
        FFCSTRT::ROUTE_COMMENT    => 'Retourne une liste filtrée, triée et paginée.',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::ProjectVersionFile',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/project_version_file',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::ProjectVersionFile',
        FFCSTRT::ROUTE_FUNCTION   => 'getAll',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_GET_FILTERED,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['project_version', 'project']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_LIST,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreePM::Model::ProjectVersionFile',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'free_p_m.project.downloadfile' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/ProjectVersionFile',
        FFCSTRT::ROUTE_COMMENT    => 'Renvoie un fichier et son contenu',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::ProjectVersionFile',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/project_version_file/:prjvf_id/downloadfile',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::ProjectVersionFile',
        FFCSTRT::ROUTE_FUNCTION   => 'downloadFile',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_GET_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_LIST => ['no include']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'prjvf_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_BIGINT,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Identifiant de l\'objet'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '201' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_DATA,
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Fichier downloadé',
            ],
        ]
    ],
    'free_p_m.project_version_file.getone' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/ProjectVersionFile',
        FFCSTRT::ROUTE_COMMENT    => 'Retourne un objet selon son identifiant',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::ProjectVersionFile',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/project_version_file/:prjvf_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::ProjectVersionFile',
        FFCSTRT::ROUTE_FUNCTION   => 'getOne',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_GET_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['project', 'project.project_version'],
            FFCSTRT::ROUTE_INCLUDE_LIST => ['project.group']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'prjvf_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_BIGINT,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Identifiant de l\'objet'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreePM::Model::ProjectVersionFile',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'free_p_m.project_version_file.removeone' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/ProjectVersionFile',
        FFCSTRT::ROUTE_COMMENT    => 'Supprime un objet',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_DELETE,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::ProjectVersionFile',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/project_version_file/:prjvf_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::ProjectVersionFile',
        FFCSTRT::ROUTE_FUNCTION   => 'removeOne',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_UPDATE_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'prjvf_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_BIGINT,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Identifiant de l\'objet'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '204' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Objet supprimé',
            ]
        ]
    ],
    'free_p_m.project.uploadfile' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/ProjectVersionFile',
        FFCSTRT::ROUTE_COMMENT    => 'Ajoute un fichier et son contenu',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_POST,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::ProjectVersionFileUpload',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/project_version_file/uploadfile',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::ProjectVersionFile',
        FFCSTRT::ROUTE_FUNCTION   => 'uploadFile',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_CREATE_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '201' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreePM::Model::ProjectVersionFile',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Objet créé',
            ],
        ]
    ],
];