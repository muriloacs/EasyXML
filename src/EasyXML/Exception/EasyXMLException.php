<?php
/**
 * Murilo Amaral (http://muriloamaral.com/)
 *
 * @link      https://github.com/muriloacs/EasyXML
 * @copyright Copyright (c) 2015 Murilo Amaral
 * @license   The MIT License (MIT)
 * @since     File available since Release 1.0
 */

namespace EasyXML\Exception;

use Exception;

/**
 * EasyXML's exception class.
 *
 * @since Class available since Release 1.0
 */
class EasyXMLException extends Exception
{
    private $_errorMessage = '[EasyXML] Error Processing Request: ';

    /**
     * Redefine the exception so message isn't optional.
     * @param string    $message
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($this->_errorMessage . $message, $code, $previous);
    }
} 