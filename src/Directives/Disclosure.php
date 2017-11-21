<?php
/**
 * src/Directives/Disclosure.php
 *
 * @package     php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.4.0
 */

declare(strict_types = 1);

namespace AustinHeap\Security\Txt\Directives;

use AustinHeap\Security\Txt\SecurityTxt;
use Exception;

/**
 * Disclosure
 *
 * @link        https://github.com/austinheap/php-security-txt
 * @link        https://packagist.org/packages/austinheap/php-security-txt
 * @link        https://austinheap.github.io/php-security-txt/classes/AustinHeap.Security.Txt.SecurityTxt.html
 */
trait Disclosure
{

    /**
     * The disclosure policy.
     *
     * @var string
     */
    protected $disclosure = null;

    /**
     * Set the disclosure policy.
     *
     * @param  string $disclosure
     *
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function setDisclosure(string $disclosure): SecurityTxt
    {
        if (!$this->validDisclosure($disclosure)) {
            throw new Exception('Disclosure policy must be either "full", "partial", or "none".');
        }

        $this->disclosure = $disclosure;

        return $this;
    }

    /**
     * Get the disclosure policy.
     *
     * @return string
     */
    public function getDisclosure(): string
    {
        return $this->disclosure;
    }

    /**
     * Determines if disclosure is valid.
     *
     * @param string $disclosure
     *
     * @return bool
     */
    public function validDisclosure(string $disclosure): bool
    {
        return in_array($disclosure, ['full', 'partial', 'none'], true);
    }
}
