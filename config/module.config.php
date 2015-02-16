<?php
namespace EasyXML;

return [
	'service_manager' => [
		'aliases' => [
			'EasyXML' => __NAMESPACE__ . '\Service\EasyXML'
		],
		'invokables' => [
			__NAMESPACE__ . '\Service\EasyXML' => __NAMESPACE__ . '\Service\EasyXMLService'
		]
	],
	'controller_plugins' => [
		'factories' =>[
			'easyXML' => __NAMESPACE__ . '\Controller\Plugin\Factory\EasyXMLPluginFactory'
		]
	]
];