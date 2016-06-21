<?php

namespace uk\co\n3tw0rk\BattleNet\Http;

/**
 * Class Put
 * @package uk\co\n3tw0rk\BattleNet\Http
 */
abstract class Put extends Request
{
    use Resource;
    protected $method = 'PUT';
}