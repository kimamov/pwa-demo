<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::registerPlugin(
    extensionName: 'Sitepackage',
    pluginName: 'Example',
    pluginTitle: 'Example Plugin',
);
