<?php
/** 
 * Number series analysis file.
 * 
 * @category NumberAnalysis
 * @package  NumberAnalysis
 * @author   J Anderson <email@gmail.com>
 * @license  http://www.gnu.org/copyleft/notaliscence.html Fake Public License
 * @link     http://www.notareallink.com
 */


/** 
 * Number series analyzer class.
 * 
 * @category NumberAnalysis
 * @package  NumberAnalysis
 * @author   J Anderson <email@gmail.com>
 * @license  http://www.gnu.org/copyleft/notaliscence.html Fake Public License
 * @link     http://www.notareallink.com
 */
class Series
{
    private $_series, $_bestSequence, $_bestProduct;

    /**
     * Initialize the number series as a string for easy manipulation.
     * 
     * @param int|string $series Unbroken set of numbers, stored as a string.
     */
    public function __construct($series) 
    {
        $this->_series = "$series";
    }

    /** 
     * Finds substring of specified length with largest product.
     * 
     * @param int $length length of substring.
     * 
     * @return The substring with the largest product as an int.
     */
    public function largestProduct($length) 
    {
        if ($length < 0) {
            throw new InvalidArgumentException(
                "Sequence length cannot be negative."
            );
        }

        if (strlen($this->_series) == 0 && $length != 0) {
            throw new InvalidArgumentException(
                "Series is empty and cannot be tested against."
            );
        }

        if ($length > strlen($this->_series)) {
            throw new InvalidArgumentException(
                "Sequence length is greater than the total series length."
            );
        }

        if (preg_match('/[^\d]/', $this->_series)) {
            throw new InvalidArgumentException(
                "Series contains non-numeric characters."
            );
        }

        $this->_bestSequence = substr($this->_series, 0, $length);
        $this->_bestProduct = $this->_multiplyString($this->_bestSequence);

        $setsToCheck = strlen($this->_series) - $length;
        for ($i = 1; $i <= $setsToCheck; $i++) {
            $this->_setBestSequence(substr($this->_series, $i, $length));
        }

        return $this->_bestProduct;
    }

    /**
     * Compares the sums of two strings as integers.
     * 
     * @param string $text 
     * 
     * @return Nothing.
     */
    private function _setBestSequence($text) 
    {
        if ($this->_bestProduct > $this->_multiplyString($text)) {
            return;
        }

        $this->_bestSequence = $text;
        $this->_bestProduct = $this->_multiplyString($text);
    }

    /**
     * Gets the product of a string, multiplied digit by digit.
     * 
     * @param string $text series of numbers to be multiplied.
     * 
     * @return The product of the multiplication.
     */
    private function _multiplyString($text)
    {
        $product = 1;
        for ($i = 0; $i < strlen($text); $i++) {
            $product *= intval(substr($text, $i, 1));
        }

        return $product;
    }
}

