<?php
/**
 * Murilo Amaral (http://muriloamaral.com/)
 *
 * @link      https://github.com/muriloacs/EasyXML
 * @copyright Copyright (c) 2015 Murilo Amaral
 * @license   The MIT License (MIT)
 * @since     File available since Release 1.0
 */

namespace EasyXMLTest\Service;

use PHPUnit_Framework_TestCase;
use DomDocument;
use EasyXML\Service\EasyXMLService;
use EasyXML\Exception\EasyXMLException;

/**
 * EasyXML's service test class.
 *
 * @since Class available since Release 1.0
 */
class EasyXMLServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $_rootNode = 'products';

    /**
     * @var array
     */
    private $_body = array(
        '@attributes' => array(
            'type' => 'fiction'
        ),
        'book' => array(
            array(
                '@attributes' => array(
                    'author' => 'George Orwell'
                ),
                'title' => '1984'
            ),
            array(
                '@attributes' => array(
                    'author' => 'Isaac Asimov'
                ),
                'title' => array('@cdata' => 'Foundation'),
                'price' => '$15.61'
            ),
            array(
                '@attributes' => array(
                    'author' => 'Robert A Heinlein'
                ),
                'title' => array('@cdata' => 'Stranger in a Strange Land'),
                'price' => array(
                    '@attributes' => array(
                        'discount' => '10%'
                    ),
                    '@value' => '$18.00'
                )
            )
        )
    );

    /**
     * Tests the main flow of xml2array functionality.
     */
    public function testXML2Array()
    {
        $xmlService = new EasyXMLService();
        $xmlFile = __DIR__ . '/../../data/test.xml';
        $content = $xmlService->xml2array($xmlFile);

        $this->assertEquals(
            'fiction',
            $content['products']['@attributes']['type']
        );
        $this->assertEquals(
            '1984',
            $content['products']['book'][0]['title']
        );
        $this->assertEquals(
            '$15.61',
            $content['products']['book'][1]['price']
        );
        $this->assertEquals(
            'Stranger in a Strange Land',
            $content['products']['book'][2]['title']['@cdata']
        );
        $this->assertEquals(
            'Robert A Heinlein',
            $content['products']['book'][2]['@attributes']['author']
        );
    }

    /**
     * Tests the main flow of array2xml functionality.
     */
    public function testArray2XML()
    {
        $xmlService = new EasyXMLService();
        $content    = $xmlService->array2xml($this->_rootNode, $this->_body);
        $dom        = new DomDocument();
        $this->assertTrue($dom->loadXML($content));
    }

    /**
     * Tests the exception flow of xml2array functionality.
     */
    public function testXML2ArrayException()
    {
        try {
            $xmlService = new EasyXMLService();
            $xmlFile = ' ';
            $xmlService->xml2array($xmlFile);
        } catch (EasyXMLException $e) {
            $this->assertEquals(
                '[EasyXML] Error Processing Request: Invalid XML document given.',
                $e->getMessage()
            );
        }
    }

    /**
     * Tests the exception flow of array2xml functionality.
     */
    public function testArray2XMLException()
    {
        $xmlService = new EasyXMLService();

        try {
            $xmlService->array2xml(null, $this->_body);
        } catch (EasyXMLException $e) {
            $this->assertEquals(
                '[EasyXML] Error Processing Request: Invalid first argument($rootNode).',
                $e->getMessage()
            );
        }

        try {
            $xmlService->array2xml($this->_rootNode, null);
        } catch (EasyXMLException $e) {
            $this->assertEquals(
                '[EasyXML] Error Processing Request: Invalid second argument($body).',
                $e->getMessage()
            );
        }
    }
}