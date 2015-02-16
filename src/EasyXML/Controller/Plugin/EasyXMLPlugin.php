<?php
namespace EasyXML\Controller\Plugin;
 
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use EasyXML\Service\EasyXMLService;
 
class EasyXMLPlugin extends AbstractPlugin 
{
	/**
	 * @var EasyXML\Service\EasyXMLService
	 */
	private $easyXMLService;

	/**
	 * EasyXMLService injected as a dependency.
	 * @param EasyXMLService $easyXMLService
	 */
	public function __construct(EasyXMLService $easyXMLService)
	{
		$this->easyXMLService = $easyXMLService;
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
		return $this->easyXMLService->array2xml($rootNode, $body, $header);
	}

	/**
	 * Converts a XML (file or string) to an array.
	 * @param  string $xml A file path or a string containing the XML content.
	 * @return array       Returns an array containing the XML content.
	 */
	public function xml2array($xml)
	{
		return $this->easyXMLService->xml2array($xml);
	}
}