<?php
$localCommands = [
    /**
     * ########################################################################
     * Routes FreePM
     * ########################################################################
     */
    'freepm.beforeImport' => [
        'command'    => '::beforeImport',
        'controller' => 'FreePM::Command::Import',
        'function'   => 'beforeImport'
    ],
    'freepm.gic.importGIC' => [
        'command'    => 'gic::importGIC',
        'controller' => 'FreePM::Command::ImportGIC',
        'function'   => 'importGIC'
    ],
    'freepm.bo.importBO' => [
        'command'    => 'bo::importBO',
        'controller' => 'FreePM::Command::ImportBO',
        'function'   => 'importBO'
    ],
];

return $localCommands;