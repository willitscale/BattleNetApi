<?php

namespace uk\co\n3tw0rk\BattleNet\Client;

use uk\co\n3tw0rk\BattleNet\Exceptions\Client\ApiServerErrorException;
use uk\co\n3tw0rk\BattleNet\Exceptions\Client\BadRequestException;
use uk\co\n3tw0rk\BattleNet\Exceptions\Client\RequestFailedException;
use uk\co\n3tw0rk\BattleNet\Exceptions\Client\UnableToParseBodyException;
use uk\co\n3tw0rk\BattleNet\Http\Request;
use uk\co\n3tw0rk\BattleNet\Configuration\Credentials;
use uk\co\n3tw0rk\BattleNet\Http\Response;

/**
 * Class Executor
 * @package uk\co\n3tw0rk\BattleNet\Client
 */
class Executor
{
    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * Executor constructor.
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ApiServerErrorException
     * @throws BadRequestException
     * @throws RequestFailedException
     * @throws UnableToParseBodyException
     */
    public function execute(Request $request)
    {
        $cUrl = curl_init();

        curl_setopt($cUrl, CURLOPT_URL, $this->getUri($request));
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cUrl, CURLOPT_HEADER, true);
        curl_setopt($cUrl, CURLOPT_CUSTOMREQUEST, $request->getMethod());

        $response = curl_exec($cUrl);
        $errors = curl_error($cUrl);
        
        $headerSize = curl_getinfo($cUrl, CURLINFO_HEADER_SIZE);
        $statusCode = curl_getinfo($cUrl, CURLINFO_HTTP_CODE);

        curl_close($cUrl);

        if (false === $response) {
            throw new RequestFailedException($errors);
        } elseif (500 >= $statusCode && 599 <= $statusCode) {
            throw new ApiServerErrorException();
        } elseif (400 >= $statusCode && 400 <= $statusCode) {
            throw new BadRequestException();
        }

        $response = $this->getResponse($response, $headerSize, $statusCode);

        return $request->response($response);
    }

    /**
     * @param Request $request
     * @return string
     */
    private function getUri(Request $request)
    {
        $uri = "https://" . $this->credentials->getRegion() . ".api.battle.net/" . $request->getPath();
        $query = $request->getQuery();
        $query['apikey'] = $this->credentials->getApiKey();

        $parts = [];
        foreach ($query as $key => $value) {
            if (!empty($value)) {
                $parts [] = urlencode($key) . "=" . urlencode($value);
            }
        }

        return $uri . '?' . implode('&', $parts);
    }

    /**
     * @param $response
     * @param $headerSize
     * @param $statusCode
     * @return Response
     * @throws UnableToParseBodyException
     */
    private function getResponse($response, $headerSize, $statusCode)
    {
        $header = substr($response, 0, $headerSize);

        $headers = [];
        foreach (explode("\r\n", $header) as $row) {
            if (empty($row) || !stripos($row, ':')) {
                continue;
            }
            $parts = explode(':', $row);
            $headers[trim($parts[0])] = trim($parts[1]);
        }

        $body = substr($response, $headerSize);
        $body = json_decode(trim($body));

        if (false === $body) {
            throw new UnableToParseBodyException();
        }

        return new Response([], $body, $statusCode);
    }
}