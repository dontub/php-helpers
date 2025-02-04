<?php

namespace AndreasGlaser\Helpers\Tests;

use AndreasGlaser\Helpers\JsonHelper;

/**
 * Class JsonHelperTest
 *
 * @package AndreasGlaser\Helpers\Tests
 */
class JsonHelperTest extends BaseTest
{
    /**
     */
    public function testIsValid()
    {
        $this->assertTrue(JsonHelper::isValid(123));
        $this->assertTrue(JsonHelper::isValid(123.43));
        $this->assertTrue(JsonHelper::isValid(true));
        $this->assertFalse(JsonHelper::isValid(false));
        $this->assertFalse(JsonHelper::isValid(null));
        $this->assertTrue(JsonHelper::isValid('true'));
        $this->assertTrue(JsonHelper::isValid('false'));
        $this->assertTrue(JsonHelper::isValid('null'));
        $this->assertTrue(JsonHelper::isValid('"abc"'));
        $this->assertFalse(JsonHelper::isValid("'abc'"));
        $this->assertFalse(JsonHelper::isValid('00 11 22'));
        $this->assertTrue(JsonHelper::isValid('[1,2,3, null, true, false, "abc"]'));
        $this->assertTrue(JsonHelper::isValid('{"a":{},"b":false}'));
        $this->assertTrue(JsonHelper::isValid('[1,2,3,4]'));
        $this->assertTrue(JsonHelper::isValid('{"b":{},"c":[{},[1,2,3,true,false,null]]}'));
    }
}