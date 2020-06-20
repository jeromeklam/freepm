<?php
namespace FreePM\Controller;

/**
 * Controller DeskColFeature
 *
 * @author jeromeklam
 */
class DeskColFeature extends \FreeFW\Core\ApiController
{

    /**
     * Update single element
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param integer                                  $p_id
     * @param integer                                  $p_colId
     * @param integer                                  $p_position
     */
    public function moveOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id, $p_colId, $p_position)
    {
        $this->logger->debug('FreePM.DeskColFeature.moveOne.start');
        //
        if (intval($p_id) > 0 ) {
            /**
             * @var \FreePM\Model\DeskColFeature $deskColF
             */
            $deskColF = \FreePM\Model\DeskColFeature::findFirst(['dcf_id' => $p_id]);
            if ($deskColF) {
                $oldColId = $deskColF->getDecoId();
                $oldPos   = $deskColF->getDcfPosition();
                $deskColF
                    ->setDecoId($p_colId)
                    ->setDcfPosition($p_position)
                ;
                if ($deskColF->isValid()) {
                    \FreePM\Model\DeskColFeature::update(
                        [
                            'dcf_position' => [ 'noescape' => 'dcf_position + 1']
                        ],
                        [
                            'deco_id'      => [ 'eq' => $p_colId ],
                            'dcf_position' => [ \FreeFW\Storage\Storage::COND_GREATER_EQUAL => $p_position ]
                        ]
                    );
                    if ($deskColF->save()) {
                        \FreePM\Model\DeskColFeature::update(
                            [
                                'dcf_position' => [ 'noescape' => 'dcf_position - 1']
                            ],
                            [
                                'deco_id'      => [ 'eq' => $oldColId ],
                                'dcf_position' => [ \FreeFW\Storage\Storage::COND_GREATER => $oldPos ]
                            ]
                        );
                        $this->logger->debug('FreePM.DeskColFeature.moveOne.end');
                        return $this->createResponse(200, $deskColF);
                    }
                }
                $this->logger->debug('FreePM.DeskColFeature.moveOne.end');
                return $this->createResponse(409, $deskColF->getErrors());
            } else {
                $this->logger->debug('FreePM.DeskColFeature.moveOne.end');
                return $this->createResponse(404, 'no data');
            }
        } else {
            $this->logger->debug('FreePM.DeskColFeature.moveOne.end');
            return $this->createResponse(409, 'Id is mantarory');
        }
    }
}
