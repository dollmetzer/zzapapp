<?php

namespace Application\modules\statemachine\lib;

class Process
{
    protected $id;

    protected $workflowId;

    protected $stateId;

    public function __construct(int $workflowId)
    {
    }

    public function init()
    {
    }

    public static function load($id)
    {
    }

    public function save()
    {
    }
}
