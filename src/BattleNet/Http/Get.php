<?php

namespace uk\co\n3tw0rk\BattleNet\Http;

abstract class Get extends Request
{
    use Resource;
    protected $method = 'GET';
}