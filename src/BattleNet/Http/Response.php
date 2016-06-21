<?php

namespace uk\co\n3tw0rk\BattleNet\Http;

use uk\co\n3tw0rk\BattleNet\Runtime\Scaffold;

/**
 * Class Response
 * @package uk\co\n3tw0rk\BattleNet\Http
 */
class Response extends Scaffold
{
    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var null
     */
    protected $body = null;

    /**
     * @var int
     */
    protected $status = -1;

    /**
     * Response constructor.
     * @param array $headers
     * @param null $body
     * @param $status
     */
    public function __construct(array $headers, $body, $status)
    {
        $this->headers = $headers;
        $this->body = $body;
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
}