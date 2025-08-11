<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Register list_type for Posts plugin
ExtensionUtility::registerPlugin(
    'Sitepackage',
    'Post',
    'Post (headless)'
);

ExtensionUtility::registerPlugin(
    'Sitepackage',
    'Students',
    'Students (headless)'
);

// ExtensionUtility::registerPlugin(
//     extensionName: 'Sitepackage',
//     pluginName: 'Comment',
//     pluginTitle: 'Comment Example Plugin',
// );

// ExtensionUtility::registerPlugin(
//     extensionName: 'Sitepackage',
//     pluginName: 'CommentForm',
//     pluginTitle: 'Comment Form Plugin',
// );

// ExtensionUtility::registerPlugin(
//     extensionName: 'Sitepackage',
//     pluginName: 'User',
//     pluginTitle: 'Frontend User Data',
// );


//
// START B13/Container Registration
//

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
    (
    new \B13\Container\Tca\ContainerConfiguration(
        '50_wrapper',
        // CType
        '50 Grid',
        // label
        '50/50',
        // description
        [
            [
                ['name' => 'Links', 'colPos' => 201, 'allowed' => ['CType' => 'textmedia,textpic']],
                ['name' => 'Rechts', 'colPos' => 202, 'allowed' => ['CType' => 'textmedia,textpic']]
            ],
        ]
    )
    )
        // set an optional icon configuration
        ->setIcon('EXT:container/Resources/Public/Icons/container-2col.svg')
);

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
    (
    new \B13\Container\Tca\ContainerConfiguration(
        '33_wrapper',
        // CType
        '33 Grid',
        // label
        '33/33/33',
        // description
        [
            [
                ['name' => 'Links', 'colPos' => 201, 'allowed' => ['CType' => 'textmedia,header,image,bracontent_vehiclevalues,text']],
                ['name' => 'Mitte', 'colPos' => 202, 'allowed' => ['CType' => 'textmedia,header,image,bracontent_vehiclevalues,text']],
                ['name' => 'Rechts', 'colPos' => 203, 'allowed' => ['CType' => 'textmedia,header,image,bracontent_vehiclevalues,text']]
            ],
        ]
    )
    )
        // set an optional icon configuration
        ->setIcon('EXT:container/Resources/Public/Icons/container-3col.svg')
);