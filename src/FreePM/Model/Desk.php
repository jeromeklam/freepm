<?php
namespace FreePM\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model Desk
 *
 * @author jeromeklam
 */
class Desk extends \FreePM\Model\Base\Desk
{

    /**
     * Behaviour
     */
    use \FreeSSO\Model\Behaviour\Group;
    use \FreeSSO\Model\Behaviour\User;
}
