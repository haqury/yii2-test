<?php

namespace app\models\events;

use app\models\History;

class Undefined extends Event implements IEvent
{
    public function getTemplate()
    {
        return $this->template;
    }

    public function getTemplateParams()
    {
        return [
            'user' => $this->history->user,
            'body' => $this->getBodyByModel(),
            'bodyDatetime' => $this->history->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ];
    }

    public function getBodyByModel()
    {
        return $this->getText();
    }
}