<?php

namespace Konexia\SuperStr\Test;

use PHPUnit\Framework\TestCase;
use Konexia\SuperStr\SuperStr;
use Konexia\SuperStr\Sstr;


class SuperStrTest extends TestCase
{
    public function testPrependUsingFunction()
    {
        $result = super_str('world')->prepend('hello ')->get();
        $this->assertEquals('hello world', $result);
    }

    public function testPrependUsingStaticClass()
    {
        $result = Sstr::set('world')->prepend('hello ')->get();
        $this->assertEquals('hello world', $result);
    }

    public function testPrepend()
    {
        $result = super_str('world')->prepend('hello ')->get();
        $this->assertEquals('hello world', $result);
    }

    public function testAppend()
    {
        $str = new SuperStr('hello');
        $result = $str->append(' world')->get();
        $this->assertEquals('hello world', $result);
    }

    public function testToUpper()
    {
        $str = new SuperStr('hello world');
        $result = $str->toUpper()->get();
        $this->assertEquals('HELLO WORLD', $result);
    }

    public function testToLower()
    {
        $str = new SuperStr('HELLO WORLD');
        $result = $str->toLower()->get();
        $this->assertEquals('hello world', $result);
    }

    public function testCapitalize()
    {
        $str = new SuperStr('hELLO wORLD');
        $result = $str->capitalize()->get();
        $this->assertEquals('Hello world', $result);
    }

    public function testExtractBetween()
    {
        $str = new SuperStr('Hello [world]!');
        $result = $str->extractBetween('[', ']');
        $this->assertEquals('world', $result);
    }

    public function testDo()
    {
        $str = new SuperStr('hello');
        $result = $str->do(function($value) {
            return strtoupper($value);
        })->get();
        $this->assertEquals('HELLO', $result);
    }

    public function testReplaceCaseSensitive()
    {
        $str = new SuperStr('Hello World');
        $result = $str->replace('World', 'PHP')->get();
        $this->assertEquals('Hello PHP', $result);
    }

    public function testReplaceCaseInsensitive()
    {
        $str = new SuperStr('Hello World');
        $result = $str->replace('world', 'PHP', false)->get();
        $this->assertEquals('Hello PHP', $result);
    }

    public function testContains()
    {
        $str = new SuperStr('Hello World');
        $str->contains('World')->toUpper();
        $this->assertEquals('HELLO WORLD', $str->get());
    }

    public function testNotContains()
    {
        $str = new SuperStr('Hello World');
        $str->notContains('PHP')->toUpper();
        $this->assertEquals('HELLO WORLD', $str->get());
    }

    public function testIfConditionTrue()
    {
        $str = new SuperStr('Hello');
        $str->if(function($value) {
            return $value === 'Hello';
        })->append(' World');
        $this->assertEquals('Hello World', $str->get());
    }

    public function testIfConditionFalse()
    {
        $str = new SuperStr('Hello');
        $str->if(function($value) {
            return $value === 'Goodbye';
        })->append(' World');
        $this->assertEquals('Hello', $str->get());
    }

    public function testTrim()
    {
        $str = new SuperStr('  Hello World  ');
        $result = $str->trim()->get();
        $this->assertEquals('Hello World', $result);
    }

    public function testLtrim()
    {
        $str = new SuperStr('  Hello World');
        $result = $str->ltrim()->get();
        $this->assertEquals('Hello World', $result);
    }

    public function testRtrim()
    {
        $str = new SuperStr('Hello World  ');
        $result = $str->rtrim()->get();
        $this->assertEquals('Hello World', $result);
    }

    public function testLength()
    {
        $str = new SuperStr('Hello World');
        $result = $str->length();
        $this->assertEquals(11, $result);
    }

    public function testSlugify()
    {
        $str = new SuperStr('Héllo World! ');
        $result = $str->slugify()->get();
        $this->assertEquals('hello-world', $result);
    }

    public function testSlugifyWithLengthLimit()
    {
        $str = new SuperStr('Hello Bëautiful World!');
        $result = $str->slugify(10)->get();
        $this->assertEquals('hello-beau', $result);
    }

    public function testTruncate()
    {
        $str = new SuperStr('Hello, how are you today?');
        
        // Case where truncation happens without splitting words
        $result = $str->truncate(10)->get();
        $this->assertEquals('Hello, how…', $result);
    
        // Case where truncation happens exactly at a word
        $str = new SuperStr('Hello, how are you today?');
        $result = $str->truncate(15)->get();
        $this->assertEquals('Hello, how are…', $result);
    
        // Case where no truncation is needed
        $str = new SuperStr('Hello, how are you today?');
        $result = $str->truncate(30)->get();
        $this->assertEquals('Hello, how are you today?', $result);
    
        // Case with custom append string
        $str = new SuperStr('Hello, how are you today?');
        $result = $str->truncate(12, '~')->get();
        $this->assertEquals('Hello, how~', $result);

        // Case with cut word (but not first word)
        $str = new SuperStr('Hello, how are you today?');
        $result = $str->truncate(21)->get();
        $this->assertEquals('Hello, how are you…', $result);
    
        // Case with truncation at the first word (not whole word)
        $str = new SuperStr('Hello, how are you today?');
        $result = $str->truncate(5)->get();
        $this->assertEquals('Hello…', $result);
    
        // Case where truncation removes all but one word
        $str = new SuperStr('Hello, how are you today?');
        $result = $str->truncate(7)->get();
        $this->assertEquals('Hello,…', $result);
    
        // Case with a very short max length that doesn't reach a complete word
        $str = new SuperStr('Hello, how are you today?');
        $result = $str->truncate(3)->get();
        $this->assertEquals('Hel…', $result);
    
        // Case with max length equal to the length of the first word
        $str = new SuperStr('Hello, how are you today?');
        $result = $str->truncate(6)->get();
        $this->assertEquals('Hello,…', $result);
    }
    


    public function testFirstUpper()
    {
        $str = new SuperStr('hello world');
        $result = $str->firstUpper()->get();
        $this->assertEquals('Hello world', $result);
    }

    public function testFirstLower()
    {
        $str = new SuperStr('Hello World');
        $result = $str->firstLower()->get();
        $this->assertEquals('hello World', $result);
    }

    public function testSubstring()
    {
        $str = new SuperStr('Example String');
        $result = $str->substring(0, 7)->get();
        $this->assertEquals('Example', $result);
    
        $str = new SuperStr('Example String');
        $result = $str->substring(8)->get();
        $this->assertEquals('String', $result);
    
        $str = new SuperStr('Example String');
        $result = $str->substring(-4)->get();
        $this->assertEquals('ring', $result);
    }
    
    public function testReverse()
    {
        $str = new SuperStr('Example');
        $result = $str->reverse()->get();
        $this->assertEquals('elpmaxE', $result);
    }
    

}

?>
