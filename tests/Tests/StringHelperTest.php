<?php

namespace AndreasGlaser\Helpers\Tests;

use AndreasGlaser\Helpers\StringHelper;

/**
 * Class StringHelperTest
 *
 * @package AndreasGlaser\Helpers\Tests
 */
class StringHelperTest extends BaseTest
{
    /**
     * @var string
     */
    protected $testString = 'Hello there, this is a test string.';

    public function testIs()
    {
        $this->assertTrue(StringHelper::is($this->testString, 'Hello there, this is a test string.', true));
        $this->assertFalse(StringHelper::is($this->testString, 'Hello there, this is test string.', true));
        $this->assertTrue(StringHelper::is($this->testString, 'HELLO there, this is a TEST string.', false));
    }

    public function testIsOneOf()
    {
        $this->assertTrue(StringHelper::isOneOf($this->testString, ['Hello there, this is a test string.', 'cheese'], true));
        $this->assertFalse(StringHelper::isOneOf($this->testString, ['Hell', 'cheese'], true));
        $this->assertTrue(StringHelper::isOneOf($this->testString, ['Hello there, THIS is a test string.', 'cheese'], false));
    }

    public function testContains()
    {
        $this->assertTrue(StringHelper::contains($this->testString, 'this is', true));
        $this->assertFalse(StringHelper::contains($this->testString, 'strng', true));
        $this->assertTrue(StringHelper::contains($this->testString, 'STRING.', false));
    }

    public function testStringStartsWith()
    {
        $this->assertTrue(StringHelper::startsWith($this->testString, 'Hello', true));
        $this->assertFalse(StringHelper::startsWith($this->testString, 'Hellu', true));
        $this->assertTrue(StringHelper::startsWith($this->testString, 'HELLO', false));

        // strings always "start" with null/nothing
        $this->assertTrue(StringHelper::startsWith($this->testString, null, true));
        $this->assertTrue(StringHelper::startsWith($this->testString, null, false));
    }

    public function testStringEndsWith()
    {
        $this->assertTrue(StringHelper::endsWith($this->testString, 'string.', true));
        $this->assertFalse(StringHelper::endsWith($this->testString, 'string!', true));
        $this->assertTrue(StringHelper::endsWith($this->testString, 'STRING.', false));

        // strings always "end" with null/nothing
        $this->assertTrue(StringHelper::endsWith($this->testString, null, true));
        $this->assertTrue(StringHelper::endsWith($this->testString, null, false));
    }

    public function testTrimMulti()
    {
        $this->assertEquals(' there, this is a test string', StringHelper::trimMulti($this->testString, ['Hello', '.']));
        $this->assertNotEquals(' there, this is a test string', StringHelper::trimMulti($this->testString, ['Hello', ',']));
    }

    public function testRTrimMulti()
    {
        $this->assertEquals(' there, this is a test string.', StringHelper::lTrimMulti($this->testString, ['Hello']));
        $this->assertNotEquals('there, this is a test string.', StringHelper::lTrimMulti($this->testString, ['Hello', ',']));
    }

    public function testLTrimMulti()
    {
        $this->assertEquals('Hello there, this is a test ', StringHelper::rTrimMulti($this->testString, ['.', 'string']));
        $this->assertNotEquals('Hello there, this is a test string!', StringHelper::rTrimMulti($this->testString, ['.']));
    }

    public function testGetIncrementalId()
    {
        $this->assertEquals(0, StringHelper::getIncrementalId());
        $this->assertEquals(1, StringHelper::getIncrementalId());
        $this->assertEquals(2, StringHelper::getIncrementalId());
        $this->assertEquals(3, StringHelper::getIncrementalId());
        $this->assertEquals(4, StringHelper::getIncrementalId());

        $this->assertEquals('prefix_0', StringHelper::getIncrementalId('prefix_'));
        $this->assertEquals('prefix_1', StringHelper::getIncrementalId('prefix_'));
        $this->assertEquals('prefix_2', StringHelper::getIncrementalId('prefix_'));
    }

    public function testIsDateTime()
    {
        $this->assertTrue(StringHelper::isDateTime('2015-03-23'));
        $this->assertTrue(StringHelper::isDateTime('2015-03-23 22:21'));
        $this->assertTrue(StringHelper::isDateTime('5pm'));
        $this->assertTrue(StringHelper::isDateTime('+8 Weeks'));

        $this->assertFalse(StringHelper::isDateTime('2015-13-23 22:21'));
        $this->assertFalse(StringHelper::isDateTime('2015-12-23 25:21'));
        $this->assertFalse(StringHelper::isDateTime('N/A'));
        $this->assertFalse(StringHelper::isDateTime(null));
        $this->assertFalse(StringHelper::isDateTime(''));
    }

    public function testIsBlank()
    {
        $this->assertTrue(StringHelper::isBlank(' '));
        $this->assertTrue(StringHelper::isBlank('   '));
        $this->assertTrue(StringHelper::isBlank(null));
        $this->assertFalse(StringHelper::isBlank('a'));
        $this->assertFalse(StringHelper::isBlank(' a  '));
        $this->assertFalse(StringHelper::isBlank(0));
    }

    public function testRemoveFromStart()
    {
        $this->assertEquals(' is a string', StringHelper::removeFromStart('this is a string', 'this'));
        $this->assertEquals('this is a string', StringHelper::removeFromStart('this is a string', 'This'));
        $this->assertEquals(' is a string', StringHelper::removeFromStart('this is a string', 'This', false));
        $this->assertEquals('this is a string', StringHelper::removeFromStart('this is a string', 'XYZ'));
    }

    public function testRemoveFromEnd()
    {
        $this->assertEquals('this is a ', StringHelper::removeFromEnd('this is a string', 'string'));
        $this->assertEquals('this is a string', StringHelper::removeFromEnd('this is a string', 'String'));
        $this->assertEquals('this is a ', StringHelper::removeFromEnd('this is a string', 'String', false));
        $this->assertEquals('this is a string', StringHelper::removeFromEnd('this is a string', 'XYZ'));
    }

    public function testLinesToArray()
    {
        $testString = "Line1\nLine2\rLine3\r\nLine4";

        $lines = StringHelper::linesToArray($testString);

        $this->assertCount(4, $lines);
        $this->assertEquals('Line1', $lines[0]);
        $this->assertEquals('Line2', $lines[1]);
        $this->assertEquals('Line3', $lines[2]);
        $this->assertEquals('Line4', $lines[3]);
    }
}
 