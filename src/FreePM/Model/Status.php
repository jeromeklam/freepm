<?php
namespace FreePM\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model Status
 *
 * @author jeromeklam
 */
class Status extends \FreePM\Model\Base\Status
{


    /**
     * Types
     * @var string
     */
    const TYPE_CLOSED  = 'CLOSED';
    const TYPE_PENDING = 'PENDING';
    const TYPE_OK      = 'OK';
    const TYPE_REFUSED = 'REFUSED';

    /**
     * Behaviour
     */
    use \FreeSSO\Model\Behaviour\Group;
}
