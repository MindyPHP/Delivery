<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery;

interface LocationInterface
{
    /**
     * @return int|string
     */
    public function getCountry();

    /**
     * @return int|string
     */
    public function getRegion();

    /**
     * @return int|string
     */
    public function getCity();

    /**
     * @return int|string
     */
    public function getZipCode();

    /**
     * @return int|string
     */
    public function getAddress();
}
