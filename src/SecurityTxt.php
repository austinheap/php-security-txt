<?php
/**
 * src/SecurityTxt.php
 *
 * @package     php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.3.2
 */

declare(strict_types=1);

namespace AustinHeap\Security\Txt;

use Exception;

/**
 * SecurityTxt
 *
 * @link        https://github.com/austinheap/php-security-txt
 * @link        https://packagist.org/packages/austinheap/php-security-txt
 * @link        https://austinheap.github.io/php-security-txt/classes/AustinHeap.Security.Txt.SecurityTxt.html
 */
class SecurityTxt
{

    /**
     * Internal version number.
     *
     * @var string
     */
    const VERSION               = '0.3.1';

    /**
     * Internal parent object.
     *
     * @var \AustinHeap\Security\Txt\Writer|\AustinHeap\Security\Txt\Reader
     */
    private $parent             = null;

    /**
     * Internal Writer object.
     *
     * @var \AustinHeap\Security\Txt\Writer
     */
    protected $writer           = null;

    /**
     * Internal Reader object.
     *
     * @var \AustinHeap\Security\Txt\Reader
     */
    protected $reader           = null;

    /**
     * Internal text cache.
     *
     * @var string
     */
    protected $text             = null;

    /**
     * Enable debug output.
     *
     * @var bool
     */
    protected $debug            = false;

    /**
     * Enable built-in comments.
     *
     * @var bool
     */
    protected $comments         = true;

    /**
     * The security contact(s).
     *
     * @var array
     */
    protected $contacts         = [];

    /**
     * The PGP key file URL.
     *
     * @var string
     */
    protected $encryption       = null;

    /**
     * The disclosure policy.
     *
     * @var string
     */
    protected $disclosure       = null;

    /**
     * The acknowledgement URL.
     *
     * @var string
     */
    protected $acknowledgement  = null;

    /**
     * Create a new SecurityTxt instance.
     *
     * @param  \AustinHeap\Security\Txt\Writer|\AustinHeap\Security\Txt\Reader $parent
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function __construct(&$parent = null)
    {
        if (!defined('PHP_SECURITY_TXT_VERSION')) {
            define('PHP_SECURITY_TXT_VERSION', self::VERSION);
        }

        $this->parent = $parent;

        if (!$this->parent instanceof Reader &&
            !$this->parent instanceof Writer) {
            throw new Exception('Cannot create ' . __CLASS__ . ' with $parent class: ' . get_class($this->parent));
        }

        return $this;
    }

    /**
     * Enable the comments flag.
     *
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function enableComments(): SecurityTxt
    {
        return $this->setComments(true);
    }

    /**
     * Disable the comments flag.
     *
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function disableComments(): SecurityTxt
    {
        return $this->setComments(false);
    }

    /**
     * Set the comments flag.
     *
     * @param  string       $comments
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function setComments(bool $comments): SecurityTxt
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get the comments flag.
     *
     * @return bool
     */
    public function getComments(): bool
    {
        return $this->comments;
    }

    /**
     * Enable the debug flag.
     *
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function enableDebug(): SecurityTxt
    {
        return $this->setDebug(true);
    }

    /**
     * Disable the debug flag.
     *
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function disableDebug(): SecurityTxt
    {
        return $this->setDebug(false);
    }

    /**
     * Set the debug flag.
     *
     * @param  bool         $debug
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function setDebug(bool $debug): SecurityTxt
    {
        $this->debug = $debug;

        return $this;
    }

    /**
     * Get the debug flag.
     *
     * @return bool
     */
    public function getDebug(): bool
    {
        return $this->debug;
    }

    /**
     * Set the text.
     *
     * @param  string       $text
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function setText(string $text): SecurityTxt
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the text.
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text === null ? '' : $this->text;
    }

    /**
     * Set the contacts.
     *
     * @param  array        $contacts
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function setContacts(array $contacts): SecurityTxt
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * Get the contacts.
     *
     * @return array
     */
    public function getContacts(): array
    {
        return is_null($this->contacts) ? [] : $this->contacts;
    }

    /**
     * Add a contact.
     *
     * @param  string $contact
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function addContact(string $contact): SecurityTxt
    {
        return $this->addContacts([$contact]);
    }

    /**
     * Add contacts.
     *
     * @param  array $contacts
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function addContacts(array $contacts): SecurityTxt
    {
        foreach ($contacts as $contact) {
            $this->contacts[$contact] = true;
        }

        return $this;
    }

    /**
     * Remove a contact.
     *
     * @param  string $contact
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function removeContact(string $contact): SecurityTxt
    {
        $this->removeContacts([$contact]);

        return $this;
    }

    /**
     * Remove contacts.
     *
     * @param  array $contacts
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function removeContacts(array $contacts): SecurityTxt
    {
        foreach ($contacts as $contact) {
            if (array_key_exists($contact, $this->contacts)) {
                unset($this->contacts[$contact]);
            }
        }

        return $this;
    }

    /**
     * Set the encryption.
     *
     * @param  string $encryption
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function setEncryption(string $encryption): SecurityTxt
    {
        if (filter_var($encryption, FILTER_VALIDATE_URL) === false) {
            throw new \Exception('Encryption must be a well-formed URL.');
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
     * Set the disclosure policy.
     *
     * @param  string $disclosure
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function setDisclosure(string $disclosure): SecurityTxt
    {
        if (!in_array(trim(strtolower($disclosure)), ['full', 'partial', 'none'])) {
            throw new \Exception('Disclosure policy must be either "full", "partial", or "none".');
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
     * Set the acknowledgement URL.
     *
     * @param  string $acknowledgement
     * @return \AustinHeap\Security\Txt\SecurityTxt
     */
    public function setAcknowledgement(string $acknowledgement): SecurityTxt
    {
        if (filter_var($acknowledgement, FILTER_VALIDATE_URL) === false) {
            throw new \Exception('Acknowledgement must be a well-formed URL.');
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
