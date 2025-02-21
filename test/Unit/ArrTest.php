<?php

namespace Test\Unit;

use PainlessPHP\Array\Arr;
use PHPUnit\Framework\TestCase;

class ArrTest extends TestCase
{
    public function testMapAppliesMapperFunctionToValues()
    {
        $array = ['foo', 'bar', 'baz'];
        $result = Arr::map($array, fn($value) => "foo$value");

        $this->assertSame(['foofoo', 'foobar', 'foobaz'], $result);
    }

    public function testMapKeysAppliesMapperFunctionToKeys()
    {
        $array = ['foo' => 1, 'bar' => 2, 'baz' => 3];
        $result = Arr::mapKeys($array, fn($value) => "foo$value");

        $this->assertSame(['foofoo' => 1, 'foobar' => 2, 'foobaz' => 3], $result);
    }

    public function testMapKeysAndValuesMapsReturnedArrayAsValues()
    {
        $array = ['foo' => 1, 'bar' => 2, 'baz' => 3];
        $result = Arr::mapKeysAndValues($array, fn($key, $value) => ["foo$key" => $value * 10]);

        $this->assertSame(['foofoo' => 10, 'foobar' => 20, 'foobaz' => 30], $result);
    }
}
