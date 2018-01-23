<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery\Service;

use Mindy\Delivery\DimensionsInterface;
use Mindy\Delivery\LocationInterface;
use Mindy\Delivery\ParametersInterface;
use Mindy\Delivery\ResultInterface;

interface DeliveryServiceInterface
{
    /**
     * @param LocationInterface   $from
     * @param LocationInterface   $to
     * @param DimensionsInterface $dimensions
     * @param ParametersInterface $parameters
     *
     * @return ResultInterface
     */
    public function getPrice(LocationInterface $from, LocationInterface $to, DimensionsInterface $dimensions, ParametersInterface $parameters = null): ResultInterface;

    /**
     * @param LocationInterface $location
     *
     * @return bool
     */
    public function support(LocationInterface $location): bool;
}
