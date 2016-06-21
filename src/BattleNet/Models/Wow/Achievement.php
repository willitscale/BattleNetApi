<?php

namespace uk\co\n3tw0rk\BattleNet\Models\Wow;

use uk\co\n3tw0rk\BattleNet\Models\Model;

/**
 * Class Achievement
 * @package uk\co\n3tw0rk\BattleNet\Models\Wow
 * @getter
 */
class Achievement extends Model
{
    protected $title;
    protected $points;
    protected $description;
    protected $reward;
    protected $rewardItems;
    protected $icon;
    protected $criteria;
    protected $accountWide;
    protected $factionId;
}