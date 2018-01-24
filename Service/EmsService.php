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
use Mindy\Delivery\DimensionsInterface;
use Mindy\Delivery\LocationInterface;
use Mindy\Delivery\ParametersInterface;
use Mindy\Delivery\Result;
use Mindy\Delivery\ResultInterface;

/**
 * Class EmsService.
 */
class EmsService implements DeliveryServiceInterface
{
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * EmsService constructor.
     *
     * @param string $endpoint
     */
    public function __construct($endpoint = 'http://emspost.ru/api/rest/')
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'EMS почта россии';
    }

    protected function fetchCityList()
    {
        $client = new Client();
        $response = $client->request('GET', $this->endpoint, [
            'query' => [
                // http://emspost.ru/api/rest/?method=ems.get.locations&type=cities&plain=true
                'method' => 'ems.get.locations',
                'type' => 'cities',
                'plain' => true,
            ],
        ]);

        if (200 === $response->getStatusCode()) {
            $json = json_decode($response->getBody(), true);
            $data = [];
            foreach ($json['rsp']['locations'] as $location) {
                $data[$location['value']] = mb_strtolower($location['name'], 'UTF-8');
            }

            return $data;
        }

        return [];
    }

    protected function fetchRegionList()
    {
        $client = new Client();
        $response = $client->request('GET', $this->endpoint, [
            'query' => [
                // http://emspost.ru/api/rest/?method=ems.get.locations&type=regions&plain=true
                'method' => 'ems.get.locations',
                'type' => 'regions',
                'plain' => true,
            ],
        ]);

        if (200 === $response->getStatusCode()) {
            $json = json_decode($response->getBody(), true);
            $data = [];
            foreach ($json['rsp']['locations'] as $location) {
                $data[$location['value']] = mb_strtolower($location['name'], 'UTF-8');
            }

            return $data;
        }

        return [];
    }

    /**
     * @param string $region
     *
     * @return null|string
     */
    protected function findRegion($region)
    {
        $shortRegion = explode(' ', mb_strtolower($region, 'UTF-8'))[0];
        foreach ($this->fetchRegionList() as $value => $name) {
            if (false !== mb_strpos(mb_strtolower($name, 'UTF-8'), $shortRegion, 0, 'UTF-8')) {
                return $value;
            }
        }
    }

    /**
     * @param string $city
     *
     * @return null|string
     */
    protected function findCity($city)
    {
        foreach ($this->fetchCityList() as $value => $name) {
            if (false !== mb_strpos(mb_strtolower($name, 'UTF-8'), mb_strtolower($city, 'UTF-8'), 0, 'UTF-8')) {
                return $value;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice(LocationInterface $from, LocationInterface $to, DimensionsInterface $dimensions, ParametersInterface $parameters = null): ResultInterface
    {
        $client = new Client();
        $res = $client->request('GET', $this->endpoint, [
            'query' => [
                'method' => 'ems.calculate',
                'from' => $this->findCity($from->getCity()),
                'to' => $this->findCity($to->getCity()),
                'weight' => $dimensions->getWeight(),
            ],
        ]);

        $result = new Result();

        if (200 === $res->getStatusCode()) {
            $json = json_decode($res->getBody(), true);
            $data = $json['rsp'];
            $term = $data['term'];
            $result->setDays(array_sum($term) / count($term));
            $result->setPrice($data['price']);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function support(LocationInterface $location): bool
    {
        return $this->findRegion($location->getRegion()) && $this->findCity($location->getCity());
    }
}
