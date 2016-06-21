<?php

namespace uk\co\n3tw0rk\BattleNet\Models;

use uk\co\n3tw0rk\BattleNet\Exceptions\Models\InvalidDataObjectException;
use uk\co\n3tw0rk\BattleNet\Runtime\Boilerplate;
use uk\co\n3tw0rk\BattleNet\Runtime\Scaffold;

/**
 * Class Model
 * @package uk\co\n3tw0rk\BattleNet\Models
 */
abstract class Model extends Scaffold
{
    /**
     * Model constructor.
     * @param $object
     * @throws InvalidDataObjectException
     */
    public function __construct($object)
    {
        parent::__construct();

        if (empty($object) || !is_object($object)) {
            throw new InvalidDataObjectException(get_class($this));
        }

        $cache = Boilerplate::getInstance()->get(get_class($this));

        foreach ($object as $key => $value) {
            if (array_key_exists($key, $cache['alias'])) {
                $key = $cache['alias'][$key];
            }

            if (!property_exists($this, $key)) {
                continue;
            }
            
            if (array_key_exists($key, $cache['class'])) {
                $class = $cache['class'][$key];
                $this->{$key} = new $class($value);
            } elseif (array_key_exists($key, $cache['array']) && is_array($value)) {
                $class = $cache['array'][$key];
                $this->{$key} = [];
                foreach ($value as $nestedValue) {
                    $this->{$key} [] = new $class($nestedValue);
                }
            } else {
                $this->{$key} = $value;
            }
        }
    }
}