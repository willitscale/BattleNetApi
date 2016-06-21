<?php

namespace uk\co\n3tw0rk\BattleNet\Http;

abstract class Patch extends Request
{
    use Resource;
    protected $method = 'PATCH';
}