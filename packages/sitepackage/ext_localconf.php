<?php

use Skygate\Sitepackage\Controller\ExampleController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die('Access denied.');

// Add default RTE configuration
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['sitepackage'] = 'EXT:sitepackage/Configuration/RTE/Default.yaml';
$GLOBALS['TYPO3_CONF_VARS']['BE']['loginSecurityLevel'] = 'normal';
$GLOBALS['TYPO3_CONF_VARS']['FE']['loginSecurityLevel'] = 'normal';
$GLOBALS['TYPO3_CONF_VARS']['BE']['loginRateLimit'] = 0;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['headless.elementBodyResponse'] = true;

ExtensionUtility::configurePlugin(
    extensionName: 'Sitepackage',
    pluginName: 'Example',
    controllerActions: [ExampleController::class => 'index'],
    pluginType: ExtensionUtility::PLUGIN_TYPE_PLUGIN, //TODO deprecated. Should be CType
);
