<?php

namespace uk\co\n3tw0rk\BattleNet\Runtime;

abstract class Scaffold
{
    /**
     * @var array
     */
    public static $bindCache = [];

    /**
     * Scaffold constructor.
     */
    public function __construct()
    {
        if (!Boilerplate::getInstance()->exists(get_class($this))) {
            $this->annotate();
        }
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        if (!isset($this->$method)) {
            return $this->__bind($method, $args);
        }
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __bind($method, $args)
    {
        if (!Boilerplate::getInstance()->exists(get_class($this))) {
            $this->annotate();
        }
        
        $cache = Boilerplate::getInstance()->get(get_class($this));

        if (0 === stripos($method, 'get')) {
            $property = lcfirst(substr($method, 3));
            if (in_array($property, $cache['getters'])) {
                return $this->{$property};
            }
        } elseif (0 === stripos($method, 'set')) {
            $property = lcfirst(substr($method, 3));
            if (in_array($property, $cache['setters'])) {
                $this->{$property} = $args[0];
            }
        }
    }

    /**
     * @return mixed
     */
    public function annotate()
    {
        $ref = new \ReflectionClass($this);

        $mapped = [
            'getters' => [],
            'setters' => [],
            'class' => [],
            'alias' => [],
            'array' => []
        ];

        $globalGetter = false !== stripos($ref->getDocComment(), "@getter");
        $globalSetter = false !== stripos($ref->getDocComment(), "@setter");

        foreach ($ref->getProperties() AS $property) {

            $comment = $property->getDocComment();
            $name = $property->getName();

            if ($globalGetter || (false !== $comment && false !== stripos($comment, "@getter"))) {
                $mapped['getters'] [] = $name;
            }

            if ($globalSetter || (false !== $comment && false !== stripos($comment, "@setter"))) {
                $mapped['setters'] [] = $name;
            }

            if (!empty($class = $this->extractArgs('class', $comment))) {
                $mapped['class'][$name] = $class[0];
            }

            if (!empty($alias = $this->extractArgs('alias', $comment))) {
                $mapped['alias'][$alias[0]] = $name;
            }

            if (!empty($array = $this->extractArgs('array', $comment))) {
                $mapped['array'][$name] = $array[0];
            }
        }

        return Boilerplate::getInstance()->add($ref->getName(), $mapped);
    }

    /**
     * @param $key
     * @param $block
     * @return array|null
     */
    private function extractArgs($key, $block)
    {
        if (false !== ($offset = stripos($block, "@" . $key))) {
            $offset += strlen($key) + 2;
            $end = stripos($block, "\n", $offset);
            return explode(' ', trim(substr($block, $offset, $end - $offset)));
        }
        return null;
    }

}