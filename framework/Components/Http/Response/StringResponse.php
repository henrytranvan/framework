<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 * @copyright ©2009-2015
 */
namespace Spiral\Components\Http\Response;

use Psr\Http\Message\StreamableInterface;

class StringResponse implements StreamableInterface
{
    /**
     * String content.
     *
     * @var string
     */
    protected $string = '';

    /**
     * Create string based on seekable response.
     *
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * Closes the stream and any underlying resources.
     *
     * @return void
     */
    public function close()
    {
    }

    /**
     * Separates any underlying resources from the stream.
     *
     * After the stream has been detached, the stream is in an unusable state.
     *
     * @return resource|null Underlying PHP stream, if any
     */
    public function detach()
    {
        return null;
    }

    /**
     * Get the size of the stream if known
     *
     * @return int|null Returns the size in bytes if known, or null if unknown.
     */
    public function getSize()
    {
        return strlen($this->string);
    }

    /**
     * Returns the current position of the file read/write pointer
     *
     * @return int|bool Position of the file pointer or false on error.
     */
    public function tell()
    {
        return false;
    }

    /**
     * Returns true if the stream is at the end of the stream.
     *
     * @return bool
     */
    public function eof()
    {
        return false;
    }

    /**
     * Returns whether or not the stream is seekable.
     *
     * @return bool
     */
    public function isSeekable()
    {
        return false;
    }

    /**
     * Seek to a position in the stream.
     *
     * @link http://www.php.net/manual/en/function.fseek.php
     * @param int $offset Stream offset
     * @param int $whence Specifies how the cursor position will be calculated
     *                    based on the seek offset. Valid values are identical to the built-in
     *                    PHP $whence values for `fseek()`.  SEEK_SET: Set position equal to
     *                    offset bytes SEEK_CUR: Set position to current location plus offset
     *                    SEEK_END: Set position to end-of-stream plus offset.
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        return false;
    }

    /**
     * Seek to the beginning of the stream.
     *
     * If the stream is not seekable, this method will return FALSE, indicating
     * failure; otherwise, it will perform a seek(0), and return the status of
     * that operation.
     *
     * @see  seek()
     * @link http://www.php.net/manual/en/function.fseek.php
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function rewind()
    {
        return false;
    }

    /**
     * Returns whether or not the stream is writable.
     *
     * @return bool
     */
    public function isWritable()
    {
        return true;
    }

    /**
     * Write data to the stream.
     *
     * @param string $string The string that is to be written.
     * @return int|bool Returns the number of bytes written to the stream on
     *                       success or FALSE on failure.
     */
    public function write($string)
    {
        $this->string .= $string;

        return strlen($string);
    }

    /**
     * Returns whether or not the stream is readable.
     *
     * @return bool
     */
    public function isReadable()
    {
        return true;
    }

    /**
     * Read data from the stream.
     *
     * @param int $length Read up to $length bytes from the object and return
     *                    them. Fewer than $length bytes may be returned if underlying stream
     *                    call returns fewer bytes.
     * @return string|false Returns the data read from the stream, false if
     *                    unable to read or if an error occurs.
     */
    public function read($length)
    {
        return false;
    }

    /**
     * Returns the remaining contents in a string
     *
     * @return string
     */
    public function getContents()
    {
        return $this->string;
    }

    /**
     * Get stream metadata as an associative array or retrieve a specific key.
     *
     * The keys returned are identical to the keys returned from PHP's
     * stream_get_meta_data() function.
     *
     * @link http://php.net/manual/en/function.stream-get-meta-data.php
     * @param string $key Specific metadata to retrieve.
     * @return array|mixed|null Returns an associative array if no key is
     *                    provided. Returns a specific key value if a key is provided and the
     *                    value is found, or null if the key is not found.
     */
    public function getMetadata($key = null)
    {
        return null;
    }

    /**
     * Reads all data from the stream into a string, from the beginning to end.
     *
     * This method MUST attempt to seek to the beginning of the stream before
     * reading data and read the stream until the end is reached.
     *
     * Warning: This could attempt to load a large amount of data into memory.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }
}