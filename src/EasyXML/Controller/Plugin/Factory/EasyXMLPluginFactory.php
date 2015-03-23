<?php
/**
 * Murilo Amaral (http://muriloamaral.com/)
 *
 * @link      https://github.com/muriloacs/EasyXML
 * @copyright Copyright (c) 2015 Murilo Amaral
 * @license   The MIT License (MIT)
 * @since     File available since Release 1.0
 */

namespace EasyXML\Controller\Plugin\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use EasyXML\Controller\Plugin\EasyXMLPlugin;

/**
 * Creates EasyXMLPlugin's instance with dependencies injected.
 *
 * @since Class available since Release 1.0
 */
class EasyXMLPluginFactory implements FactoryInterface
{
    /**
     * Returns EasyXMLPlugin's instance.
     * @param  ServiceLocatorInterface $serviceManager 
     * @return EasyXMLPlugin
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $easyXMLService = $serviceManager->getServiceLocator()->get('EasyXML');
        return new EasyXMLPlugin($easyXMLService);
    }
}