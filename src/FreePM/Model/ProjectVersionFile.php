<?php
namespace FreePM\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model Project
 *
 * @author ericmendez
 */
class ProjectVersionFile extends \FreePM\Model\Base\ProjectVersionFile
{

    /**
     * Behaviour
     */
    use \FreePM\Model\Behaviour\Project;
    use \FreePM\Model\Behaviour\ProjectVersion;
}
