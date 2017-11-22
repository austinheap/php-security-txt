<?php
/**
 * tests/DisclosureTest.php
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
 * DisclosureTest
 */
class DisclosureTest extends TestCase
{

    public function testSetDisclosureValid()
    {
        foreach (['full', 'partial', 'none'] as $disclosure) {
            $securitytxt = new Writer();

            $securitytxt->setDisclosure($disclosure);

            $this->assertEquals($disclosure, $securitytxt->getDisclosure());
        }
    }

    public function testSetDisclosureInvalid()
    {
        $securitytxt = new Writer();
        $result      = $this->newRandom('badvalue%s');

        $this->expectException(Exception::class);

        $securitytxt->setDisclosure($result);
    }

    public function testRenderDisclosure()
    {
        $securitytxt = new Writer();

        foreach (['full', 'partial', 'none'] as $disclosure) {
            $result = $securitytxt->addContact($this->newRandom('test%s@email.com'))
                                  ->setDisclosure($disclosure)
                                  ->execute()
                                  ->getText();
        }

        $this->assertContains('Disclosure: ' . ucwords($disclosure), $result);
    }

}
