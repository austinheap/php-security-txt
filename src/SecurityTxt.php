<?php
/**
 * src/SecurityTxt.php
 *
 * @package     php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.4.0
 */

declare(strict_types = 1);

namespace AustinHeap\Security\Txt;

use AustinHeap\Security\Txt\Directives\Acknowledgement;
use AustinHeap\Security\Txt\Directives\Contact;
use AustinHeap\Security\Txt\Directives\Disclosure;
use AustinHeap\Security\Txt\Directives\Encryption;
use Exception;

/**
 * SecurityTxt
 *
 * @link        https://github.com/austinheap/php-security-txt
 * @link        https://packagist.org/packages/austinheap/php-security-txt
 * @link        https://austinheap.github.io/php-security-txt/classes/AustinHeap.Security.Txt.SecurityTxt.html
 */
class SecurityTxt implements SecurityTxtInterface
{
    /**
     * Directive trait: Contact
     */
    use Contact;

    /**
     * Directive trait: Encryption
     */
    use Encryption;

    /**
     * Directive trait: Disclosure
     */
    use Disclosure;

    /**
     * Directive trait: Acknowledgement
     */
    use Acknowledgement;

    /**
     * Internal version number.
     *
     * @var string
     */
    const VERSION = '0.4.0';

    /**
     * Internal parent object.
     *
     * @var \AustinHeap\Security\Txt\Writer|\AustinHeap\Security\Txt\Reader
     */
    private $parent = null;

    /**
     * Internal Writer object.
     *
     * @var \AustinHeap\Security\Txt\Writer
     */
    protected $writer = null;

    /**
     * Internal Reader object.
     *
     * @var \AustinHeap\Security\Txt\Reader
     */
    protected $reader = null;

    /**
     * Internal text cache.
     *
     * @var string
     */
    protected $text = null;

    /**
     * Enable debug output.
     *
     * @var bool
     */
    protected $debug = false;

    /**
     * Enable built-in comments.
     *
     * @var bool
     */
    protected $comments = true;

    /**
     * Create a new SecurityTxt instance.
     *
     * @param  Writer|Reader $parent
     *
     * @return SecurityTxt|Writer|Reader
     */
    public function __construct(&$parent = null)
    {
        if (!defined('PHP_SECURITY_TXT_VERSION')) {
            define('PHP_SECURITY_TXT_VERSION', self::VERSION);
        }

        $this->parent = $parent;

        if (func_num_args() == 1) {
            if (is_null($this->parent)) {
                throw new Exception('Cannot create ' . __CLASS__ . ' with explicitly null $parent class.');
            } elseif (!$this->parent instanceof Reader && !$this->parent instanceof Writer) {
                throw new Exception('Cannot create ' . __CLASS__ . ' with $parent class: ' . get_class($this->parent));
            }
        }

        return $this;
    }

    /**
     * Returns the parent's class if it exists.
     *
     * @return string
     */
    public function getParentClass(): string
    {
        return get_class($this->getParent());
    }

    /**
     * Returns the parent object if it exists.
     *
     * @return Reader|Writer
     */
    public function getParent()
    {
        if (!$this->hasParent()) {
            throw new Exception('Parent object is not set.');
        }

        return $this->parent;
    }

    /**
     * Determines if the parent object was set.
     *
     * @return bool
     */
    public function hasParent(): bool
    {
        return !is_null($this->parent);
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
     * @param  string $comments
     *
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
     * @param  bool $debug
     *
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
     * @param  string $text
     *
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
     * Stub generate function. Must be overridden by inheriting class that implements SecurityTxtInterface.
     *
     * @param bool $test_case
     *
     * @return Reader|Writer|null
     * @throws Exception
     */
    public function execute(bool $test_case = false)
    {
        return $this->overrideMissing(__FUNCTION__, $test_case);
    }

    /**
     * Stub reset function. Must be overridden by inheriting class that implements SecurityTxtInterface.
     *
     * @param bool $test_case
     *
     * @return Reader|Writer|null
     * @throws Exception
     */
    public function reset(bool $test_case = false)
    {
        return $this->overrideMissing(__FUNCTION__, $test_case);
    }

    /**
     * Throws an exception when the inheriting class did not correctly implement SecurityTxtInterface.
     *
     * @param string $function
     * @param bool   $test_case
     *
     * @return null
     * @throws Exception
     */
    public function overrideMissing(string $function, bool $test_case = false)
    {
        if ($test_case) {
            return null;
        }

        throw new Exception('Function "' . $function . '" must be overridden by parent SecurityTxtInterface before being called.');
    }
}
