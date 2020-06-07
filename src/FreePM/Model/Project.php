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
}
