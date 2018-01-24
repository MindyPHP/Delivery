<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery;

use Mindy\Delivery\Service\DeliveryServiceInterface;

class Factory
{
    /**
     * @var DeliveryServiceInterface[]
     */
    protected $services = [];

    /**
     * @param string                   $code
     * @param DeliveryServiceInterface $service
     */
    public function registerService(string $code, DeliveryServiceInterface $service)
    {
        $this->services[$code] = $service;
    }

    /**
     * @param $code
     *
     * @return DeliveryServiceInterface|null
     */
    public function getService($code)
    {
        if (isset($this->services[$code])) {
            return $this->services[$code];
        }

        return null;
    }

    public function getServices(): array
    {
        return $this->services;
    }
}
