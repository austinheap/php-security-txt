<?php
/**
 * src/Directives/Contact.php
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
 * Contact
 *
 * @link        https://github.com/austinheap/php-security-txt
 * @link        https://packagist.org/packages/austinheap/php-security-txt
 * @link        https://austinheap.github.io/php-security-txt/classes/AustinHeap.Security.Txt.SecurityTxt.html
 */
trait Contact
{

    /**
     * The security contact(s).
     *
     * @var array
     */
    protected $contacts = [];

    /**
     * Set the contacts.
     *
     * @param  array $contacts
     *
     * @return SecurityTxt
     */
    public function setContacts(array $contacts): SecurityTxt
    {
        if (!$this->validContacts($contacts, true)) {
            throw new Exception('Contacts array must contain well-formed e-mails and/or URLs.');
        }

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
        return is_null($this->contacts) ? [] : array_keys($this->contacts);
    }

    /**
     * Add a contact.
     *
     * @param  string $contact
     *
     * @return SecurityTxt
     */
    public function addContact(string $contact): SecurityTxt
    {
        return $this->addContacts([$contact]);
    }

    /**
     * Add contacts.
     *
     * @param  array $contacts
     *
     * @return SecurityTxt
     */
    public function addContacts(array $contacts): SecurityTxt
    {
        if (!$this->validContacts($contacts)) {
            throw new Exception('Contacts must be well-formed e-mails and/or URLs.');
        }

        foreach ($contacts as $contact) {
            $this->contacts[$contact] = true;
        }

        return $this;
    }

    /**
     * Validates a contact.
     *
     * @param string $contact
     *
     * @string string $contact
     * @return bool
     */
    public function validContact(string $contact): bool
    {
        return filter_var($contact, FILTER_VALIDATE_EMAIL) !== false ||
               filter_var($contact, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Validates an array of contacts.
     *
     * @param array $contacts
     * @param bool  $use_keys
     *
     * @return bool
     */
    public function validContacts(array $contacts, bool $use_keys = false): bool
    {
        if ($use_keys) {
            $contacts = array_keys($contacts);
        }

        foreach ($contacts as $contact) {
            if (!$this->validContact($contact)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Remove a contact.
     *
     * @param  string $contact
     *
     * @return SecurityTxt
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
     *
     * @return SecurityTxt
     */
    public function removeContacts(array $contacts): SecurityTxt
    {
        if (!$this->hasContacts($contacts)) {
            throw new Exception('Cannot remove contacts that do not exist.');
        }

        foreach ($contacts as $contact) {
            unset($this->contacts[$contact]);
        }

        return $this;
    }

    /**
     * Determines if a contact exists.
     *
     * @param string $contact
     *
     * @return bool
     */
    public function hasContact(string $contact): bool
    {
        return array_key_exists($contact, $this->contacts);
    }

    /**
     * Determines if an array of contacts exists.
     *
     * @param array $contacts
     *
     * @return bool
     */
    public function hasContacts(array $contacts): bool
    {
        foreach ($contacts as $contact) {
            if (!$this->hasContact($contact)) {
                return false;
            }
        }

        return true;
    }
}
