<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery\Service\Dummy;

use Mindy\Delivery\DimensionsInterface;
use Mindy\Delivery\LocationInterface;
use Mindy\Delivery\ParametersInterface;
use Mindy\Delivery\Result;
use Mindy\Delivery\ResultInterface;
use Mindy\Delivery\Service\DeliveryServiceInterface;

class MockService implements DeliveryServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPrice(LocationInterface $from, LocationInterface $to, DimensionsInterface $dimensions, ParametersInterface $parameters = null): ResultInterface
    {
        $result = new Result();
        $result->setDays(1);
        $result->setPrice(100);

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function support(LocationInterface $location): bool
    {
        return true;
    }
}
