<?php

namespace InGeneral\View\Model;

use Zend\View\Model\JsonModel;


class DebugJsonModel extends JsonModel
{


    public function serialize()
    {
        $json = parent::serialize();
        
        return \Zend\Json\Json::prettyPrint($json, array(
            'indent' => '    '
        ));
    }
}
