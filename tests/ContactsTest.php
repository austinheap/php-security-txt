<?php
/**
 * tests/ContactsTest.php
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
 * ContactsTest
 */
class ContactsTest extends TestCase
{
    public function testAddContactValid()
    {
        $securitytxt = new Writer();

        $securitytxt->addContact($this->newRandom('test%s@email.com'));

        $result = $securitytxt->getContacts();
        $result = array_pop($result);

        $this->assertEquals($result, $this->currentRandom());
    }

    public function testAddContactInvalid()
    {
        $securitytxt = new Writer();
        $result      = $this->newRandom('test%s_email.com');

        $this->expectException(Exception::class);

        $securitytxt->addContact($result);
    }

    public function testAddContactsValid()
    {
        $securitytxt = new Writer();

        $contact1 = $this->newRandom('testA%s@email.com');
        $contact2 = $this->newRandom('testB%s@email.com');
        $contact3 = $this->newRandom('testC%s@email.com');
        $contact4 = $this->newRandom('testD%s@email.com');

        $result = [$contact1, $contact2, $contact3, $contact4];

        $securitytxt->addContacts($result);

        $this->assertEquals(count($securitytxt->getContacts()), count($result));
    }

    public function testAddContactsInvalid()
    {
        $securitytxt = new Writer();

        $contact1 = $this->newRandom('testA%s_email.com');
        $contact2 = $this->newRandom('testB%s!email.com');
        $contact3 = $this->newRandom('testC%s&email.com');
        $contact4 = $this->newRandom('testD%s_email.com');

        $result = [$contact1, $contact2, $contact3, $contact4];

        $this->expectException(Exception::class);

        $securitytxt->addContacts($result);
    }

    public function testRemoveContactValid()
    {
        $securitytxt = new Writer();

        $contact1 = $this->newRandom('testA%s@email.com');
        $contact2 = $this->newRandom('testB%s@email.com');
        $contact3 = $this->newRandom('testC%s@email.com');
        $contact4 = $this->newRandom('testD%s@email.com');

        $result = [$contact1, $contact2, $contact3, $contact4];

        $securitytxt->addContacts($result);
        $securitytxt->removeContact($contact2);

        $this->assertEquals(count($securitytxt->getContacts()), count($result) - 1);

        $securitytxt->removeContact($contact4);

        $this->assertEquals(count($securitytxt->getContacts()), count($result) - 2);
    }

    public function testRemoveContactInvalid()
    {
        $securitytxt = new Writer();

        $contact1 = $this->newRandom('testA%s@email.com');
        $contact2 = $this->newRandom('testB%s@email.com');
        $contact3 = $this->newRandom('testC%s@email.com');
        $contact4 = $this->newRandom('testD%s@email.com');
        $contact5 = $this->newRandom('testE%s@email.com');

        $result = [$contact1, $contact2, $contact3, $contact4];

        $securitytxt->addContacts($result);

        $this->expectException(Exception::class);

        $securitytxt->removeContact($contact5);
    }

    public function testRemoveContactsValid()
    {
        $securitytxt = new Writer();

        $contact1 = $this->newRandom('testA%s@email.com');
        $contact2 = $this->newRandom('testB%s@email.com');
        $contact3 = $this->newRandom('testC%s@email.com');
        $contact4 = $this->newRandom('testD%s@email.com');

        $result = [$contact1, $contact2, $contact3, $contact4];

        $securitytxt->addContacts($result);
        $securitytxt->removeContacts([$contact2, $contact4]);

        $this->assertEquals(count($securitytxt->getContacts()), count($result) - 2);
    }

    public function testRemoveContactsInvalid()
    {
        $securitytxt = new Writer();

        $contact1 = $this->newRandom('testA%s@email.com');
        $contact2 = $this->newRandom('testB%s@email.com');
        $contact3 = $this->newRandom('testC%s@email.com');
        $contact4 = $this->newRandom('testD%s@email.com');
        $contact5 = $this->newRandom('testE%s@email.com');
        $contact6 = $this->newRandom('testF%s@email.com');

        $result = [$contact1, $contact2, $contact3, $contact4];

        $securitytxt->addContacts($result);

        $this->expectException(Exception::class);

        $securitytxt->removeContacts([$contact5, $contact6]);
    }

    public function testSetContactsValid()
    {
        $securitytxt = new Writer();

        $contact1 = $this->newRandom('testA%s@email.com');
        $contact2 = $this->newRandom('testB%s@email.com');
        $contact3 = $this->newRandom('testC%s@email.com');
        $contact4 = $this->newRandom('testD%s@email.com');

        $result = [$contact1 => true, $contact2 => true, $contact3 => true, $contact4 => true];

        $securitytxt->setContacts($result);

        $this->assertEquals(count($securitytxt->getContacts()), count($result));
    }

    public function testSetContactsInvalid()
    {
        $securitytxt = new Writer();

        $contact1 = $this->newRandom('testA%s_email.com');
        $contact2 = $this->newRandom('testB%s!email.com');
        $contact3 = $this->newRandom('testC%s&email.com');
        $contact4 = $this->newRandom('testD%s_email.com');

        $result = [$contact1 => true, $contact2 => true, $contact3 => true, $contact4 => true];

        $this->expectException(Exception::class);

        $securitytxt->setContacts($result);
    }

    public function testRenderContact()
    {
        $securitytxt = new Writer();

        $contact = $this->newRandom('testA%s@email.com');
        $result  = $securitytxt->addContact($contact)
                               ->execute()
                               ->getText();

        $this->assertContains($contact, $result);
    }

    public function testRenderEmptyContact()
    {
        $securitytxt = new Writer();

        $this->expectException(Exception::class);

        $securitytxt->execute()->getText();
    }

}
