<?php
/**
 * src/Reader.php
 *
 * @package     php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.3.2
 */

declare(strict_types=1);

namespace AustinHeap\Security\Txt;

/**
 * Reader
 *
 * @link        https://github.com/austinheap/php-security-txt
 * @link        https://packagist.org/packages/austinheap/php-security-txt
 * @link        https://austinheap.github.io/php-security-txt/classes/AustinHeap.Security.Txt.Reader.html
 */
class Reader extends SecurityTxt
{

    /**
     * Create a new Reader instance.
     *
     * @return Reader
     */
    public function __construct()
    {
        return parent::__construct($this);
    }
}
