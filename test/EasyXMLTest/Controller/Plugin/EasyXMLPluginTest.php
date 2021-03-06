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

use EasyXML\Controller\Plugin\EasyXMLPlugin;
use EasyXML\Service\EasyXMLService;

/**
 * EasyXML's plugin test class.
 *
 * @since Class available since Release 1.0
 */
class EasyXMLPluginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EasyXMLPlugin
     */
    private $plugin;

    /**
     * @var string
     */
    private $rootNode;

    /**
     * @var array
     */
    private $body;

    /**
     * @var array
     */
    private $header;

    /**
     * Setup method.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->plugin = new EasyXMLPlugin(new EasyXMLService());

        $this->rootNode = 'products';

        $this->body = array(
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

        $this->header = array(
            'version'  => '1.0',
            'encoding' => 'utf-8'
        );
    }

    /**
     * Tests the main flow of xml2array functionality.
     */
    public function testXML2Array()
    {
        $xmlFile = __DIR__ . '/../../../data/test.xml';
        $content = $this->plugin->xml2array($xmlFile);

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
        $content = $this->plugin->array2xml($this->rootNode, $this->body, $this->header);
        $dom = new \DomDocument();

        $this->assertTrue($dom->loadXML($content));
    }
}