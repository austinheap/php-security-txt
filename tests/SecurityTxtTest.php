<?php
/**
 * tests/SecurityTxtTest.php
 *
 * @package     php-security-txt
 * @link        https://github.com/austinheap/php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.3.2
 */

namespace AustinHeap\Security\Txt\Tests;

use AustinHeap\Security\Txt\SecurityTxt;
use Exception;
use DateTime;

/**
 * SecurityTxtTest
 */
class SecurityTxtTest extends TestCase
{

    public function testConstructParentInvalid()
    {
        $parent = new DateTime();

        $this->expectException(Exception::class);
        $securitytxt = new SecurityTxt($parent);

        $this->assertEquals($securitytxt->hasParent(), false);

        $this->expectException(Exception::class);
        $securitytxt->getParentClass();

        $this->expectException(Exception::class);
        $securitytxt->getParent();
    }

    public function testConstructParentNull()
    {
        $parent = null;

        $this->expectException(Exception::class);
        $securitytxt = new SecurityTxt($parent);

        $this->assertEquals($securitytxt->hasParent(), false);

        $this->expectException(Exception::class);
        $securitytxt->getParentClass();

        $this->expectException(Exception::class);
        $securitytxt->getParent();
    }

    public function testExecuteNotOverriden()
    {
        $securitytxt = new SecurityTxt();

        $this->expectException(Exception::class);
        $securitytxt->execute();

        $this->assertEquals($securitytxt->execute(true), null);
    }

    public function testResetNotOverriden()
    {
        $securitytxt = new SecurityTxt();

        $this->expectException(Exception::class);
        $securitytxt->reset();

        $this->assertEquals($securitytxt->reset(true), null);
    }

    public function testOverrideMissing()
    {
        $securitytxt = new SecurityTxt();

        $this->assertEquals($securitytxt->overrideMissing(__FUNCTION__, true), null);
    }

}
