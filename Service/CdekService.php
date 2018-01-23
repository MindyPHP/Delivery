<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use function GuzzleHttp\Psr7\stream_for;
use Mindy\Delivery\DimensionsInterface;
use Mindy\Delivery\LocationInterface;
use Mindy\Delivery\ParametersInterface;
use Mindy\Delivery\Result;
use Mindy\Delivery\ResultInterface;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class CdekService implements DeliveryServiceInterface
{
    /**
     * @var string
     */
    protected $login;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var string
     */
    protected $version;
    /**
     * @var string
     */
    protected $endpoint = 'http://api.cdek.ru/calculator/calculate_price_by_json.php';

    /**
     * @param string $login
     * @param string $password
     * @param string $version
     */
    public function __construct(string $login, string $password, string $version = '1.0')
    {
        $this->login = $login;
        $this->password = $password;
        $this->version = $version;
    }

    /**
     * @return ClientInterface
     */
    protected function getClient(): ClientInterface
    {
        return new Client();
    }

    /**
     * @param string $date
     * @return string
     */
    protected function getPasswordHash(string $date): string
    {
        return md5($date . '&' . $this->password);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice(LocationInterface $from, LocationInterface $to, DimensionsInterface $dimensions, ParametersInterface $parameters = null): ResultInterface
    {
        $fromCityId = $this->searchCity($from->getCity());
        $toCityId = $this->searchCity($to->getCity());

        $date = date('Y-m-d');
        $parameters = [
            'dateExecute' => $date,
            'version' => $this->version,
            'authLogin' => $this->login,
            'secure' => $this->getPasswordHash($date),
            'senderCityId' => $fromCityId,
            'receiverCityId' => $toCityId,
            'tariffId' => '?',
            'tariffList' => '?',
            'modeId' => '?',
            'goods' => [
                // TODO вес, вес + размеры
                $dimensions->toArray()
            ]
        ];

        $request = new Request('POST', $this->endpoint, [
            'Content-Type' => 'application/json'
        ], stream_for(json_encode($parameters)));
        $response = $this->getClient()->send($request);
        $data = json_decode((string)$response->getBody(), true);

        if (isset($data['error'])) {
            $errorString = [];
            foreach ($data['error'] as $error) {
                $errorString[] = sprintf("Code: %s - %s", $error['code'], $error['text']);
            }
            throw new CalculatorException(implode(', ', $errorString));
        }

        $result = new Result();
        $result->setDays(0);
        $result->setPrice(0);
        return $result;
    }

    /**
     * @param string $city
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
    public function searchCity(string $city): array
    {
        $uri = sprintf('http://api.cdek.ru/city/getListByTerm/json.php?q=%s', urlencode($city));
        $response = $this->getClient()->request('get', $uri);
        $data = json_decode((string)$response->getBody(), true);

        return $data['geonames'] ?? [];
    }

    /**
     * {@inheritdoc}
     */
    public function support(LocationInterface $location): bool
    {
        return count($this->searchCity($location->getCity())) > 0;
    }
}
