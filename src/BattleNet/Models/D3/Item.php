<?php

namespace uk\co\n3tw0rk\BattleNet\Models\D3;

use uk\co\n3tw0rk\BattleNet\Models\Model;

/**
 * Class Item
 * @package uk\co\n3tw0rk\BattleNet\Models\D3
 * @getter
 */
class Item extends Model
{
    protected $id;
    protected $name;
    protected $icon;
    protected $displayColor;
    protected $tooltipParams;
    protected $requiredLevel;
    protected $itemLevel;
    protected $stackSizeMax;
    protected $bonusAffixes;
    protected $bonusAffixesMax;
    protected $accountBound;
    protected $flavorText;
    protected $typeName;
    /**
     * @class uk\co\n3tw0rk\BattleNet\Models\D3\Item\Type
     */
    protected $type;
    protected $damageRange;
    /**
     * @class uk\co\n3tw0rk\BattleNet\Models\D3\Item\Armor
     */
    protected $armor;
    protected $slots;
    /**
     * @class uk\co\n3tw0rk\BattleNet\Models\D3\Item\Attributes
     */
    protected $attributes;
    /**
     * @class uk\co\n3tw0rk\BattleNet\Models\D3\Item\AttributesRaw
     */
    protected $attributesRaw;
    protected $randomAffixes;
    protected $gems;
    protected $socketEffects;
    /**
     * @class uk\co\n3tw0rk\BattleNet\Models\D3\Item\Set
     */
    protected $set;
    protected $setItemsEquipped;
    protected $craftedBy;
    protected $seasonRequiredToDrop;
    protected $isSeasonRequiredToDrop;
    protected $description;
    protected $blockChance;
}