<?php
/**
 * tests/ReaderTest.php
 *
 * @package     php-security-txt
 * @link        https://github.com/austinheap/php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.3.2
 */

namespace AustinHeap\Security\Txt\Tests;

use AustinHeap\Security\Txt\SecurityTxt;
use AustinHeap\Security\Txt\Reader;
use Exception;

require_once 'TestCase.php';

/**
 * ReaderTest
 */
class ReaderTest extends TestCase
{

    public function testConstructReaderValid()
    {
        $reader = new Reader();
        $securitytxt = new SecurityTxt($reader);

        $this->assertEquals($securitytxt->hasParent(), true);
        $this->assertEquals($securitytxt->getParentClass(), Reader::class);
        $this->assertEquals($securitytxt->getParent(), $reader);
    }

    public function testConstructReaderInvalid()
    {
        $this->expectException(Exception::class);
        $securitytxt = new SecurityTxt();

        $this->assertEquals($securitytxt->hasParent(), false);

        $this->expectException(Exception::class);
        $securitytxt->getParentClass();

        $this->expectException(Exception::class);
        $securitytxt->getParent();
    }

    public function testReaderExecute()
    {
        $this->expectException(Exception::class);

        (new Reader())->execute();
    }

    public function testReaderReset()
    {
        $this->expectException(Exception::class);

        (new Reader())->reset();
    }
}
