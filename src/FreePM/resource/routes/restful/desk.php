<?php
use \FreeFW\Constants as FFCST;
use \FreeFW\Router\Route as FFCSTRT;

/**
 * Routes for Desk
 *
 * @author jeromeklam
 */
$routes_desk = [
    'free_p_m.desk.autocomplete' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/Desk',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::Desk',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/desk/autocomplete/:search',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::Desk',
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
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreePM::Model::Desk',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'free_p_m.desk.getall' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/Desk',
        FFCSTRT::ROUTE_COMMENT    => 'Retourne une liste filtrée, triée et paginée.',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::Desk',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/desk',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::Desk',
        FFCSTRT::ROUTE_FUNCTION   => 'getAll',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_GET_FILTERED,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['group', 'user']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_LIST,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreePM::Model::Desk',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'free_p_m.desk.getone' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/Desk',
        FFCSTRT::ROUTE_COMMENT    => 'Retourne un objet selon son identifiant',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::Desk',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/desk/:desk_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::Desk',
        FFCSTRT::ROUTE_FUNCTION   => 'getOne',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_GET_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['group', 'user']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'desk_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_BIGINT,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Identifiant de l\'objet'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreePM::Model::Desk',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'free_p_m.desk.createone' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/Desk',
        FFCSTRT::ROUTE_COMMENT    => 'Créé un objet',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_POST,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::Desk',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/desk',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::Desk',
        FFCSTRT::ROUTE_FUNCTION   => 'createOne',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_CREATE_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['group', 'user']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '201' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreePM::Model::Desk',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Objet créé',
            ],
        ]
    ],
    'free_p_m.desk.updateone' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/Desk',
        FFCSTRT::ROUTE_COMMENT    => 'Modifie un objet',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_PUT,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::Desk',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/desk/:desk_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::Desk',
        FFCSTRT::ROUTE_FUNCTION   => 'updateOne',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_UPDATE_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['group', 'user']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'desk_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_BIGINT,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Identifiant de l\'objet'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreePM::Model::Desk',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Objet modifié',
            ],
        ]
    ],
    'free_p_m.desk.removeone' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreePM/PrjMgnt/Desk',
        FFCSTRT::ROUTE_COMMENT    => 'Supprime un objet',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_DELETE,
        FFCSTRT::ROUTE_MODEL      => 'FreePM::Model::Desk',
        FFCSTRT::ROUTE_URL        => '/v1/prj_mgnt/desk/:desk_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreePM::Controller::Desk',
        FFCSTRT::ROUTE_FUNCTION   => 'removeOne',
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'desk_id' => [
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
];
