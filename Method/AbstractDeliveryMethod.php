<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Delivery\Method;

class AbstractDeliveryMethod implements DeliveryMethodInterface
{
    protected $type;
    protected $methodName;
    protected $params = [];

    public function initialize(array $params)
    {
        if (!isset($params['type'], $params['method_name'])) {
            throw new \RuntimeException('Missing mandatory params. Required type and method_name.');
        }

        $this->type = $params['type'];
        $this->methodName = $params['method_name'];
    }

    public function getType()
    {
        return $this->type;
    }

    public function getMethodName()
    {
        return $this->methodName;
    }

    public function getParams()
    {
        return $this->params;
    }
}
