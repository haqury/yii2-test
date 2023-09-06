<?php

namespace app\models\events\call;

use app\models\events\Event;
use app\models\events\IEvent;
use app\models\History;

abstract class Call extends Event implements IEvent
{
    protected $template = '_item_common';

    public function getTemplateParams()
    {
        $call = $this->history->call;
        $answered = $call && $call->status == \App\models\Call::STATUS_ANSWERED;
        return [
            'user' => $this->history->user,
            'content' => $call->comment ?? '',
            'body' => $this->getBodyByModel($this->history),
            'footerDatetime' => $this->history->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction == \App\models\Call::DIRECTION_INCOMING
        ];
    }

    public function getBodyByModel()
    {
        $task = $this->history->task;
        return $this->getText() . ': ' . ($task->title ?? '');
    }
}