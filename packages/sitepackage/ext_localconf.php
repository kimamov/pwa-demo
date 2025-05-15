<?php

use Skygate\Sitepackage\Controller\CommentController;
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
    pluginName: 'Comment',
    controllerActions: [CommentController::class => 'list, add'],
    nonCacheableControllerActions: [CommentController::class => 'list'],
    pluginType: ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
);
