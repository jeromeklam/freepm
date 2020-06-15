<?php
namespace FreePM\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model Feature
 *
 * @author jeromeklam
 */
class Feature extends \FreePM\Model\Base\Feature
{

    /**
     * Behaviour
     */
    use \FreePM\Model\Behaviour\Project;
    use \FreePM\Model\Behaviour\Status;
    use \FreeSSO\Model\Behaviour\Group;
}
