<?php
/**
 * Murilo Amaral (http://muriloamaral.com/)
 *
 * @link      https://github.com/muriloacs/EasyXML
 * @copyright Copyright (c) 2015 Murilo Amaral
 * @license   The MIT License (MIT)
 * @since     File available since Release 1.0
 */

namespace EasyXML\Service;

use EasyXML\Library\Array2XML;
use EasyXML\Library\XML2Array;
use DomDocument;
use InvalidArgumentException;

/**
 * EasyXML's service class.
 *
 * @since Class available since Release 1.0
 */
class EasyXMLService
{
    private $_errorMessage = '[EasyXMLService] Error Processing Request: ';

    /**
     * Converts an array to XML.
     * @param  string $rootNode The root node of the XML.
     * @param  array  $body     The child nodes of the XML.
     * @param  array  $header   The header informations, such as version and encoding.
     * @return string           Returns a XML in string format.
     */
    public function array2xml($rootNode, $body, $header = null)
    {
        // First argument
        if (!is_string($rootNode) || empty($rootNode)) {
            throw new InvalidArgumentException($this->_errorMessage . 'Invalid first argument($rootNode).');
        }
        // Second argument
        if (!is_array($body) || !count($body)) {
            throw new InvalidArgumentException($this->_errorMessage . 'Invalid second argument($body).');
        }
        // Third argument
        $version = isset($header['version']) && !empty($header['version']) ? $header['version'] : '1.0';
        $encoding = isset($header['encoding']) && !empty($header['encoding']) ? $header['encoding'] : 'UTF-8';

        Array2XML::init($version, $encoding);
        $xml = Array2XML::createXML($rootNode, $body);
        return $xml->saveXML();
    }

    /**
     * Converts a XML (file or string) to an array.
     * @param  string $xml A file path or a string containing the XML content.
     * @return array       Returns an array containing the XML content.
     */
    public function xml2array($xml)
    {
        $xml = is_file($xml) ? file_get_contents($xml) : $xml;
        $dom = new DomDocument();
        if (!$dom->loadXML($xml)) {
            throw new InvalidArgumentException($this->_errorMessage . 'Invalid XML document given.');
        }
        return XML2Array::createArray($dom);
    }
}