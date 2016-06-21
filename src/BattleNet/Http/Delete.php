<?php

namespace uk\co\n3tw0rk\BattleNet\Http;

abstract class Delete extends Request
{
    use Resource;
    protected $method = 'DELETE';
}