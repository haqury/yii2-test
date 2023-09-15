<?php

namespace app\models\events\task;

use app\models\events\Event;
use app\models\events\IEvent;
use app\models\History;

abstract class Task extends Event implements IEvent
{
    protected $template = '_item_common';

    public function getTemplateParams()
    {
        return [
            'user' => $this->history->user,
            'body' => $this->getBodyByModel(),
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $this->history->ins_ts,
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ];
    }

    public function getBodyByModel()
    {
        $task = $this->history->task;
        return $this->getText() . ': ' . ($task->title ?? '');
    }
}