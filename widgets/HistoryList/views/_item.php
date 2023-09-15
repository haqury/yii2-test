<?php
use app\models\search\HistorySearch;

/** @var $model HistorySearch */
echo $this->render($model->getEventExample()->getTemplate(), $model->getEventExample()->getTemplateParams());