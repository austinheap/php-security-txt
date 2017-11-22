<?php
/**
 * src/Reader.php
 *
 * @package     php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.4.0
 */

declare(strict_types = 1);

namespace AustinHeap\Security\Txt;

use Exception;

/**
 * Reader
 *
 * @link        https://github.com/austinheap/php-security-txt
 * @link        https://packagist.org/packages/austinheap/php-security-txt
 * @link        https://austinheap.github.io/php-security-txt/classes/AustinHeap.Security.Txt.Reader.html
 */
class Reader extends SecurityTxt implements SecurityTxtInterface
{

    /**
     * Create a new Reader instance.
     *
     * @return Reader|SecurityTxt
     */
    public function __construct()
    {
        return parent::__construct($this);
    }

    /**
     * Placeholder execute function until this class is flushed out.
     *
     * @param bool $test_case
     *
     * @return Reader
     * @throws Exception
     */
    public function execute(bool $test_case = false)
    {
        throw new Exception('Function not implemented.');
    }

    /**
     * Placeholder reset function until this class is flushed out.
     *
     * @param bool $test_case
     *
     * @return Reader
     * @throws Exception
     */
    public function reset(bool $test_case = false)
    {
        throw new Exception('Function not implemented.');
    }
}
