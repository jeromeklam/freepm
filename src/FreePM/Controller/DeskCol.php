<?php
namespace FreePM\Controller;

/**
 * Controller DeskCol
 *
 * @author jeromeklam
 */
class DeskCol extends \FreeFW\Core\ApiController
{

    /**
     * Move column
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param integer                                  $p_id
     * @param integer                                  $p_position
     */
    public function moveOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id, $p_position)
    {
        $this->logger->debug('FreePM.DeskCol.moveOne.start');
        //
        if (intval($p_id) > 0 ) {
            /**
             * @var \FreePM\Model\DeskCol $deskCol
             */
            $deskCol = \FreePM\Model\DeskCol::findFirst(['deco_id' => $p_id]);
            if ($deskCol) {
                $oldPos   = $deskCol->getDecoPosition();
                if ($deskCol->isValid()) {
                    if ($oldPos < $p_position) {
                        $deskCol
                            ->setDecoPosition(-1 * $deskCol->getDecoId())
                            ->save()
                        ;
                        \FreePM\Model\DeskCol::update(
                            [
                                'deco_position' => [ 'noescape' => 'deco_position - 1']
                            ],
                            [
                                'desk_id'       => [ 'eq' => $deskCol->getDeskId() ],
                                'deco_position' => [ \FreeFW\Storage\Storage::COND_BETWEEN => [$oldPos, $p_position] ]
                            ]
                        );
                        $deskCol
                            ->setDecoPosition($p_position)
                        ;
                        if ($deskCol->save()) {
                            $this->logger->debug('FreePM.DeskCol.moveOne.end');
                            return $this->createResponse(200, $deskCol);
                        }
                    } else {
                        if ($oldPos > $p_position) {
                            $deskCol
                                ->setDecoPosition(-1 * $deskCol->getDecoId())
                                ->save()
                            ;
                            \FreePM\Model\DeskCol::update(
                                [
                                    'deco_position' => [ 'noescape' => 'deco_position + 1']
                                ],
                                [
                                    'desk_id'       => [ 'eq' => $deskCol->getDeskId() ],
                                    'deco_position' => [ \FreeFW\Storage\Storage::COND_GREATER => $p_position ],
                                    'deco_position' => [ \FreeFW\Storage\Storage::COND_LOWER => $oldPos ]
                                ]
                            );
                            $deskCol
                                ->setDecoPosition($p_position)
                            ;
                            if ($deskCol->save()) {
                                $this->logger->debug('FreePM.DeskCol.moveOne.end');
                                return $this->createResponse(200, $deskCol);
                            }
                        }
                    }
                }
                $this->logger->debug('FreePM.DeskCol.moveOne.end');
                return $this->createResponse(409, $deskCol->getErrors());
            } else {
                $this->logger->debug('FreePM.DeskCol.moveOne.end');
                return $this->createResponse(404, 'no data');
            }
        } else {
            $this->logger->debug('FreePM.DeskCol.moveOne.end');
            return $this->createResponse(409, 'Id is mantarory');
        }
    }
}
