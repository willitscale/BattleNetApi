<?php

namespace uk\co\n3tw0rk\BattleNet\Models\D3\Item;

use uk\co\n3tw0rk\BattleNet\Models\Model;

/**
 * Class Attributes
 * @package uk\co\n3tw0rk\BattleNet\Models\D3\Item
 * @getter
 */
class Attributes extends Model
{
    /**
     * @var array
     * @array uk\co\n3tw0rk\BattleNet\Models\D3\Item\Attribute
     */
    protected $primary = [];

    /**
     * @var array
     * @array uk\co\n3tw0rk\BattleNet\Models\D3\Item\Attribute
     */
    protected $secondary = [];

    /**
     * @var array
     * @array uk\co\n3tw0rk\BattleNet\Models\D3\Item\Attribute
     */
    protected $passive = [];
}