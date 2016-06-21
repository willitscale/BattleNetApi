<?php

namespace uk\co\n3tw0rk\BattleNet\Http;

use uk\co\n3tw0rk\BattleNet\Exceptions\Models\InvalidIdentifierException;

/**
 * Class Resource
 * @package uk\co\n3tw0rk\BattleNet\Http
 */
trait Resource
{
    protected $identifier = null;
    protected $query = [];

    /**
     * ItemData constructor.
     * @param $identifier
     * @param array $query
     * @throws InvalidIdentifierException
     * @internal param $identifer
     */
    public function __construct($identifier, $query = [])
    {
        if (null === $identifier) {
            throw new InvalidIdentifierException();
        }
        $this->identifier = $identifier;

        foreach ($this->query AS $key => &$value) {
            if (isset($query[$key])) {
                $value = $query[$key];
            }
        }
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return parent::getPath() . '/' . $this->getIdentifier();
    }
}