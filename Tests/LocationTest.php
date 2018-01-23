<?php
/**
 * Created by IntelliJ IDEA.
 * User: max
 * Date: 23/01/2018
 * Time: 20:48
 */

namespace Mindy\Delivery\Test;

use Mindy\Delivery\Location;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public function testLocationConstructor()
    {
        $location = new Location([
            'country' => 'russia',
            'region' => 'kirov',
            'city' => 'kirov',
            'address' => 'lenina 15',
            'zipcode' => '610000'
        ]);

        $this->assertSame('russia', $location->getCountry());
        $this->assertSame('kirov', $location->getRegion());
        $this->assertSame('kirov', $location->getCity());
        $this->assertSame('lenina 15', $location->getAddress());
        $this->assertSame('610000', $location->getZipCode());

        $this->assertSame('russia, kirov, kirov, lenina 15, 610000', $location->getFullAddress());
    }

    public function testLocationSetterGetter()
    {
        $location = new Location();

        $location->setCountry('russia');
        $this->assertSame('russia', $location->getCountry());

        $location->setRegion('kirov');
        $this->assertSame('kirov', $location->getRegion());

        $location->setCity('kirov');
        $this->assertSame('kirov', $location->getCity());

        $location->setAddress('lenina 15');
        $this->assertSame('lenina 15', $location->getAddress());

        $location->setZipCode('610000');
        $this->assertSame('610000', $location->getZipCode());
    }
}
