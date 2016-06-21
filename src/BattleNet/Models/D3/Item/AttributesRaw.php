<?php

namespace uk\co\n3tw0rk\BattleNet\Models\D3\Item;

use uk\co\n3tw0rk\BattleNet\Models\Model;

/**
 * Class AttributesRaw
 * @package uk\co\n3tw0rk\BattleNet\Models\D3
 * @getter
 */
class AttributesRaw extends Model
{
    /**
     * @alias Armor_Item
     * @class uk\co\n3tw0rk\BattleNet\Models\D3\Item\ArmorItem
     */
    protected $armorItem;
    /**
     * @alias Resistance_All
     * @class uk\co\n3tw0rk\BattleNet\Models\D3\Item\ResistanceAll
     */
    protected $resistanceAll;
    /**
     * @alias Durability_Max
     * @class uk\co\n3tw0rk\BattleNet\Models\D3\Item\DurabilityMax
     */
    protected $durabilityMax;
    /**
     * @alias Durability_Cur
     * @class uk\co\n3tw0rk\BattleNet\Models\D3\Item\DurabilityCur
     */
    protected $durabilityCur;
}