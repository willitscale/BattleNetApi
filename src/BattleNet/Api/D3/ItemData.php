<?php

namespace uk\co\n3tw0rk\BattleNet\Api\D3;

use uk\co\n3tw0rk\BattleNet\Http\Get;
use uk\co\n3tw0rk\BattleNet\Http\Response;
use uk\co\n3tw0rk\BattleNet\Models\D3\Item;

/**
 * Class ItemData
 * @package uk\co\n3tw0rk\BattleNet\Api\D3
 * @getter
 */
class ItemData extends Get
{
    /**
     * @var string
     */
    protected $path = 'd3/data/item';

    /**
     * @var array
     */
    protected $query = [
        'locale' => null,
        'callback' => null
    ];

    /**
     * @param Response $response
     * @return Item
     */
    public function response(Response $response)
    {
        return new Item($response->getBody());
    }
}