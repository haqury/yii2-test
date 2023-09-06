<?php

namespace app\models\events;

use app\models\History;

interface IEvent
{
    public function getTemplate();

    public function getTemplateParams();

    public function getBodyByModel();
    public function getText();
}