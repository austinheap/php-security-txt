<?php
/**
 * src/Writer.php
 *
 * @package     php-security-txt
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.3.0
 */

declare(strict_types=1);

namespace AustinHeap\Security\Txt;

/**
 * Writer
 *
 * @link        https://github.com/austinheap/php-security-txt
 * @link        https://packagist.org/packages/austinheap/php-security-txt
 * @link        https://austinheap.github.io/php-security-txt/classes/AustinHeap.Security.Txt.Writer.html
 */
class Writer extends SecurityTxt
{

    /**
     * Internal lines cache.
     *
     * @var array
     */
    private $lines              = [];

    /**
     * Create a new Writer instance.
     *
     * @return \AustinHeap\Security\Txt\Writer
     */
    public function __construct()
    {
        return parent::__construct($this);
    }

    /**
     * Add a comment to the output buffer.
     *
     * @param  string $comment
     * @return \AustinHeap\Security\Txt\Writer
     */
    public function comment(string $comment = ''): Writer
    {
        $comment = trim($comment);

        if (!empty($comment)) {
            $comment = ' ' . $comment;
        }

        return $this->line(trim('#' . $comment));
    }

    /**
     * Add a spacer to the output buffer.
     *
     * @return \AustinHeap\Security\Txt\Writer
     */
    public function spacer(): Writer
    {
        return $this->line('');
    }

    /**
     * Add multiple spacers to the output buffer.
     *
     * @return \AustinHeap\Security\Txt\Writer
     */
    public function spacers($count = 1): Writer
    {
        for ($x = 0; $x < $count; $x++) {
            $this->spacer();
        }

        return $this;
    }

    /**
     * Add a line.
     *
     * @param  string $line
     * @return \AustinHeap\Security\Txt\Writer
     */
    public function line(string $line): Writer
    {
        $this->lines[] = $line;

        return $this;
    }

    /**
     * Add multiple lines.
     *
     * @param  array $lines
     * @return \AustinHeap\Security\Txt\Writer
     */
    public function lines(array $lines): Writer
    {
        foreach ($lines as $line) {
            $this->line($line);
        }

        return $this;
    }

    /**
     * Reset the output buffer.
     *
     * @return \AustinHeap\Security\Txt\Writer
     */
    public function reset(): Writer
    {
        $this->lines = [];

        return $this;
    }

    /**
     * Generate the data.
     *
     * @return \AustinHeap\Security\Txt\Writer
     */
    public function generate(): Writer
    {
        if ($this->debug) {
            $time = microtime(true);
        }

        if ($this->comments) {
            $this->comment('Our security address');
        }

        if (empty($this->contacts)) {
            throw new \Exception('One (or more) contacts must be defined.');
        }

        foreach (array_keys($this->contacts) as $contact) {
            $this->line('Contact: ' . trim($contact));
        }

        if (!empty($this->encryption)) {
            if ($this->comments) {
                $this->spacer()
                     ->comment('Our PGP key');
            }

            $this->line('Encryption: ' . trim($this->encryption));
        }

        if (!empty($this->disclosure)) {
            if ($this->comments) {
                $this->spacer()
                     ->comment('Our disclosure policy');
            }

            $this->line('Disclosure: ' . trim(ucfirst($this->disclosure)));
        }

        if (!empty($this->acknowledgement)) {
            if ($this->comments) {
                $this->spacer()
                     ->comment('Our public acknowledgement');
            }

            $this->line('Acknowledgement: ' . trim($this->acknowledgement));
        }

        if ($this->debug) {
            $this->spacer()
                 ->comment()
                 ->comment(
                    'Generated by "' . (defined('LARAVEL_SECURITY_TXT_VERSION') ? 'laravel' : 'php') . '-security-txt"' .
                    (defined('LARAVEL_SECURITY_TXT_VERSION') ? ' v' . LARAVEL_SECURITY_TXT_VERSION : (defined('PHP_SECURITY_TXT_VERSION') ? ' v' . PHP_SECURITY_TXT_VERSION : '')) .
                    ' (https://github.com/austinheap/' . (defined('LARAVEL_SECURITY_TXT_VERSION') ? 'laravel' : 'php') . '-security-txt' . (defined('LARAVEL_SECURITY_TXT_VERSION') ? '/releases/tag/v' . LARAVEL_SECURITY_TXT_VERSION : (defined('PHP_SECURITY_TXT_VERSION') ? '/releases/tag/v' . PHP_SECURITY_TXT_VERSION : '')) . ')')
                 ->comment(
                    'using "php-security-txt"' . (defined('PHP_SECURITY_TXT_VERSION') ? ' v' . PHP_SECURITY_TXT_VERSION : '') .
                    ' (https://github.com/austinheap/php-security-txt' . (defined('PHP_SECURITY_TXT_VERSION') ? '/releases/tag/v' . PHP_SECURITY_TXT_VERSION : '') . ')')
                 ->comment('in ' . round((microtime(true) - $time) * 1000, 6) . ' seconds on ' . date('c') . '.')
                 ->comment()
                 ->spacer();
        }

        $output = implode(PHP_EOL, $this->lines);

        return $this->setText($output);
    }
}
