<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::registerPlugin(
    extensionName: 'Sitepackage',
    pluginName: 'Comment',
    pluginTitle: 'Comment Example Plugin',
);

ExtensionUtility::registerPlugin(
    extensionName: 'Sitepackage',
    pluginName: 'CommentForm',
    pluginTitle: 'Comment Form Plugin',
);

ExtensionUtility::registerPlugin(
    extensionName: 'Sitepackage',
    pluginName: 'User',
    pluginTitle: 'Frontend User Data',
);
