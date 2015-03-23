<?php
/**
 * Murilo Amaral (http://muriloamaral.com/)
 *
 * @link      https://github.com/muriloacs/EasyXML
 * @copyright Copyright (c) 2015 Murilo Amaral
 * @license   The MIT License (MIT)
 * @since     File available since Release 1.0
 */

namespace EasyXML;

return array(
    'service_manager' => array(
        'aliases' => array(
            'EasyXML' => __NAMESPACE__ . '\Service\EasyXML'
        ),
        'invokables' => array(
            __NAMESPACE__ . '\Service\EasyXML' => __NAMESPACE__ . '\Service\EasyXMLService'
        )
    ),
    'controller_plugins' => array(
        'factories' => array(
            'easyXML' => __NAMESPACE__ . '\Controller\Plugin\Factory\EasyXMLPluginFactory'
        )
    )
);