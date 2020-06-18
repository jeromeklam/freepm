<?php
$localCommands = [
    /**
     * ########################################################################
     * Routes FreePM
     * ########################################################################
     */
    'freepm.gic.import' => [
        'command'    => 'gic::import',
        'controller' => 'FreePM::Command::Import',
        'function'   => 'import'
    ],
];

return $localCommands;