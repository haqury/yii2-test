<?php

namespace app\models\events;

use app\models\events\call\Call;
use app\models\events\call\IncomingCall;
use app\models\events\call\OutgoingCall;
use app\models\events\fax\Fax;
use app\models\events\fax\IncomingFax;
use app\models\events\fax\OutgoingFax;
use app\models\events\sms\IncomingSms;
use app\models\events\sms\OutgoingSms;
use app\models\events\sms\Sms;
use app\models\events\task\CreatedTask;
use app\models\events\task\Task;
use app\models\events\task\UpdatedTask;
use app\models\History;

class Factory
{
    private static $classes = [
        History::EVENT_CREATED_TASK => CreatedTask::class,
        History::EVENT_UPDATED_TASK => UpdatedTask::class,
        History::EVENT_COMPLETED_TASK => CreatedTask::class,
        History::EVENT_INCOMING_CALL => IncomingCall::class,
        History::EVENT_OUTGOING_CALL => OutgoingCall::class,
        History::EVENT_INCOMING_SMS => IncomingSms::class,
        History::EVENT_OUTGOING_SMS => OutgoingSms::class,
        History::EVENT_INCOMING_FAX => IncomingFax::class,
        History::EVENT_OUTGOING_FAX => OutgoingFax::class,
        History::EVENT_CUSTOMER_CHANGE_TYPE => CustomerChangeType::class,
        History::EVENT_CUSTOMER_CHANGE_QUALITY => CustomerChangeQuality::class,
    ];

    public static function createByEvent(History $history): IEvent
    {
        if (!isset(self::$classes[$history->event])) {
            return new Undefined($history);
        }

        return new self::$classes[$history->event]($history);
    }
}