<?php
/**
 * Murilo Amaral (http://muriloamaral.com/)
 *
 * @link      https://github.com/muriloacs/EasyXML
 * @copyright Copyright (c) 2015 Murilo Amaral
 * @license   The MIT License (MIT)
 * @since     File available since Release 1.0
 */

namespace EasyXML\Controller\Plugin;
 
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use EasyXML\Service\EasyXMLService;

/**
 * It allows to call easyXML within any controller.
 *
 * @since Class available since Release 1.0
 */
class EasyXMLPlugin extends AbstractPlugin
{
    /**
     * @var EasyXMLService
     */
    private $_easyXMLService;

    /**
     * EasyXMLService injected as a dependency.
     * @param EasyXMLService $_easyXMLService
     */
    public function __construct(EasyXMLService $_easyXMLService)
    {
        $this->_easyXMLService = $_easyXMLService;
    }

    /**
     * Converts an array to XML.
     * @param  string $rootNode The root node of the XML.
     * @param  array  $body     The child nodes of the XML. 
     * @param  array  $header   The header informations, such as version and encoding.
     * @return string           Returns a XML in string format.
     */
    public function array2xml($rootNode, $body, $header = null)
    {
        return $this->_easyXMLService->array2xml($rootNode, $body, $header);
    }

    /**
     * Converts a XML (file or string) to an array.
     * @param  string $xml A file path or a string containing the XML content.
     * @return array       Returns an array containing the XML content.
     */
    public function xml2array($xml)
    {
        return $this->_easyXMLService->xml2array($xml);
    }
}