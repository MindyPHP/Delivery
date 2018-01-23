<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery;

class Parameters implements ParametersInterface
{
    /**
     * @var bool
     */
    protected $selfPickup;
    /**
     * @var bool
     */
    protected $selfDelivery;

    /**
     * {@inheritdoc}
     */
    public function isSelfPickup()
    {
        return $this->selfPickup;
    }

    /**
     * @param bool $selfPickup
     */
    public function setSelfPickup($selfPickup)
    {
        $this->selfPickup = $selfPickup;
    }

    /**
     * {@inheritdoc}
     */
    public function isSelfDelivery()
    {
        return $this->selfDelivery;
    }

    /**
     * @param bool $selfDelivery
     */
    public function setSelfDelivery($selfDelivery)
    {
        $this->selfDelivery = $selfDelivery;
    }
}
