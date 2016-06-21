<?php

namespace uk\co\n3tw0rk\BattleNet\Runtime;

use uk\co\n3tw0rk\BattleNet\Support\Singleton;

/**
 * Class Boilerplate
 * @package uk\co\n3tw0rk\BattleNet\Runtime
 */
class Boilerplate extends Singleton
{
    private static $instance;

    private $cache = [];

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (empty(Boilerplate::$instance)) {
            Boilerplate::$instance = new self();
        }

        return Boilerplate::$instance;
    }

    /**
     * @param $key
     * @param array $map
     * @return array
     */
    public function add($key, array $map = [])
    {
        return $this->cache[$key] = $map;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->cache[$key];
    }

    /**
     *
     */
    public function flush()
    {
        $this->cache = [];
    }

    /**
     * @param $key
     * @return bool
     */
    public function exists($key)
    {
        return array_key_exists($key, $this->cache);
    }
}