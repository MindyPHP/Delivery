<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery\Method;

interface DeliveryMethodInterface
{
    public function getType();

    public function getMethodName();

    public function getParams();
}
