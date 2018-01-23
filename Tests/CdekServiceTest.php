<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery;

use Mindy\Delivery\Service\CdekService;
use PHPUnit\Framework\TestCase;

class CdekServiceTest extends TestCase
{
    public function testDelivery()
    {
        $service = new CdekService('', '');

        $this->assertNotEmpty($service->searchCity('Киров'));

        $this->assertInstanceOf(ResultInterface::class, $service->getPrice(
            new Location(['city' => 'Киров']),
            new Location(['city' => 'Санкт-Петербург']),
            new Dimensions(),
            new Parameters()
        ));
    }
}
