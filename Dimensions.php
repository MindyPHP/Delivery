<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery;

class Dimensions implements DimensionsInterface
{
    /**
     * @var float
     */
    protected $volume;
    /**
     * @var float
     */
    protected $weight;
    /**
     * @var float
     */
    protected $width;
    /**
     * @var float
     */
    protected $height;
    /**
     * @var float
     */
    protected $length;

    /**
     * {@inheritdoc}
     */
    public function getLength()
    {
        return (float) $this->length;
    }

    /**
     * @param float $length
     */
    public function setLength($length)
    {
        $this->length = (float) $length;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeight()
    {
        return (float) $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight($height)
    {
        $this->height = (float) $height;
    }

    /**
     * {@inheritdoc}
     */
    public function getWidth()
    {
        return (float) $this->width;
    }

    /**
     * @param float $width
     */
    public function setWidth($width)
    {
        $this->width = (float) $width;
    }

    /**
     * {@inheritdoc}
     */
    public function getWeight()
    {
        return (float) $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = (float) $weight;
    }

    /**
     * {@inheritdoc}
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param float $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }
}
