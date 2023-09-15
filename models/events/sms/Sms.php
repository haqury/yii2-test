<?php

namespace app\models\events\sms;

use app\models\events\Event;
use app\models\events\IEvent;
use app\models\History;

abstract class Sms extends Event implements IEvent
{
    protected $template = '_item_common';

    public function getTemplateParams()
    {
        return [
            'user' => $this->history->user,
            'body' => $this->getBodyByModel($this->history),
            'footer' => $this->history->sms->direction == \app\models\Sms::DIRECTION_INCOMING ?
                \Yii::t('app', 'Incoming message from {number}', [
                    'number' => $this->history->sms->phone_from ?? ''
                ]) : \Yii::t('app', 'Sent message to {number}', [
                    'number' => $this->history->sms->phone_to ?? ''
                ]),
            'iconIncome' => $this->history->sms->direction == \app\models\Sms::DIRECTION_INCOMING,
            'footerDatetime' => $this->history->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ];
    }

    public function getBodyByModel()
    {
        return $this->history->sms->message ? $this->history->sms->message : '';
    }
}