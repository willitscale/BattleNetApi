<?php

namespace uk\co\n3tw0rk\BattleNet\Http;

use uk\co\n3tw0rk\BattleNet\Runtime\Scaffold;

/**
 * Interface Request
 * @package uk\co\n3tw0rk\BattleNet\Http
 */
abstract class Request extends Scaffold
{
    /**
     * @var String The item data string (from a profile) containing the item to lookup
     */
    protected $identifier = null;

    protected $query = [];
    protected $body = null;
    protected $data = [];
    protected $headers = [];
    protected $method = null;
    protected $path = null;

    abstract public function response(Response $response);
}