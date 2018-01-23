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
     * @var string
     */
    protected $country;
    /**
     * @var string
     */
    protected $region;
    /**
     * @var string
     */
    protected $city;
    /**
     * @var string|int
     */
    protected $zipcode;
    /**
     * @var string
     */
    protected $address;

    /**
     * Location constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
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
     * @param string $region
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
     * @param string $city
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
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * {@inheritdoc}
     */
    public function getFullAddress()
    {
        $data = [
            $this->country,
            $this->region,
            $this->city,
            $this->address,
            $this->zipcode
        ];

        return implode(', ', array_filter($data));
    }
}
