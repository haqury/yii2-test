<?php

namespace app\models\events;

use app\models\Customer;
use app\models\History;

class CustomerChangeQuality extends Event implements IEvent
{
    protected $template = '_item_statuses_change';
    protected $text = 'Property changed';

    public function getTemplateParams()
    {
        return [
            'model' => $this->history,
            'oldValue' => Customer::getQualityTextByQuality($this->history->getDetailOldValue('quality')),
            'newValue' => Customer::getQualityTextByQuality($this->history->getDetailNewValue('quality')),
        ];
    }

    public function getBodyByModel()
    {
        return $this->getText() .
            (Customer::getQualityTextByQuality($this->history->getDetailOldValue('quality')) ?? "not set") . ' to ' .
            (Customer::getQualityTextByQuality($this->history->getDetailNewValue('quality')) ?? "not set");
    }
}