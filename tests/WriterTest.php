<?php
/**
 * tests/WriterTest.php
 *
 * @package     php-security-txt
 * @link        https://github.com/austinheap/php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.3.2
 */

namespace AustinHeap\Security\Txt\Tests;

use AustinHeap\Security\Txt\SecurityTxt;
use AustinHeap\Security\Txt\Writer;
use Exception;

require_once 'TestCase.php';

/**
 * WriterTest
 */
class WriterTest extends TestCase
{

    public function testConstructWriterValid()
    {
        $writer      = new Writer();
        $securitytxt = new SecurityTxt($writer);

        $this->assertEquals($securitytxt->hasParent(), true);
        $this->assertEquals($securitytxt->getParentClass(), Writer::class);
        $this->assertEquals($securitytxt->getParent(), $writer);
    }

    public function testConstructWriterInvalid()
    {
        $this->expectException(Exception::class);
        $securitytxt = new SecurityTxt();

        $this->assertEquals($securitytxt->hasParent(), false);

        $this->expectException(Exception::class);
        $securitytxt->getParentClass();

        $this->expectException(Exception::class);
        $securitytxt->getParent();
    }

    public function testReset()
    {
        $writer = (new Writer())->addContact($this->newRandom('test%s@email.com'));

        $this->assertContains('Contact: ' . $this->currentRandom(), $writer->execute()->getText());

        $writer->reset();

        $writer = (new Writer())->addContact($this->newRandom('test%s@email.com'));

        $this->assertContains('Contact: ' . $this->currentRandom(), $writer->execute()->getText());
    }

    public function testSpacer()
    {
        $writer = (new Writer())->addContact($this->newRandom('test%s@email.com'));
        $result = $writer->spacer()->spacer()->spacer()->execute()->getText();

        $this->assertStringStartsWith(str_repeat(PHP_EOL, 3), $result);
    }

    public function testSpacers()
    {
        $writer = (new Writer())->addContact($this->newRandom('test%s@email.com'));
        $count  = rand(1, 5);
        $result = $writer->spacers($count)->execute()->getText();

        $this->assertStringStartsWith(str_repeat(PHP_EOL, $count), $result);
    }

    public function testLine()
    {
        $writer = (new Writer())->addContact($this->newRandom('test%s@email.com'));
        $line   = $this->newRandom('some bogus test line #%s');
        $result = $writer->line($line)->execute()->getText();

        $this->assertContains($line, $result);
    }

    public function testLines()
    {
        $writer = (new Writer())->addContact($this->newRandom('test%s@email.com'));
        $lines  = [
            $this->newRandom('some bogus test line #%s'),
            $this->newRandom('some bogus test line #%s'),
            $this->newRandom('some bogus test line #%s'),
            $this->newRandom('some bogus test line #%s'),
            $this->newRandom('some bogus test line #%s'),
        ];
        $result = $writer->lines($lines)->execute()->getText();

        $this->assertContains(implode(PHP_EOL, $lines), $result);
    }

}
