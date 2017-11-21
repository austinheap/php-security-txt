<?php
/**
 * tests/EncryptionTest.php
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
 * EncryptionTest
 */
class EncryptionTest extends TestCase
{

    public function testSetEncryptionValid()
    {
        $securitytxt = new Writer();
        $result      = $this->newRandom('https://www.testdomain%s.com/.well-known/gpg.txt');

        $securitytxt->setEncryption($result);

        $this->assertEquals($result, $securitytxt->getEncryption());
    }

    public function testSetEncryptionInvalid()
    {
        $securitytxt = new Writer();
        $result      = $this->newRandom('http://baddomain%s/ well-known/gpg.txt');

        $this->expectException(Exception::class);

        $securitytxt->setEncryption($result);
    }

    public function testRenderEncryption()
    {
        $securitytxt = new Writer();

        $encryption = $this->newRandom('https://www.testdomain%s.com/.well-known/gpg.txt');
        $result     = $securitytxt->addContact($this->newRandom('test%s@email.com'))
                                  ->setEncryption($encryption)
                                  ->execute()
                                  ->getText();

        $this->assertContains($encryption, $result);
    }

}
