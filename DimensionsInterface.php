<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery;

interface DimensionsInterface
{
    /**
     * @return float
     */
    public function getLength();

    /**
     * @return float
     */
    public function getHeight();

    /**
     * @return float
     */
    public function getWidth();

    /**
     * @return float
     */
    public function getWeight();

    /**
     * Объем
     *
     * @return float
     */
    public function getVolume();

    /**
     * @return array
     */
    public function toArray(): array;
}
