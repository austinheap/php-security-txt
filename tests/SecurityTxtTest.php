<?php
/**
 * tests/SecurityTxtTest.php
 *
 * @package     php-security-txt
 * @link        https://github.com/austinheap/php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.3.2
 */

use AustinHeap\Security\Txt\SecurityTxt;

/**
 * SecurityTxtTest
 */
class SecurityTxtTest extends \PHPUnit\Framework\TestCase
{

    public function testPlaceholder()
    {
        $this->assertEquals('', '');
    }

}
