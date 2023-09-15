<?php

namespace app\models\events;

use app\models\Customer;
use app\models\History;

class CustomerChangeType extends Event implements IEvent
{
    protected $template = '_item_statuses_change';
    protected $text = 'Type changed';

    public function getTemplateParams()
    {
        return [
            'model' => $this->history,
            'oldValue' => Customer::getTypeTextByType($this->history->getDetailOldValue('type')),
            'newValue' => Customer::getTypeTextByType($this->history->getDetailNewValue('type'))
        ];
    }

    public function getBodyByModel()
    {
        return $this->getText() .
            (Customer::getTypeTextByType($this->history->getDetailOldValue('type')) ?? "not set") . ' to ' .
            (Customer::getTypeTextByType($this->history->getDetailNewValue('type')) ?? "not set");
    }
}