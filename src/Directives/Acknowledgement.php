<?php
/**
 * src/Directives/Acknowledgement.php
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
 * Acknowledgement
 *
 * @link        https://github.com/austinheap/php-security-txt
 * @link        https://packagist.org/packages/austinheap/php-security-txt
 * @link        https://austinheap.github.io/php-security-txt/classes/AustinHeap.Security.Txt.SecurityTxt.html
 */
trait Acknowledgement
{

    /**
     * The acknowledgement URL.
     *
     * @var string
     */
    protected $acknowledgement = null;

    /**
     * Set the acknowledgement URL.
     *
     * @param  string $acknowledgement
     *
     * @return SecurityTxt
     */
    public function setAcknowledgement(string $acknowledgement): SecurityTxt
    {
        if (filter_var($acknowledgement, FILTER_VALIDATE_URL) === false) {
            throw new Exception('Acknowledgement must be a well-formed URL.');
        }

        $this->acknowledgement = $acknowledgement;

        return $this;
    }

    /**
     * Get the acknowledgement URL.
     *
     * @return string
     */
    public function getAcknowledgement(): string
    {
        return $this->acknowledgement;
    }
}
