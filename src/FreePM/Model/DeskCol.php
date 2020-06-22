<?php
namespace FreePM\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model DeskCol
 *
 * @author jeromeklam
 */
class DeskCol extends \FreePM\Model\Base\DeskCol
{

    /**
     * Behaviours
     */
    use \FreeSSO\Model\Behaviour\Group;
    use \FreePM\Model\Behaviour\Desk;

    /**
     * Before create
     *
     * @return boolean
     */
    public function beforeCreate()
    {
        /**
         * @var \FreePM\Model\DeskCol $deskCol
         */
        $deskCol = \FreeFW\DI\DI::get('FreePM::Model::DeskCol');
        $deskCol = \FreePM\Model\DeskCol::findFirst(
            [
                'desk_id' => $this->getDeskId()
            ],
            [
                'deco_position' => \FreeFW\Storage\Storage::SORT_DESC
            ]
        );
        if ($deskCol) {
            $this->setDecoPosition(intval($deskCol->getDecoPosition()) + 1);
        } else {
            $this->setDecoPosition(1);
        }
        return true;
    }
}
