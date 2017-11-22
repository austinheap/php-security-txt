<?php
/**
 * tests/CommentsTest.php
 *
 * @package     php-security-txt
 * @link        https://github.com/austinheap/php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.3.2
 */

namespace AustinHeap\Security\Txt\Tests;

use AustinHeap\Security\Txt\Writer;

require_once 'TestCase.php';

/**
 * CommentsTest
 */
class CommentsTest extends TestCase
{

//    public function testSetDebug()
//    {
//        $securitytxt = new Writer();
//
//        $securitytxt->setDebug(true);
//
//        $this->assertEquals(true, $securitytxt->getDebug());
//
//        $securitytxt->setDebug(false);
//
//        $this->assertEquals(false, $securitytxt->getDebug());
//    }

    public function testEnableComments()
    {
        $securitytxt = new Writer();

        $securitytxt->setComments(false);

        $this->assertEquals(false, $securitytxt->getComments());

        $securitytxt->enableComments();

        $this->assertEquals(true, $securitytxt->getComments());
    }

    public function testDisableComments()
    {
        $securitytxt = new Writer();

        $securitytxt->setComments(true);

        $this->assertEquals(true, $securitytxt->getComments());

        $securitytxt->disableComments();

        $this->assertEquals(false, $securitytxt->getComments());
    }

    public function testRenderDebug()
    {
        $securitytxt = new Writer();

        $contact = $this->newRandom('testA%s@email.com');
        $result  = $securitytxt->addContact($contact)
                               ->enableComments()
                               ->execute()
                               ->getText();

        $this->assertContains('', $result);
    }

}
