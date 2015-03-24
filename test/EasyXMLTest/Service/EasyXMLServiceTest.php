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

use EasyXML\Service\EasyXMLService;

/**
 * EasyXMLService's test class.
 *
 * @since Class available since Release 1.0
 */
class EasyXMLServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EasyXMLService
     */
    private $_service;

    /**
     * @var string
     */
    private $_rootNode;

    /**
     * @var array
     */
    private $_body;

    /**
     * Setup method.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->_service = new EasyXMLService();

        $this->_rootNode = 'products';
        
        $this->_body = array(
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
    }

    /**
     * Tests the main flow of xml2array functionality.
     */
    public function testXML2Array()
    {
        $xmlFile = __DIR__ . '/../../data/test.xml';
        $content = $this->_service->xml2array($xmlFile);

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
     * Tests the exception flow of xml2array functionality.
     * @expectedException EasyXML\Exception\EasyXMLException
     * @expectedExceptionMessage [EasyXML] Error Processing Request: Invalid XML document given.
     */
    public function testXML2ArrayException()
    {
        $xmlFile = '';
        $this->_service->xml2array($xmlFile);
    }

    /**
     * Tests the main flow of array2xml functionality.
     */
    public function testArray2XML()
    {
        $content = $this->_service->array2xml($this->_rootNode, $this->_body);
        $dom = new \DomDocument();

        $this->assertTrue($dom->loadXML($content));
    }

    /**
     * Tests the exception flow of array2xml functionality.
     * @expectedException EasyXML\Exception\EasyXMLException
     * @expectedExceptionMessage [EasyXML] Error Processing Request: Invalid first argument($rootNode).
     */
    public function testArray2XMLExceptionOne()
    {
        $this->_service->array2xml(null, $this->_body);
    }

    /**
     * Tests the exception flow of array2xml functionality.
     * @expectedException EasyXML\Exception\EasyXMLException
     * @expectedExceptionMessage [EasyXML] Error Processing Request: Invalid second argument($body).
     */
    public function testArray2XMLExceptionTwo()
    {
        $this->_service->array2xml($this->_rootNode, null);
    }
}