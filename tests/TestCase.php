<?php
/**
 * tests/TestCase.php
 *
 * @package     php-security-txt
 * @link        https://github.com/austinheap/php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.3.2
 */

namespace AustinHeap\Security\Txt\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * TestCase
 */
class TestCase extends BaseTestCase
{
    protected $last_random;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        require_once implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'src', 'SecurityTxtInterface.php']);
        require_once implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'src', 'SecurityTxt.php']);
        require_once implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'src', 'Reader.php']);
        require_once implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'src', 'Writer.php']);
    }

    protected function newRandom($value) {
        $this->last_random = sprintf($value, (string) rand(1111, 9999));
        return $this->last_random;
    }

    protected function currentRandom() {
        return $this->last_random;
    }

    public function testTestCase() {
        $this->assertEquals('placeholder to silence phpunit warnings', 'placeholder to silence phpunit warnings');
    }
}
