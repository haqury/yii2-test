<?php

namespace app\models\events\fax;

use app\models\events\Event;
use app\models\events\HistoryListHelper;
use app\models\events\IEvent;
use app\models\History;
use yii\helpers\Html;

abstract class Fax extends Event implements IEvent
{
    protected $template = '_item_common';

    public function getTemplateParams()
    {
        return [
            'user' => $model->user,
            'body' => HistoryListHelper::getBodyByModel($model) .
                ' - ' .
                (isset($fax->document) ? Html::a(
                    \Yii::t('app', 'view document'),
                    $fax->document->getViewUrl(),
                    [
                        'target' => '_blank',
                        'data-pjax' => 0
                    ]
                ) : ''),
            'footer' => \Yii::t('app', '{type} was sent to {group}', [
                'type' => $fax ? $fax->getTypeText() : 'Fax',
                'group' => isset($fax->creditorGroup) ? Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
            ]),
            'footerDatetime' => $model->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ];
    }

    public function getBodyByModel()
    {
        return $this->getText();
    }
}