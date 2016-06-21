<?php

namespace uk\co\n3tw0rk\BattleNet\Configuration;

use uk\co\n3tw0rk\BattleNet\Exceptions\InvalidRegionException;

/**
 * Class Credentials
 * @package uk\co\n3tw0rk\BattleNet\Configuration
 */
class Credentials
{
    /**
     * @var
     */
    private $apiKey;

    /**
     * @var
     */
    private $region;

    /**
     *
     */
    const REGIONS = [
        'cn',
        'eu',
        'kr',
        'sea',
        'tw',
        'us'
    ];

    /**
     * Credentials constructor.
     * @param $apiKey
     * @param $region
     * @throws InvalidRegionException
     */
    public function __construct($apiKey, $region)
    {
        $this->apiKey = $apiKey;

        if (!in_array($region, Credentials::REGIONS)) {
            throw new InvalidRegionException();
        }

        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

}