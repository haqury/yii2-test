<?php

namespace app\models\events\sms;

class IncomingSms extends Sms
{
    protected $text = 'Incoming message';
}