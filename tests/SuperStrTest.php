<?php

namespace Konexia\SuperStr\Test;

use PHPUnit\Framework\TestCase;
use Konexia\SuperStr\SuperStrCore;
use Konexia\SuperStr\SuperStr;


class SuperStrCoreTest extends TestCase
{
    public function testPrependUsingFunction()
    {
        $result = super_str('world')->prepend('hello ')->get();
        $this->assertEquals('hello world', $result);
    }

    public function testPrependUsingStaticClass()
    {
        $result = SuperStr::set('world')->prepend('hello ')->get();
        $this->assertEquals('hello world', $result);
    }

    public function testPrepend()
    {
        $result = super_str('world')->prepend('hello ')->get();
        $this->assertEquals('hello world', $result);
    }

    public function testAppend()
    {
        $str = new SuperStrCore('hello');
        $result = $str->append(' world')->get();
        $this->assertEquals('hello world', $result);
    }

    public function testToUpper()
    {
        $str = new SuperStrCore('hello world');
        $result = $str->toUpper()->get();
        $this->assertEquals('HELLO WORLD', $result);
    }

    public function testToLower()
    {
        $str = new SuperStrCore('HELLO WORLD');
        $result = $str->toLower()->get();
        $this->assertEquals('hello world', $result);
    }

    public function testCapitalize()
    {
        $str = new SuperStrCore('hELLO wORLD');
        $result = $str->capitalize()->get();
        $this->assertEquals('Hello world', $result);
    }

    public function testExtractBetween()
    {
        $str = new SuperStrCore('Hello [world]!');
        $result = $str->extractBetween('[', ']');
        $this->assertEquals('world', $result);
    }

    public function testDo()
    {
        $str = new SuperStrCore('hello');
        $result = $str->do(function($value) {
            return strtoupper($value);
        })->get();
        $this->assertEquals('HELLO', $result);
    }

    public function testReplaceCaseSensitive()
    {
        $str = new SuperStrCore('Hello World');
        $result = $str->replace('World', 'PHP')->get();
        $this->assertEquals('Hello PHP', $result);
    }

    public function testReplaceCaseInsensitive()
    {
        $str = new SuperStrCore('Hello World');
        $result = $str->replace('world', 'PHP', false)->get();
        $this->assertEquals('Hello PHP', $result);
    }

    public function testContains()
    {
        $str = new SuperStrCore('Hello World');
        $str->contains('World')->toUpper();
        $this->assertEquals('HELLO WORLD', $str->get());
    }

    public function testNotContains()
    {
        $str = new SuperStrCore('Hello World');
        $str->notContains('PHP')->toUpper();
        $this->assertEquals('HELLO WORLD', $str->get());
    }

    public function testIfConditionTrue()
    {
        $str = new SuperStrCore('Hello');
        $str->if(function($value) {
            return $value === 'Hello';
        })->append(' World');
        $this->assertEquals('Hello World', $str->get());
    }

    public function testIfConditionFalse()
    {
        $str = new SuperStrCore('Hello');
        $str->if(function($value) {
            return $value === 'Goodbye';
        })->append(' World');
        $this->assertEquals('Hello', $str->get());
    }

    public function testTrim()
    {
        $str = new SuperStrCore('  Hello World  ');
        $result = $str->trim()->get();
        $this->assertEquals('Hello World', $result);
    }

    public function testLtrim()
    {
        $str = new SuperStrCore('  Hello World');
        $result = $str->ltrim()->get();
        $this->assertEquals('Hello World', $result);
    }

    public function testRtrim()
    {
        $str = new SuperStrCore('Hello World  ');
        $result = $str->rtrim()->get();
        $this->assertEquals('Hello World', $result);
    }

    public function testLength()
    {
        $str = new SuperStrCore('Hello World');
        $result = $str->length();
        $this->assertEquals(11, $result);
    }

    public function testSlugify()
    {
        $str = new SuperStrCore('Héllo World! ');
        $result = $str->slugify()->get();
        $this->assertEquals('hello-world', $result);
    }

    public function testSlugifyWithLengthLimit()
    {
        $str = new SuperStrCore('Hello Bëautiful World!');
        $result = $str->slugify(10)->get();
        $this->assertEquals('hello-beau', $result);
    }

}

?>
