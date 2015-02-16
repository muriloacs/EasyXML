<?php
namespace EasyXML\Controller\Plugin\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use EasyXML\Controller\Plugin\EasyXMLPlugin;

class EasyXMLPluginFactory implements FactoryInterface
{
    /**
     * Creates the EasyXMLPlugin's instance.
     * @param  ServiceLocatorInterface $serviceManager 
     * @return EasyXML\Controller\Plugin\EasyXMLPlugin
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $easyXMLService = $serviceManager->getServiceLocator()->get('EasyXML');
        return new EasyXMLPlugin($easyXMLService);
    }
}