<?php

namespace Cracki\Dogger;

interface DlogInterface
{
    public function saveLog($request,$response);

    public function getLog();

    public function deleteLog();
}