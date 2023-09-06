<?php

namespace app\models\events;

use app\models\History;

class Event
{
    /** @var History */
    protected $history;
    protected $template = '_item_common';
    protected $text = '';

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getTemplate()
    {
        return $this->template;
    }
}