<?php
use \TYPO3\CMS\Extbase\Utility\ExtensionUtility;
// use Skygate\Sitepackage\Controller\DemoApiController;
use Skygate\Sitepackage\Controller\PostController;


defined('TYPO3') or die('Access denied.');

// Add default RTE configuration
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['sitepackage'] = 'EXT:sitepackage/Configuration/RTE/Default.yaml';
$GLOBALS['TYPO3_CONF_VARS']['BE']['loginSecurityLevel'] = 'normal';
$GLOBALS['TYPO3_CONF_VARS']['FE']['loginSecurityLevel'] = 'normal';
$GLOBALS['TYPO3_CONF_VARS']['BE']['loginRateLimit'] = 0;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['headless.elementBodyResponse'] = true;



ExtensionUtility::configurePlugin(
    extensionName: 'Sitepackage',
    pluginName: 'Post',
    controllerActions: [PostController::class => 'list'],
    nonCacheableControllerActions: [PostController::class => 'list'],
    // pluginType: ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
    // pluginType: ExtensionUtility::PLUGIN_TYPE_PLUGIN,
);

