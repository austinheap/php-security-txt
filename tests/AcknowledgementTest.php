<?php
/**
 * tests/AcknowledgementTest.php
 *
 * @package     php-security-txt
 * @link        https://github.com/austinheap/php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.3.2
 */

namespace AustinHeap\Security\Txt\Tests;

use AustinHeap\Security\Txt\Writer;
use Exception;

require_once 'TestCase.php';

/**
 * AcknowledgementTest
 */
class AcknowledgementTest extends TestCase
{

    public function testSetAcknowledgementValid()
    {
        $securitytxt = new Writer();
        $result      = $this->newRandom('https://www.testdomain%s.com/.well-known/gpg.txt');

        $securitytxt->setAcknowledgement($result);

        $this->assertEquals($result, $securitytxt->getAcknowledgement());
    }

    public function testSetAcknowledgementInvalid()
    {
        $securitytxt = new Writer();
        $result      = $this->newRandom('http://baddomain%s/ well-known/gpg.txt');

        $this->expectException(Exception::class);

        $securitytxt->setAcknowledgement($result);
    }

    public function testRenderAcknowledgement()
    {
        $securitytxt = new Writer();

        $acknowledgement = $this->newRandom('https://www.testdomain%s.com/.well-known/gpg.txt');
        $result     = $securitytxt->addContact($this->newRandom('test%s@email.com'))
                                  ->setAcknowledgement($acknowledgement)
                                  ->execute()
                                  ->getText();

        $this->assertContains($acknowledgement, $result);
    }

}
