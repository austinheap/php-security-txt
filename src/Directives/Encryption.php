<?php
/**
 * src/Directives/Encryption.php
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
 * Encryption
 *
 * @link        https://github.com/austinheap/php-security-txt
 * @link        https://packagist.org/packages/austinheap/php-security-txt
 * @link        https://austinheap.github.io/php-security-txt/classes/AustinHeap.Security.Txt.SecurityTxt.html
 */
trait Encryption
{

    /**
     * The PGP key file URL.
     *
     * @var string
     */
    protected $encryption = null;


    /**
     * Set the encryption.
     *
     * @param  string $encryption
     *
     * @return SecurityTxt
     */
    public function setEncryption(string $encryption): SecurityTxt
    {
        if (!$this->validEncryption($encryption)) {
            throw new Exception('Encryption must be a well-formed URL.');
        }

        $this->encryption = $encryption;

        return $this;
    }

    /**
     * Get the encryption.
     *
     * @return string
     */
    public function getEncryption(): string
    {
        return $this->encryption;
    }

    /**
     * Determines if encryption is valid.
     *
     * @param string $encryption
     *
     * @return bool
     */
    public function validEncryption(string $encryption): bool
    {
        return filter_var($encryption, FILTER_VALIDATE_URL) !== false;
    }
}
