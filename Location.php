<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery;

class Location implements LocationInterface
{
    /**
     * @var string|int
     */
    protected $country;
    /**
     * @var string|int
     */
    protected $region;
    /**
     * @var string|int
     */
    protected $city;
    /**
     * @var string|int
     */
    protected $zipcode;
    /**
     * @var string|int
     */
    protected $address;

    /**
     * {@inheritdoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param int|string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * {@inheritdoc}
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param int|string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * {@inheritdoc}
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param int|string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * {@inheritdoc}
     */
    public function getZipCode()
    {
        return $this->zipcode;
    }

    /**
     * @param int|string $zipcode
     */
    public function setZipCode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param int|string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }
}
