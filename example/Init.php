<?php

namespace Example;

require_once("Psr4AutoloaderClass.php");

$loader = new \Example\Psr4AutoloaderClass;
$loader->register();
$loader->addNamespace('uk\\co\\n3tw0rk', 'src');

use uk\co\n3tw0rk\BattleNet\Api\D3\ItemData;
use uk\co\n3tw0rk\BattleNet\Client\Executor;
use uk\co\n3tw0rk\BattleNet\Configuration\Credentials;

use uk\co\n3tw0rk\BattleNet\Exceptions\Client\ApiServerErrorException;
use uk\co\n3tw0rk\BattleNet\Exceptions\Client\BadRequestException;
use uk\co\n3tw0rk\BattleNet\Exceptions\Client\RequestFailedException;
use uk\co\n3tw0rk\BattleNet\Exceptions\Client\UnableToParseBodyException;
use uk\co\n3tw0rk\BattleNet\Exceptions\Configuration\InvalidRegionException;

$credentials = null;

try {
    $credentials = new Credentials(
        $_SERVER['BATTLE_NET_KEY'],
        'eu'
    );
} catch (InvalidRegionException $e) {
    var_dump($e);
    exit();
}

$executor = new Executor($credentials);

try {
    $item = $executor->execute(new ItemData('spires-of-the-earth'));
    $maxDurability = $item->getAttributesRaw()->getDurabilityMax()->getMax();
    var_dump($maxDurability);
} catch (ApiServerErrorException $e) {
    var_dump($e);
    exit();
} catch (BadRequestException $e) {
    var_dump($e);
    exit();
} catch (RequestFailedException $e) {
    var_dump($e);
    exit();
} catch (UnableToParseBodyException $e) {
    var_dump($e);
    exit();
}