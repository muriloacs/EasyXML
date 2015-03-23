EasyXML
============

Zend Framework 2 module for dealing with XML. Creates XML from an array and vice versa.

This module provides both a Service and a ControllerPlugin with which you can use to convert an array to XML and also a XML to an array.

Installation
------------

#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "muriloamaral/easyxml": "dev-master"
    }
    ```

2. Now tell composer to download EasyXML by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Post installation

1. Enabling it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'EasyXML',
        ),
        // ...
    );
    ```

Usage
-----
You can either create an instance of `EasyXML`through the ServiceManager or use it within your controller by using the EasyXML ControllerPlugin. 


#### ControllerPlugin

--- XML TO ARRAY ---

    public function xml2arrayAction()
    {
        // IT COULD BE EITHER A XML PATH FILE OR A STRING CONTAINING THE XML CONTENT.
        $xml = ROOT_PATH . '/data/my-xml-file.xml';

        $array = $this->easyXML()->xml2array($xml); 
    }

--- ARRAY TO XML ---
    
    public function array2xmlAction()
    {
        $rootNode = 'books';

        $body = array(
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
                    'title' => array('@cdata'=>'Foundation'),
                    'price' => '$15.61'
                ),
                array(
                    '@attributes' => array(
                        'author' => 'Robert A Heinlein'
                    ),
                    'title' =>  array('@cdata'=>'Stranger in a Strange Land'),
                    'price' => array(
                        '@attributes' => array(
                            'discount' => '10%'
                        ),
                        '@value' => '$18.00'
                    )
                )
            )
        );

        $xml = $this->easyXML()->array2xml($rootNode, $body);
    }


#### ServiceManager

--- XML TO ARRAY ---

    $xmlService = $this->getServiceLocator()->get('EasyXML');

    // IT COULD BE EITHER A XML PATH FILE OR A STRING CONTAINING THE XML CONTENT.
    $xml = ROOT_PATH . '/data/my-xml-file.xml'; 

    $array = $xmlService->xml2array($xml);


--- ARRAY TO XML ---

    $xmlService = $this->getServiceLocator()->get('EasyXML');

    $rootNode = 'books';

    $body = array(
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
                'title' => array('@cdata'=>'Foundation'),
                'price' => '$15.61'
            ),
            array(
                '@attributes' => array(
                    'author' => 'Robert A Heinlein'
                ),
                'title' =>  array('@cdata'=>'Stranger in a Strange Land'),
                'price' => array(
                    '@attributes' => array(
                        'discount' => '10%'
                    ),
                    '@value' => '$18.00'
                )
            )
        )
    );

    $xml = $xmlService->array2xml($rootNode, $body);

