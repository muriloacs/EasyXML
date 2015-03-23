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

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

/**
 * EasyXML's Module class.
 *
 * @since Class available since Release 1.0
 */
class Module implements 
        ConfigProviderInterface, 
        AutoloaderProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            ),
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            )
        );
    }
}